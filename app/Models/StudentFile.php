<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentFile extends Model {
    protected $fillable = ['student_id','original_name','path','mime','size','uploaded_by'];

    public function student() {
        return $this->belongsTo(Student::class);
    }

    public function uploader() {
        return $this->belongsTo(\App\Models\User::class, 'uploaded_by');
    }

    // helper to get URL
    public function url() {
        return \Storage::url($this->path);
    }
}
