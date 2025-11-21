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
        if(Schema::hasTable('tbl_players'))
        {
            if(!Schema::hasColumn('tbl_players','date_of_birth'))
            {
                Schema::table('tbl_players', function(Blueprint $table){
                    $table->string('date_of_birth')->change();
                });
            }
        }

        
        if(Schema::hasTable('tbl_players'))
        {
            if(!Schema::hasColumn('tbl_players','nationality'))
            {
                Schema::table('tbl_players', function(Blueprint $table){
                    $table->string('nationality')->change();
                });
            }
        }

        if(Schema::hasTable('tbl_players'))
        {
            if(!Schema::hasColumn('tbl_players','city'))
            {
                Schema::table('tbl_players', function(Blueprint $table){
                    $table->string('city')->change();
                });
            }
        }

        if(Schema::hasTable('tbl_players'))
        {
            if(!Schema::hasColumn('tbl_players','address'))
            {
                Schema::table('tbl_players', function(Blueprint $table){
                    $table->string('address')->change();
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
