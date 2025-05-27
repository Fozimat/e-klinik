<?php

namespace App\Http\Controllers;

use App\Models\Diagnose;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiagnoseController extends Controller
{
    public function index(Request $request)
    {
        $diagnoses = Diagnose::with(['patient', 'doctor'])->latest()->get();
        return view('diagnose.index', compact(['diagnoses']));
    }

    public function create()
    {
        $patients = Patient::latest()->get();
        return view('diagnose.create', compact(['patients']));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'patient_id' => ['required', 'exists:patients,id'],
            'complaint' => ['required', 'string', 'max:255'],
            'diagnosis' => ['required', 'string', 'max:255'],
        ]);

        Diagnose::create([
            'patient_id' => $request->patient_id,
            'doctor_id' => Auth::user()->id,
            'complaint' => $request->complaint,
            'diagnosis' => $request->diagnosis,
        ]);

        return redirect()->route('diagnoses.index')->with('success', 'Diagnosa berhasil ditambahkan');
    }

    public function edit(Diagnose $diagnose)
    {
        return view('diagnose.edit', compact(['diagnose']));
    }

    public function update(Request $request, Diagnose $diagnose)
    {
        $this->validate($request, [
            'complaint' => ['required', 'string', 'max:255'],
            'diagnosis' => ['required', 'string', 'max:255'],
        ]);

        $diagnose->update([
            'complaint' => $request->complaint,
            'diagnosis' => $request->diagnosis,
        ]);

        return redirect()->route('diagnoses.index')->with('success', 'Diagnosa berhasil diupdate');
    }

    public function destroy(Diagnose $diagnose)
    {
        $diagnose->delete();
        return redirect()->route('diagnoses.index')->with('success', 'Diagnosa berhasil dihapus');
    }
}
