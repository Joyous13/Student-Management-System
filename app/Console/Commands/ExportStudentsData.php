<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Student;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ArrayExport;
use Illuminate\Support\Facades\Storage;

class ExportStudentsData extends Command
{
    protected $signature = 'export:students';     // command name
    protected $description = 'Export students to Excel every 5 min';

    public function handle()
    {
        // Fetch data
        $students = Student::select('id','name','age','parent_name','parent_phone','parent_email')->get()->toArray();

        // Export using your ArrayExport class
        $fileName = 'students_' . now()->format('Y_m_d_H_i') . '.xlsx';

        Excel::store(new ArrayExport($students), 'exports/'.$fileName);

        $this->info("Exported Excel File: ".$fileName);
    }
}
