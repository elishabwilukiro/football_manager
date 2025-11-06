<?php

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if(Schema::hasTable('tbl_teams'))
        {
            if(!Schema::hasColumn('tbl_teams','founded_year'))
            {
                Schema::table('tbl_teams', function(Blueprint $table){
                    $table->string('founded_year')->nullable()->default(Carbon::now())->after('logo');
                });
            }

            if(!Schema::hasColumn('tbl_teams','archive'))
            {
                Schema::table('tbl_teams', function(Blueprint $table){
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
        Schema::table('tbl_teams', function (Blueprint $table) {
            //
        });
    }
};
