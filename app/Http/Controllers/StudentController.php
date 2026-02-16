<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Services\StudentService;

class StudentController extends Controller
{
    protected $studentService;

    public function __construct(StudentService $studentService)
    {
        $this->middleware('auth');
        $this->studentService = $studentService;
    }

    public function index(Request $request)
    {
        $students = $this->studentService->getStudents($request->only('class_id', 'q'));
        $classes = ClassModel::orderBy('name')->get();

        return view('students.index', compact('students','classes'));
    }

    public function create()
    {
        $classes = ClassModel::orderBy('name')->get();
        return view('students.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'nullable|integer|min:1|max:100',
            'class_id' => 'nullable|exists:classes,id',
            'parent_name' => 'nullable|string|max:255',
            'parent_phone' => 'nullable|string|max:50',
            'parent_email' => 'nullable|email|max:255',
            'parent_address' => 'nullable|string|max:500',
            'photo' => 'nullable|image|max:2048',
        ]);

        $student = $this->studentService->createStudent($data, $request->file('photo'));

        return redirect()->route('students.show', $student)->with('success','Student created');
    }

    public function show(Student $student)
    {
        $student->load(['files','exams','class']);
        return view('students.show', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'nullable|integer|min:1|max:100',
            'class_id' => 'nullable|exists:classes,id',
            'parent_name' => 'nullable|string|max:255',
            'parent_phone' => 'nullable|string|max:50',
            'parent_email' => 'nullable|email|max:255',
            'parent_address' => 'nullable|string|max:500',
            'photo' => 'nullable|image|max:2048',
        ]);

        $this->studentService->updateStudent($student, $data, $request->file('photo'));

        return redirect()->route('students.show', $student)->with('success','Student updated');
    }

    public function display($id)
    {
        $student = Student::with(['class','files'])->findOrFail($id);
        return view('students.display', compact('student'));
    }

    public function destroy(Student $student)
    {
        $this->studentService->deleteStudent($student);

        return redirect()->route('students.index')->with('success','Student deleted');
    }
}
