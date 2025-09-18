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
            $table->string('job_number', 100)->nullable();
            $table->string('po_number', 100)->unique();
            $table->unsignedBigInteger('product_name_id');//FK:products.id
            $table->string('project_name')->nullable();
            $table->string('customer');//customer name
            $table->string('customer_contact_email');
            $table->string('customer_contact_phone', 20);
            $table->enum('status', ['pending', 'approved', 'shifted', 'delivered', 'cancelled'])->default('pending');
            $table->text('actions')->nullable();
            $table->integer('no_of_structures')->nullable();
            $table->integer('no_of_workers')->nullable();
            $table->integer('feeders')->nullable();
            $table->integer('main')->nullable();
            $table->integer('tie')->nullable();
            $table->date('request_date')->nullable();//order date
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->date('etd')->nullable();  // Estimated Time of Departure
            $table->date('atd')->nullable();  // Actual Time of Departure
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
