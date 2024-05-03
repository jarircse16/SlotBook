<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLatestResponsesTable extends Migration
{
    public function up()
    {
        Schema::create('latest_responses', function (Blueprint $table) {
            $table->id();
            $table->text('json_data'); // Large text field for JSON data
            $table->timestamps(); // Optional, but useful for tracking updates
        });
    }

    public function down()
    {
        Schema::dropIfExists('latest_responses');
    }
}
