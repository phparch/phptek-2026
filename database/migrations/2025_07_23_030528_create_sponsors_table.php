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
        if (! Schema::hasTable('sponsors')) {
            Schema::create('sponsors', function (Blueprint $table) {

                $table->id();
                $table->uuid('uuid')->unique();
                $table->string('name')->unique();
                $table->string('website');
                $table->string('slug')->unique();
                $table->string('logo')->nullable();
                $table->string('description')->nullable();
                $table->json('socials')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sponsors');
    }
};
