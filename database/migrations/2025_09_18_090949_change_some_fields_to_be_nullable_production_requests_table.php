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
        Schema::table('production_requests', function (Blueprint $table) {
            $table->string('no_of_structures')->nullable()->change();
            $table->string('no_of_workers')->nullable()->change();
            $table->string('feeders')->nullable()->change();
            $table->string('main')->nullable()->change();
            $table->string('tie')->nullable()->change();
            $table->date('start_date')->nullable()->change();
            $table->date('end_date')->nullable()->change();
            $table->date('atd')->nullable()->change();
            $table->string('po_number')->after('id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('production_requests', function (Blueprint $table) {
            $table->string('no_of_structures')->nullable(false)->change();
            $table->string('no_of_workers')->nullable(false)->change();
            $table->string('feeders')->nullable(false)->change();
            $table->string('main')->nullable(false)->change();
            $table->string('tie')->nullable(false)->change();
            $table->date('start_date')->nullable(false)->change();
            $table->date('end_date')->nullable(false)->change();
            $table->date('atd')->nullable(false)->change();
            $table->dropColumn('po_number');
        });
    }
};
