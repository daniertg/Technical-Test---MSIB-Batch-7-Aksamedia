<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Division;

class DivisionController extends Controller
{
    public function index(Request $request)
    {
        // Validasi input pencarian
        $request->validate([
            'name' => 'nullable|string'
        ]);

        // Query data division, dengan filter berdasarkan nama jika ada
        $divisions = Division::when($request->name, function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->name . '%');
        })->paginate(10);

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil diambil',
            'data' => [
                'divisions' => $divisions->items(),
            ],
            'pagination' => [
                'current_page' => $divisions->currentPage(),
                'last_page' => $divisions->lastPage(),
                'per_page' => $divisions->perPage(),
                'total' => $divisions->total(),
            ]
        ]);
    }
}

