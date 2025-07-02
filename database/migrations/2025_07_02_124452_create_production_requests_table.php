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
        Schema::create('production_requests', function (Blueprint $table) {
            $table->id();
            $table->string('job_number');
            $table->string('product_name');
            $table->string('project_name');
            $table->string('customer');
            $table->integer('no_of_structures');
            $table->integer('no_of_workers');
            $table->integer('feeders');
            $table->integer('main');
            $table->integer('tie');
            $table->date('request_date');
            $table->date('start_date');
            $table->date('end_date');
            $table->date('etd');  // Estimated Time of Departure
            $table->date('atd');  // Actual Time of Departure
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('production_requests');
    }
};
