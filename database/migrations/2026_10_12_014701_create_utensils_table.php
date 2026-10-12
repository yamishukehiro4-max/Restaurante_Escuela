<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('utensils', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category');
            $table->integer('quantity_total')->default(0);
            $table->integer('quantity_available')->default(0);
            $table->integer('quantity_damaged')->default(0);
            $table->string('unit_measure')->default('Unidades');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('utensils');
    }
};