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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');

            $table->string('email')->nullable();
            $table->string('phone')->nullable();

            $table->string('whatsapp')->nullable();

            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->default('Nigeria');

            $table->enum('customer_type', [
                'buyer',
                'seller',
                'tenant',
                'landlord',
                'investor',
                'other'
            ])->default('buyer');

            $table->enum('status', [
                'active',
                'inactive',
                'blocked'
            ])->default('active');

            $table->text('notes')->nullable();

            $table->timestamps();

            $table->index('email');
            $table->index('phone');
            $table->index('customer_type');
            $table->index('status');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
};
