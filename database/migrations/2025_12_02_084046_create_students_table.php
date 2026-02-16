<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedTinyInteger('age')->nullable();
            $table->unsignedBigInteger('class_id')->nullable();
            $table->foreign('class_id')
                  ->references('id')->on('classes')
                  ->onDelete('set null');
            $table->string('parent_name')->nullable();
            $table->string('parent_phone')->nullable();
            $table->string('parent_email')->nullable();
            $table->string('photo_path')->nullable(); // path in storage
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('students');
    }
};
