<?php

namespace App\Http\Controllers;

use App\Exports\StudentExport;
use App\Models\Student;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    // Menampilkan semua data siswa
    public function index()
    {
        $students = Student::all();

        return view('admin.students.index', compact('students'));
    }

    // Menampilkan halaman form create siswa
    public function create()
    {
        return view('admin.students.create');
    }

    // Proses input data dari create
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required'
        ]);

        Student::create([
            'name' => $request->name,
            'address' => $request->address
        ]);

        return redirect()->route('student.index');
    }

    // Menampilkan halaman form edit siswa
    public function edit($id)
    {
        $student = Student::find($id);
        return view('admin.students.edit', compact('student'));
    }

    // Proses update data dari edit
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required'
        ]);

        $student = Student::find($id);

        $student->update([
            'name' => $request->name,
            'address' => $request->address
        ]);

        return redirect()->route('student.index');
    }

    public function destroy($id)
    {
        $student = Student::find($id);
        $student->delete();

        return redirect()->route('student.index');
    }

    public function export()
    {
        return Excel::download(new StudentExport, 'student.xlsx');
    }
}
