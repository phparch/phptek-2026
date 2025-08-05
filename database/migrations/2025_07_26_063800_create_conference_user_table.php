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
        if (! Schema::hasTable('conference_user')) {
            Schema::create('conference_user', function (Blueprint $table) {
                $table->id();
                $table->uuid('conference_uuid');
                $table->uuid('user_uuid');
                $table->timestamps();

                $table->unique(['conference_uuid', 'user_uuid']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conference_user');
    }
};
