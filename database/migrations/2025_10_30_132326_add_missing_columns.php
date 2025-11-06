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
            if(!Schema::hasColumn('tbl_players','archive'))
            {
                Schema::table('tbl_players', function(Blueprint $table){
                    $table->enum('archive',['0','1'])->default(0)->after('status');
                });
            }
        }


        if(Schema::hasTable('tbl_users'))
        {
            if(!Schema::hasColumn('tbl_users','archive'))
            {
                Schema::table('tbl_users', function(Blueprint $table){
                    $table->enum('archive',['0','1'])->default(0)->after('status');
                });
            }
        }


        if(Schema::hasTable('tbl_positions'))
        {
            if(!Schema::hasColumn('tbl_positions','archive'))
            {
                Schema::table('tbl_positions', function(Blueprint $table){
                    $table->enum('archive',['0','1'])->default(0)->after('status');
                });
            }
        }

        if(Schema::hasTable('tbl_matches'))
        {
            if(!Schema::hasColumn('tbl_matches','archive'))
            {
                Schema::table('tbl_matches', function(Blueprint $table){
                    $table->enum('archive',['0','1'])->default(0)->after('status');
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
