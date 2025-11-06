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
            if(!Schema::hasColumn('tbl_users','role'))
            {
                Schema::table('tbl_users', function(Blueprint $table){
                    $table->enum('role',['admin','manager'])->default('admin')->after('id');
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         if (Schema::hasTable('tbl_users')) {
            if (Schema::hasColumn('tbl_users', 'role')) {
                Schema::table('tbl_users', function (Blueprint $table) {
                    $table->dropColumn('role');
                });
            }
        }
    }
};
