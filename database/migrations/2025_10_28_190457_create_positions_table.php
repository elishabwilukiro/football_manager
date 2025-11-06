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
        Schema::create('tbl_positions', function (Blueprint $table) {
            $table->id();
            $table->string('position_name')->nullable();
            $table->string('position_description')->nullable();
            $table->enum('status',['active','in_active'])->default('active');
            $table->foreignId('created_by')->constrained('tbl_users')->OnDelete('cascade');
            $table->foreignId('updated_by')->constrained('tbl_users')->OnDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_positions');
    }
};
