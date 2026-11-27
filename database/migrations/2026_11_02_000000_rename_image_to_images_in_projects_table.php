<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Ganti nama kolom image -> images tanpa menghapus data
        if (Schema::hasColumn('projects', 'image') && !Schema::hasColumn('projects', 'images')) {
            Schema::table('projects', function (Blueprint $table) {
                $table->renameColumn('image', 'images');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('projects', 'images') && !Schema::hasColumn('projects', 'image')) {
            Schema::table('projects', function (Blueprint $table) {
                $table->renameColumn('images', 'image');
            });
        }
    }
};
