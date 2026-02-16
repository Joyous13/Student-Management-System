<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendGradeReports extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-grade-reports';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Inside the handle() method...
$students = \App\Models\Student::with('exams')->get();

foreach ($students as $student) {
    // Example of using a model method (like the helper you asked about earlier!)
    $average = $student->exams->avg('grade');

    // Logic to format and send the report...
    $this->info("Processing report for student: {$student->name} (Avg: {$average})");

    // Example: Mail::to($student->parent_email)->send(new GradeReportMail($student, $average));
}
    }
}
