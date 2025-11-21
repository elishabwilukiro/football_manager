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
        if(Schema::hasTable('tbl_teams'))
        {
            if(!Schema::hasColumn('tbl_teams','registration_certificate'))
            {
                Schema::table('tbl_teams', function(Blueprint $table){
                    $table->string('registration_certificate')->after('logo');
                });
            }
        }

        if(Schema::hasTable('tbl_teams'))
        {
            Schema::table('tbl_teams', function(Blueprint $table){
                    $table->renameColumn('city','region');
                });
        }

        if(Schema::hasTable('tbl_teams'))
        {
            Schema::table('tbl_teams', function(Blueprint $table){
                    $table->renameColumn('team_address','address');
                });
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
