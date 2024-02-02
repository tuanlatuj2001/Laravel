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
        Schema::create('deparments', function (Blueprint $table) {
            $table->id();
            $table->string('deparment_name');
            $table->string('floor');
            $table->string('until');
            $table->string('building');
            $table->string('street');
            $table->string('city');
            $table->string('state');
            $table->unsignedBigInteger('countrie_id');
            $table->foreign('countrie_id')->references('id')->on('countries')->cascadeOnUpdate()
            ->cascadeOnDelete();
            $table->string('zipcode');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deparments');
    }
};
