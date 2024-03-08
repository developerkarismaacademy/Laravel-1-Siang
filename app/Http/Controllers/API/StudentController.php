<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all();

        return response()->json([
            'success' => true,
            'message' => 'OK',
            'data' => $students
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'address' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal!',
                'data' => $validator->errors()
            ]);
        }

        $student = Student::create([
            'name' => $request->name,
            'address' => $request->address
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dibuat',
            'data' => $student
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        try {
            $student = Student::findOrFail($id);
        } catch (ModelNotFoundException $err) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'OK',
            'data' => $student
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'address' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal!',
                'data' => $validator->errors()
            ]);
        }

        try {
            $student = Student::findOrFail($id);
        } catch (ModelNotFoundException $err) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }

        $student->update([
            'name' => $request->name,
            'address' => $request->address
        ]);

        return response()->json([
            'success' => true,
            'message' => 'OK',
            'data' => $student
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $student = Student::findOrFail($id);
        } catch (ModelNotFoundException $err) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }

        $student->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus'
        ]);
    }
}
