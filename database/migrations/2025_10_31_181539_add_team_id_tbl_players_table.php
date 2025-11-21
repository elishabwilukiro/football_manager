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
            if(!Schema::hasColumn('tbl_players','address'))
            {
                Schema::table('tbl_players', function(Blueprint $table){
                    $table->string('address')->nullable()->after('national_id');
                });
            }
        }

        if(Schema::hasTable('tbl_players'))
        {
            if(!Schema::hasColumn('tbl_players','city'))
            {
                Schema::table('tbl_players', function(Blueprint $table){
                    $table->string('city')->nullable()->after('national_id');
                });
            }
        }

        if(Schema::hasTable('tbl_players'))
        {
            if(!Schema::hasColumn('tbl_players','nationality'))
            {
                Schema::table('tbl_players', function(Blueprint $table){
                    $table->string('nationality')->nullable()->after('national_id');
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
