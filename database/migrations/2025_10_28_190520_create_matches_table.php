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
        Schema::create('tbl_matches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('home_team_id')->constrained('tbl_teams')->onDelete('cascade');
            $table->foreignId('away_team_id')->constrained('tbl_teams')->onDelete('cascade');
            $table->dateTime('match_date')->nullable();
            $table->integer('home_score')->nullable();
            $table->integer('away_score')->nullable();
            $table->string('venue')->nullable();
            $table->string('upload')->nullable();
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
        Schema::dropIfExists('tbl_matches');
    }
};
