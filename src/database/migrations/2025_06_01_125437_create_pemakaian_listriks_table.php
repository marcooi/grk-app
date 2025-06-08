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
        Schema::create('pemakaian_listriks', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('whse');
            $table->timestamp('workdate');
            $table->string('nama_gedung');
            $table->string('skema_pembayaran');
            $table->string('scope');
            $table->decimal('kwh', 10, 2);
            $table->string('created_by');
            $table->string('updated_by');
            $table->timestamp('deleted_at')->nullable(); // Optional: for soft deletes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemakaian_listriks');
    }
};
