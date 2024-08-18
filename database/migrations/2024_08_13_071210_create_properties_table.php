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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->integer('country_id')->nullable();
            $table->integer('city_id')->nullable();
            $table->integer('property_size_id')->nullable();
            $table->integer('property_type_id')->nullable();
            $table->integer('property_amenitiy_id')->nullable();
            $table->string('name');
            $table->string('slug');
            $table->string('location')->nullable();
            $table->string('bedroom')->nullable();
            $table->string('bathroom')->nullable();
            $table->string('starting_price')->nullable();
            $table->string('selling_price')->nullable();
            $table->string('stock_quantity')->nullable();
            $table->string('flatside')->nullable();
            $table->text('description')->nullable();
            $table->text('address')->nullable();
            $table->text('map_url')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('images')->nullable();
            $table->string('status')->nullable();
            $table->string('property_views')->default(1);
            $table->string('admin_id')->nullable();
            $table->string('date')->nullable();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
