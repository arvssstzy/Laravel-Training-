<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $student = Student::all();
        return response()->json($student);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $student = Student::create(
            $request->only([
                "name",
                "email",
                "course",
                "address",
                "date",
                "active"
             
            ])
            );
        return response()->json(["message" => "successfully inserted", "data" => $student], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = Student::find($id);
        if(!$student || is_null( $student)) return response()->json(["message" => "not found"], 404);
        if($student){
            return response()->json(["message" => "student is available", "data" => $student], 200);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $student = Student::find($id);
        if(!$student || is_null( $student)) return response()->json(["message" => "not found"], 404);

        if($student)
        {
            $student->update(
                $request->all()
            );
            return response()->json(["message" => "updated successfully", "data" => $student], 200);
        }

    

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = Student::find($id);
        if(!$student || is_null( $student)) return response()->json(["message" => "not found"], 404);

        if($student){
            $student->delete();
            return response()->json(["message" => "Successfully Deleted", "data" => $student], 200);
        }
    }
}
