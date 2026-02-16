<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\StudentFile;
use Illuminate\Support\Facades\Storage;

class StudentFileController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    // Upload multiple files
    
    public function store(Request $request, Student $student) {
        $request->validate([
            'files.*' => 'required|file|max:30240' // max 30MB per file
        ]);

        foreach ($request->file('files') ?? [] as $file) {
            $original = $file->getClientOriginalName();
            $path = $file->store("student_files/{$student->id}", 'public');

            $student->files()->create([
                'original_name' => $original,
                'path' => $path,
                'mime' => $file->getClientMimeType(),
                'size' => $file->getSize(),
                'uploaded_by' => $request->user()->id
            ]);
        }

        return back()->with('success','Files uploaded');
    }

    public function download(StudentFile $file) {
        // check file exists
        if (!Storage::disk('public')->exists($file->path)) {
            abort(404);
        }
        return Storage::disk('public')->download($file->path, $file->original_name);
    }

    public function destroy(StudentFile $file) {
        Storage::disk('public')->delete($file->path);
        $file->delete();
        return back()->with('success','File removed');
    }
}
