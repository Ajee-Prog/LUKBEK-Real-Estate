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
        Schema::create('leads', function (Blueprint $table) {
            // $table->id();
            // $table->string('name');
            // $table->string('email');
            // $table->string('phone');
            // $table->text('message');
            // $table->timestamps();
            $table->id();

    $table->foreignId('property_id')->nullable()->constrained('properties')
        ->OnDelete('set null');

    $table->foreignId('agent_id')->nullable()->constrained('users')
        ->nullOnDelete();

    $table->string('name');

    $table->string('email')
        ->nullable();

    $table->string('phone');

    $table->enum('source', [
        'website',
        'whatsapp',
        'phone',
        'referral',
        'social_media',
        'other'
    ])->default('website');

    $table->enum('status', [
        'new',
        'contacted',
        'qualified',
        'inspection',
        'negotiation',
        'closed',
        'lost'
    ])->default('new');

    $table->text('notes')
        ->nullable();

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
        Schema::dropIfExists('leads');
    }
};
