<?php

namespace App\Http\Controllers;

use App\Models\Diagnose;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrescriptionController extends Controller
{
    public function index(Request $request)
    {
        $prescriptions = Prescription::with(['diagnose', 'medicine', 'pharmacist'])->latest()->get();
        return view('prescription.index', compact(['prescriptions']));
    }

    public function create()
    {
        $diagnoses = Diagnose::with(['patient', 'doctor'])->latest()->get();
        return view('prescription.create', compact(['diagnoses']));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'diagnose_id' => ['required', 'exists:diagnoses,id'],
            'medicine_id' => ['required', 'exists:medicines,id'],
            'dosage' => ['required', 'string', 'max:255'],
            'notes' => ['nullable', 'string', 'max:255'],
        ]);

        Prescription::create([
            'diagnose_id' => $request->diagnose_id,
            'medicine_id' => $request->medicine_id,
            'pharmacist_id' => Auth::user()->id,
            'dosage' => $request->dosage,
            'notes' => $request->notes,
        ]);

        return redirect()->route('prescriptions.index')->with('success', 'Resep berhasil ditambahkan');
    }


    public function edit(Prescription $prescription)
    {
        return view('prescription.edit', compact(['prescription']));
    }

    public function update(Request $request, Prescription $prescription)
    {
        $this->validate($request, [
            'medicine_id' => ['required', 'exists:medicines,id'],
            'dosage' => ['required', 'string', 'max:255'],
            'notes' => ['nullable', 'string', 'max:255'],
        ]);

        $prescription->update([
            'medicine_id' => $request->medicine_id,
            'dosage' => $request->dosage,
            'notes' => $request->notes,
        ]);

        return redirect()->route('prescriptions.index')->with('success', 'Resep berhasil diupdate');
    }

    public function destroy(Prescription $prescription)
    {
        $prescription->delete();
        return redirect()->route('prescriptions.index')->with('success', 'Resep berhasil dihapus');
    }
}
