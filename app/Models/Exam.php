<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model {
    protected $fillable = ['student_id','term','subject','marks','remarks'];

    public function student() {
        return $this->belongsTo(Student::class);
    }
}
