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
        Schema::create('production_request_child_elements', function (Blueprint $table) {
            $table->id();
            // Foreign keys
            $table->unsignedBigInteger('po_id'); // FK: production_requests.id
            $table->unsignedBigInteger('child_element_id');// FK: product_child_elements.id

            // Basic information
            $table->integer('quantity')->nullable();
            $table->string('image')->nullable();
            $table->string('name', 255)->nullable();
            $table->decimal('unit_price', 10, 2)->nullable();
            $table->decimal('total_price', 10, 2)->nullable();

            // Supplier information
            $table->string('supplier', 255)->nullable();
            $table->string('supplier_contact_email')->nullable();
            $table->string('supplier_contact_phone', 20)->nullable();

            // Date information
            $table->date('date_order')->nullable();
            $table->date('eta_child')->nullable();
            $table->date('ata_child')->nullable();

            // Status and remarks
            $table->enum('status_child', [
                'pending',
                'approved',
                'shipped',
                'delivered',
                'cancelled'
            ])->default('pending');

            $table->text('inspection_remarks')->nullable();
            $table->text('production_manager_remarks')->nullable();

            // QR code
            $table->string('qr')->nullable()->comment('QR image file path');

            // Timestamps
            $table->timestamps();

            // Indexes
            $table->index('po_id');
            $table->index('child_element_id');
            $table->index('status_child');
            $table->index('supplier');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('production_request_child_elements');
    }
};
