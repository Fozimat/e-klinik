<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    public function index(Request $request)
    {
        $medicines = Medicine::latest()->get();
        return view('medicine.index', compact(['medicines']));
    }

    public function create()
    {
        return view('medicine.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        Medicine::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('medicines.index')->with('success', 'Obat berhasil ditambahkan');
    }

    public function edit(Medicine $medicine)
    {
        return view('medicine.edit', compact(['medicine']));
    }

    public function update(Request $request, Medicine $medicine)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        $medicine->update([
            'name' => $request->name,
            'description' => $request->description,
            'gender' => $request->gender,
            'phone_number' => $request->phone_number,
        ]);

        return redirect()->route('medicines.index')->with('success', 'Obat berhasil diupdate');
    }

    public function destroy(Medicine $medicine)
    {
        $medicine->delete();
        return redirect()->route('medicines.index')->with('success', 'Obat berhasil dihapus');
    }
}
