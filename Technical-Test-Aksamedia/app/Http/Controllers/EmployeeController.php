<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Response;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        // Validasi parameter
        $request->validate([
            'name' => 'nullable|string',
            'division_id' => 'nullable|uuid|exists:divisions,id', // Pastikan division_id ada di tabel divisions
        ]);

        // Ambil data karyawan dengan filter
        $employees = Employee::with('division')
            ->when($request->name, function ($query, $name) {
                return $query->where('name', 'like', '%' . $name . '%');
            })
            ->when($request->division_id, function ($query, $division_id) {
                return $query->where('division_id', $division_id);
            })
            ->paginate(10);

        return response()->json([
            'status' => 'success',
            'message' => 'Data karyawan berhasil diambil',
            'data' => [
                'employees' => $employees->items(),
            ],
            'pagination' => [
                'current_page' => $employees->currentPage(),
                'last_page' => $employees->lastPage(),
                'per_page' => $employees->perPage(),
                'total' => $employees->total(),
            ],
        ]);
    }

    public function store(Request $request)
    {
        // Validasi request
        $validatedData = $request->validate([
            'image' => 'nullable|string',
            'name' => 'required|string',
            'phone' => 'required|string',
            'division_id' => 'required|uuid|exists:divisions,id', // Pastikan division_id ada di tabel divisions
            'position' => 'required|string',
        ]);

        // Buat karyawan baru
        Employee::create($validatedData);

        return response()->json([
            'status' => 'success',
            'message' => 'Data karyawan berhasil ditambahkan',
        ]);
    }

    public function update(Request $request, $uuid)
    {
        // Validasi request
        $validatedData = $request->validate([
            'image' => 'nullable|string',
            'name' => 'required|string',
            'phone' => 'required|string',
            'division' => 'required|uuid',
            'position' => 'required|string',
        ]);

        // Validasi apakah division_id valid
        if (!Division::where('id', $validatedData['division'])->exists()) {
            return response()->json([
                'status' => 'error',
                'message' => 'ID divisi tidak valid',
            ], Response::HTTP_BAD_REQUEST);
        }

        // Cari karyawan berdasarkan UUID
        $employee = Employee::where('id', $uuid)->first();

        // Jika tidak ditemukan, kembalikan response error
        if (!$employee) {
            return response()->json([
                'status' => 'error',
                'message' => 'Karyawan tidak ditemukan',
            ], Response::HTTP_NOT_FOUND);
        }

        // Update data karyawan
        $employee->update([
            'image' => $validatedData['image'] ?? $employee->image,
            'name' => $validatedData['name'],
            'phone' => $validatedData['phone'],
            'division_id' => $validatedData['division'],
            'position' => $validatedData['position'],
        ]);

        // Kembalikan response sukses
        return response()->json([
            'status' => 'success',
            'message' => 'Data karyawan berhasil diperbarui',
        ]);
    }
}
