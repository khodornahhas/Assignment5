<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
class StudentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = trim($request->input('search'));
            $minAge = $request->input('minAge'); 
            $maxAge = $request->input('maxAge'); 
    
            $students = Student::query();
            if (!empty($query)) {
                $students->where('name', 'LIKE', "%{$query}%");
            }
            if (!empty($minAge)) {
                $students->where('age', '>=', $minAge);
            } 
            if (!empty($maxAge)) {
                $students->where('age', '<=', $maxAge);
            }
            return response()->json($students->get(), 200);
        }
    
        $students = Student::all();
        return view('index', compact('students'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'age'  => 'required|integer',
        ]);

        Student::create([
            'name' => $request->name,
            'age'  => $request->age,
        ]);

        return redirect()->route('students.index')->with('success', 'student added successfully!');
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('edit', compact('student'));
    }

    public function update(Request $request, Student $student) {
        $data = $request->validate([
            'name' => 'required|string',
            'age' => 'required|integer',
        ]);
    
        $student->update($data);
    
        return redirect()->route('students.index')->with('success', 'student updated successfully!');
    }
    
    

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('students.index');
    }

    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view('show', compact('student'));
    }
}

