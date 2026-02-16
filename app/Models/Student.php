<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model {
    use HasFactory;

    protected $fillable = [
        'name','age','class_id','parent_name','parent_phone','parent_email','parent_address','photo_path',
    ];

    public function class() {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    public function files() {
        return $this->hasMany(StudentFile::class);
    }

    public function exams() {
        return $this->hasMany(Exam::class);
    }
}
