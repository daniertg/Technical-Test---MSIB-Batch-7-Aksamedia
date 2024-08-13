<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Division;

class DivisionController extends Controller
{
    public function index(Request $request)
    {
        $query = Division::query();

        // Filter berdasarkan nama
        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        // Ambil data dengan pagination
        $divisions = $query->paginate(10);

        return response()->json([
            'status' => 'success',
            'message' => 'Data divisi berhasil diambil',
            'data' => [
                'divisions' => $divisions->items(),
            ],
            'pagination' => [
                'current_page' => $divisions->currentPage(),
                'last_page' => $divisions->lastPage(),
                'per_page' => $divisions->perPage(),
                'total' => $divisions->total(),
            ],
        ]);
    }
}
