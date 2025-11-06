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
        Schema::create('tbl_teams', function (Blueprint $table) {
            $table->id();
            $table->string('team_name')->unique();
            $table->string('registration_number')->unique();
            $table->string('registration_certificate')->unique();
            $table->string('city')->nullable();
            $table->string('team_address')->nullable();
            $table->string('team_email')->nullable();
            $table->string('team_number')->nullable();
            $table->string('stadium')->nullable();
            $table->year('founded_year')->nullable();
            $table->string('logo')->nullable();
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
        Schema::dropIfExists('tbl_teams');
    }
};
