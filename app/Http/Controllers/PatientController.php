<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        $patients = Patient::latest()->get();
        return view('patient.index', compact(['patients']));
    }

    public function create()
    {
        return view('patient.create');
    }

    public function show(Patient $patient)
    {
        $patient->load([
            'vitals' => fn($q) => $q->latest('created_at')->limit(1),
            'diagnosis.doctor',
            'diagnosis.prescriptions.medicine',
        ]);

        return view('patient.show', compact(['patient']));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'birth_date' => ['required', 'date'],
            'gender' => ['required', 'in:male,female'],
            'phone_number' => ['required', 'digits_between:8,16', 'unique:patients'],
        ]);

        Patient::create([
            'created_by' => Auth::user()->id,
            'name' => $request->name,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,
            'phone_number' => $request->phone_number,
        ]);

        return redirect()->route('patients.index')->with('success', 'Pasien berhasil ditambahkan');
    }

    public function edit(Patient $patient)
    {
        return view('patient.edit', compact(['patient']));
    }

    public function update(Request $request, Patient $patient)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'birth_date' => ['required', 'date'],
            'gender' => ['required', 'in:male,female'],
            'phone_number' => ['required', 'digits_between:8,16', 'unique:patients,phone_number,' . $patient->id],
        ]);

        $patient->update([
            'name' => $request->name,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,
            'phone_number' => $request->phone_number,
        ]);

        return redirect()->route('patients.index')->with('success', 'Pasien berhasil diupdate');
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();
        return redirect()->route('patients.index')->with('success', 'Pasien berhasil dihapus');
    }
}
