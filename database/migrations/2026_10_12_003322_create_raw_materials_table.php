<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('raw_materials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('raw_material_categories')->onDelete('restrict');
            $table->string('name');
            $table->string('code')->unique();
            $table->string('unit_measure');
            $table->decimal('stock_current', 10, 2)->default(0);
            $table->boolean('is_perishable')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('raw_materials');
    }
};