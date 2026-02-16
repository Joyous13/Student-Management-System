<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function export(Request $request)
    {
        $query = Student::with(['class', 'exams']);

        if ($request->filled('class_id')) {
            $query->where('class_id', $request->class_id);
        }

        if ($request->filled('term')) {
            $query->whereHas('exams', fn($q) => $q->where('term', $request->term));
        }

        if ($request->filled('subject')) {
            $query->whereHas('exams', fn($q) => $q->where('subject', $request->subject));
        }

        $students = $query->get();

        $header = [
            'ID','Name','Age','Class',
            'Parent Name','Parent Phone','Parent Email',
            'Term','Subject','Marks'
        ];

        $rows = [];

        foreach ($students as $student) {
            if($student->exams->isEmpty()){
                $rows[] = [
                    $student->id,$student->name,$student->age,$student->class?->name,
                    $student->parent_name,$student->parent_phone,$student->parent_email,
                    '','',''
                ];
                continue;
            }

            foreach ($student->exams as $exam){
                $rows[] = [
                    $student->id,$student->name,$student->age,$student->class?->name,
                    $student->parent_name,$student->parent_phone,$student->parent_email,
                    $exam->term,$exam->subject,$exam->marks
                ];
            }
        }

        $filename = 'students_export_'.date('Ymd_His').'.csv';

        return response()->streamDownload(function() use($rows,$header){
            $file = fopen('php://output', 'w');
            fputcsv($file, $header);

            foreach ($rows as $row) {
                fputcsv($file, $row);
            }
            fclose($file);
        }, $filename);
    }
}
