<?php
namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }

    // store multiple subject marks for a student (one row per subject)
    public function store(Request $request, Student $student) {
        $request->validate([
            'term' => 'required|string|max:255',
            'subjects' => 'required|array',
            'subjects.*.subject' => 'required|string|max:255',
            'subjects.*.marks' => 'nullable|integer|min:0|max:100',
            'subjects.*.remarks' => 'nullable|string|max:500',
        ]);

        $term = $request->term;

        foreach ($request->subjects as $s) {
            Exam::create([
                'student_id' => $student->id,
                'term' => $term,
                'subject' => $s['subject'],
                'marks' => $s['marks'] ?? null,
                'remarks' => $s['remarks'] ?? null
            ]);
        }

        return back()->with('success','Exam entries added');
    }

    public function update(Request $request, Exam $exam) {
        $data = $request->validate([
            'term' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'marks' => 'nullable|integer|min:0|max:100',
            'remarks' => 'nullable|string|max:500',
        ]);
        $exam->update($data);
        return back()->with('success','Exam updated');
    }

    public function destroy(Exam $exam) {
        $exam->delete();
        return back()->with('success','Exam removed');
    }
}
