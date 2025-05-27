<?php

namespace App\Http\Controllers;

use App\Models\Diagnose;
use App\Models\Patient;
use App\Models\Prescription;
use App\Models\Vital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $role = Auth::user()->role;

        $totalPatients = Patient::count();
        $totalDiagnoses = Diagnose::count();

        switch ($role) {
            case 'receptionist':
                return view('dashboard.receptionist', [
                    'todayPatientsCount' => Patient::whereDate('created_at', today())->count(),
                    'totalPatients' => $totalPatients,
                    'totalDiagnoses' => $totalDiagnoses,
                ]);
            case 'nurse':
                return view('dashboard.nurse', [
                    'waitingVitals' => Patient::doesntHave('vitals')->count(),
                    'lastVital' => Vital::latest()->first(),
                    'totalPatients' => $totalPatients,
                    'totalDiagnoses' => $totalDiagnoses,
                ]);
            case 'doctor':
                return view('dashboard.doctor', [
                    'undiagnosedCount' => Patient::has('vitals')->doesntHave('diagnosis')->count(),
                    'lastDiagnosis' => Diagnose::latest()->first(),
                    'totalPatients' => $totalPatients,
                    'totalDiagnoses' => $totalDiagnoses,
                ]);
            case 'pharmacist':
                return view('dashboard.pharmacist', [
                    'noPrescriptionCount' => Diagnose::doesntHave('prescriptions')->count(),
                    'lastPrescription' => Prescription::latest()->with('medicine', 'diagnose.patient')->first(),
                    'totalPatients' => $totalPatients,
                    'totalDiagnoses' => $totalDiagnoses,
                ]);
            default:
                abort(403);
        }
    }
}
