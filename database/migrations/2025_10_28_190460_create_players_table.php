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

        Schema::create('tbl_players', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained('tbl_teams')->onDelete('cascade');
            $table->foreignId('position_id')->constrained('tbl_positions')->onDelete('cascade');
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->string('phone_number')->unique();
            $table->date('date_of_birth')->nullable();
            $table->string('registration_number')->nullable();
            $table->string('national_id')->nullable();
            $table->integer('jersey_number')->nullable();
            $table->string('upload')->nullable();
            $table->enum('status',['active','in_active'])->default('active');
            $table->foreignId('created_by')->constrained('tbl_users')->OnDelete('cascade');
            $table->foreignId('updated_by')->constrained('tbl_users')->OnDelete('cascade');
            $table->unique(['team_id','jersey_number']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_players');
    }
};
