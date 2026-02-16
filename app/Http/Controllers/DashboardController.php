<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\ClassModel;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller {

 public function index(Request $request) {

    $classId  = $request->class_id;
    $subject  = $request->subject;
    $term     = $request->term;

    $query = DB::table('exams')
        ->join('students','students.id','=','exams.student_id')
        ->join('classes','classes.id','=','students.class_id');

    if ($classId) $query->where('classes.id', $classId);
    if ($subject) $query->where('exams.subject', $subject);
    if ($term) $query->where('exams.term', $term);

    // Exam Data: Average Marks Per Subject
    $marksData = $query
        ->select(
            'classes.name as class',
            'exams.subject',
            'exams.term',
            DB::raw('avg(exams.marks) as avg_marks')
        )
        ->groupBy('classes.name','exams.subject','exams.term')
        ->get();

    // -------- Graph 1 : Subjects vs Marks --------
    $labels  = $marksData->pluck('subject')->toArray();
    $values  = $marksData->pluck('avg_marks')->toArray();

    // -------- Graph 2 : Students per Class --------
    $perClass = Student::select('classes.name', DB::raw('COUNT(students.id) as student_count'))
        ->join('classes','classes.id','=','students.class_id')
        ->groupBy('classes.name')
        ->get();

    $classLabels = $perClass->pluck('name')->toArray();
    $classCounts = $perClass->pluck('student_count')->toArray();

    // Extra dropdown lists
    $allClasses = ClassModel::orderBy('name')->get();
    $allSubjects = DB::table('exams')->select('subject')->distinct()->get();
    $allTerms = DB::table('exams')->select('term')->distinct()->get();
    
    $totalStudents = Student::count();

    return view('dashboard.index', compact(
        'marksData','labels','values',
        'classId','subject','term',
        'allClasses','allSubjects','allTerms',
        'totalStudents','perClass',
        'classLabels','classCounts' // send class data for 2nd chart
    ));
}

}
