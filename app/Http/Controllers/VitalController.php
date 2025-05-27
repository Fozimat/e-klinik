<?php

namespace App\Http\Controllers;

use App\Models\Vital;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VitalController extends Controller
{
    public function index(Request $request)
    {
        $vitals = Vital::with(['patient', 'nurse'])->latest()->get();
        return view('vital.index', compact(['vitals']));
    }

    public function create()
    {
        $patients = Patient::latest()->get();
        return view('vital.create', compact(['patients']));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'patient_id' => ['required', 'exists:patients,id'],
            'weight' => ['required', 'numeric'],
            'systolic' => ['required', 'numeric'],
            'diastolic' => ['required', 'numeric'],
        ]);

        Vital::create([
            'patient_id' => $request->patient_id,
            'nurse_id' => Auth::user()->id,
            'weight' => $request->weight,
            'systolic' => $request->systolic,
            'diastolic' => $request->diastolic,
        ]);

        return redirect()->route('vitals.index')->with('success', 'Vital Sign berhasil ditambahkan');
    }

    public function edit(Vital $vital)
    {
        return view('vital.edit', compact(['vital']));
    }

    public function update(Request $request, Vital $vital)
    {
        $this->validate($request, [
            'weight' => ['required', 'numeric'],
            'systolic' => ['required', 'numeric'],
            'diastolic' => ['required', 'numeric'],
        ]);

        $vital->update([
            'weight' => $request->weight,
            'systolic' => $request->systolic,
            'diastolic' => $request->diastolic,
        ]);

        return redirect()->route('vitals.index')->with('success', 'Vital Sign berhasil diupdate');
    }

    public function destroy(Vital $vital)
    {
        $vital->delete();
        return redirect()->route('vitals.index')->with('success', 'Vital Sign berhasil dihapus');
    }
}
