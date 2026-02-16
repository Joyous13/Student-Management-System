<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClassModel;

class ClassSeeder extends Seeder {
    public function run() {
        $classes = ['1A','1B','2A','2B','3A','4A','5A','6A','7A','8A','9A','10A'];
        foreach($classes as $c) {
            ClassModel::firstOrCreate(['name' => $c]);
        }
    }
}
