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
        Schema::create('alats', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // Foreign key to categories table
            $table->foreignId('tipe_id')->constrained()->onDelete('cascade');     // Foreign key to tipes table
            $table->string('no_seri')->unique();                                 // Serial number, unique
            $table->date('tanggal_tera');                                        // Date of calibration
            $table->date('masa_berlaku_start');                                  // Validity start date
            $table->date('masa_berlaku_end');                                    // Validity end date
            $table->text('keterangan')->nullable();                              // Additional notes, nullable
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alats');
    }
};
