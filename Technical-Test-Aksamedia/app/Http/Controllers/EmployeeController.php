<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        // Validasi parameter
        $request->validate([
            'name' => 'nullable|string',
            'division_id' => 'nullable|uuid',
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
        $validatedData = $request->validate([
            'image' => 'nullable|string',
            'name' => 'required|string',
            'phone' => 'required|string',
            'division_id' => 'required|uuid',
            'position' => 'required|string',
        ]);

        Employee::create($validatedData);

        return response()->json([
            'status' => 'success',
            'message' => 'Data karyawan berhasil ditambahkan',
        ]);
    }
}
