<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {

            $table->uuid('id')->primary();
            $table->foreignUuid('teaching_assignment_id')->constrained('teaching_assignments')->onDelete('cascade');
            $table->foreignUuid('student_id')->constrained('students')->onDelete('cascade');
            $table->date('date');
            $table->enum('status', ['hadir', 'sakit', 'izin', 'alpa']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
