<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;

class DatatableController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //student
    public function getStudent(){
        $students = Student::orderBy('name')->get();
        return datatables()->of($students)
        ->addColumn('action', function($row){
            $id = $row->id;
            $edit = route('students.edit', $id);
            $delete = route('students.destroy', $id);
            $token = csrf_token();
            $output = '<button type="button" class="btn btn-sm btn-warning d-inline" onclick="editStudentHandler(\'' . $id . '\')" title="Edit '.$row->name.'"><i class="fa-solid fa-pen-to-square"></i></button>
                <button type="button" class="btn btn-sm btn-danger d-inline" onclick="deleteStudentHandler(\'' . $id . '\',\'' . $row->name . '\')" title="Hapus '.$row->name.'"><i class="fa-solid fa-trash"></i></button>';
            return $output;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    //user
    public function getUser(){
        $user = User::orderBy('name')->get();
        return datatables()->of($user)
        ->editColumn('created_at', function($row){
            return $row->created_at->diffForHumans();
        })
        ->make(true);
    }
}
