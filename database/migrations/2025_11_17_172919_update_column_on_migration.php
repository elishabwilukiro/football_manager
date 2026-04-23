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
            Schema::table('tbl_players', function(Blueprint $table){
                    $table->renameColumn('city','region');
                });
        }

        if(Schema::hasTable('tbl_players'))
        {
            Schema::table('tbl_players', function(Blueprint $table){
                    $table->string('birth_certificate')->nullable()->after('upload');
                });
        }
        

        if(Schema::hasTable('tbl_players'))
        {
            if(!Schema::hasColumn('tbl_players','birth_certificate_no'))
            {
                Schema::table('tbl_players', function(Blueprint $table){
                    $table->string('birth_certificate_no')->after('date_of_birth');
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
