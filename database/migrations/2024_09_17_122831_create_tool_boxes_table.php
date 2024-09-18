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
        Schema::create('tool_boxes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->unique()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained();
            $table->unsignedInteger('count');

            $table->dateTimes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tool_boxes');
    }
};
