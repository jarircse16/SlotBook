<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
     public function up()
     {
         Schema::table('emails', function (Blueprint $table) {
             $table->date('notif_date')->after('email');  // Adds notif_date after the email column
         });
     }

    /**
     * Reverse the migrations.
     */
     public function down()
     {
         Schema::table('emails', function (Blueprint $table) {
             $table->dropColumn('notif_date');
         });
     }
};
