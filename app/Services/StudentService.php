<?php

namespace App\Services;

use App\Models\Student;
use Illuminate\Support\Facades\Storage;

class StudentService
{
    // Fetch students for index page
    public function getStudents($filters = [])
    {
        $query = Student::with('class');

        if (!empty($filters['class_id'])) {
            $query->where('class_id', $filters['class_id']);
        }

        if (!empty($filters['q'])) {
            $query->where('name', 'like', "%{$filters['q']}%");
        }

        return $query->orderBy('name')->paginate(20)->withQueryString();
    }

    // Create a new student
    public function createStudent(array $data, $photo = null)
    {
        if ($photo) {
            $data['photo_path'] = $photo->store("student_photos", 'public');
        }

        $student = Student::create($data);
        cache()->forget('students_count_per_class');

        return $student;
    }

    // Update an existing student
    public function updateStudent(Student $student, array $data, $photo = null)
    {
        if ($photo) {
            if ($student->photo_path) Storage::disk('public')->delete($student->photo_path);
            $data['photo_path'] = $photo->store("student_photos", 'public');
        }

        $student->update($data);
        cache()->forget('students_count_per_class');

        return $student;
    }

    // Delete a student
    public function deleteStudent(Student $student)
    {
        foreach ($student->files as $file) {
            Storage::disk('public')->delete($file->path);
            $file->delete();
        }

        if ($student->photo_path) {
            Storage::disk('public')->delete($student->photo_path);
        }

        $student->delete();
        cache()->forget('students_count_per_class');
    }
}
