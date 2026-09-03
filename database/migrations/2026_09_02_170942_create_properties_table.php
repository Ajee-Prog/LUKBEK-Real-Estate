<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            // $table->id();
            // $table->string('title');
            // $table->text('description');
            // $table->decimal('price', 15, 2);
            // $table->string('location');
            // $table->integer('bedrooms')->nullable();
            // $table->integer('bathrooms')->nullable();
            // $table->string('type'); // sale, rent
            // $table->string('image');
            // $table->timestamps();
            $table->id();

            $table->string('reference_no')->unique();

            $table->string('title');

            $table->string('slug')->unique();

            $table->longText('description')->nullable();

            $table->foreignId('category_id')->nullable()
                ->constrained('property_categories')->nullOnDelete();

            $table->enum('listing_type', ['sale','rent','lease'
            ])->default('sale');

            $table->decimal('price', 15, 2);

            $table->string('currency')->default('NGN');

            $table->string('location');

            $table->text('address')->nullable();

            $table->unsignedInteger('bedrooms')->nullable();

            $table->unsignedInteger('bathrooms')->nullable();

            $table->unsignedInteger('toilets')->nullable();

            $table->unsignedInteger('parking_spaces')->nullable();

            $table->decimal('property_size', 12, 2)->nullable();

            $table->decimal('land_size', 12, 2)->nullable();

            $table->string('size_unit')->default('sqm');

            $table->year('year_built')->nullable();

            $table->enum('furnished', [
                'furnished',
                'semi-furnished',
                'unfurnished'
            ])->nullable();

            $table->boolean('featured')->default(false);

            $table->boolean('verified')->default(false);

            $table->enum('status', [
                'available',
                'sold',
                'rented',
                'reserved'
            ])->default('available');

            $table->string('video_url')->nullable();

            $table->string('floor_plan')->nullable();

            $table->decimal('latitude', 10, 7)->nullable();

            $table->decimal('longitude', 10, 7)->nullable();

            $table->foreignId('agent_id')->nullable()->constrained('users')
                ->nullOnDelete();

            $table->string('seo_title')->nullable();

            $table->text('seo_description')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
};
