<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->string('term'); // e.g., "Term 1 - 2025"
            $table->string('subject'); // e.g., "Math"
            $table->unsignedSmallInteger('marks')->nullable(); // marks (0-100)
            $table->string('remarks')->nullable();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('exams');
    }
};
