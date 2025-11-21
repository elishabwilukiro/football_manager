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
        if(Schema::hasTable('tbl_users'))
        {
            if(!Schema::hasColumn('tbl_users','team_id'))
            {
                Schema::table('tbl_users', function(Blueprint $table){
                    $table->integer('team_id')->nullable()->after('phone_number');
                });
            }

            if(!Schema::hasColumn('tbl_users','location'))
            {
                Schema::table('tbl_users', function(Blueprint $table){
                    $table->string('location')->nullable()->after('phone_number');
                });
            }
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
