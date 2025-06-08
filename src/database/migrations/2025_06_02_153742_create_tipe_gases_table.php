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
        Schema::create('tipe_gases', function (Blueprint $table) {
            $table->id();  // Auto-increment primary key
            $table->string('name');             
            $table->decimal('tabung', 8, 2);
            $table->string('satuan_tabung'); 
            $table->decimal('kgs', 8, 2);  // Numeric column for kgs, with a precision of 8 and scale of 2 (e.g., 123456.78)
            $table->timestamp('deleted_at')->nullable(); // Optional: for soft deletes
            $table->timestamps();  // Timestamps to track creation and update times
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipe_gases');
    }
};
