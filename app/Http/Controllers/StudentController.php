<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('students.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string'],
            'gender' => ['required', 'string'],
            'date' => ['required', 'date'],
            'address' => ['required', 'string'],
        ]);

        Student::create($validatedData);

        return to_route('students.index')->with('success', 'Berhasil menambah siswa baru');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string'],
            'gender' => ['required', 'string'],
            'date' => ['required', 'date'],
            'address' => ['required', 'string'],
        ]);

        $student->update($validatedData);

        return to_route('students.index')->with('success', 'Berhasil mengedit siswa');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        try {
            $student->delete();
            return [
                'statusCode' => 200,
                'title' => 'success',
                'message'=> 'Berhasil menghapus siswa'
            ];
        } catch (\Throwable $th) {
            return [
                'statusCode' => 400,
                'title' => 'failed',
                'message'=> 'gagal menghapus siswa, silakan coba lagi'
            ];
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function searchStudent(Request $request)
    {

        $students = DB::table('students')->where('name','LIKE','%'.$request->search.'%')
        ->orWhere('gender','LIKE','%'.$request->search.'%')
        ->orWhere('date','LIKE','%'.$request->search.'%')
        ->orWhere('address','LIKE','%'.$request->search.'%')
        ->orderBy('name')
        ->get();

        return response()->json($students);
    }
}
