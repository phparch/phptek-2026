<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        if (!Schema::hasTable('conferences')) {
            Schema::create('conferences', static function (Blueprint $table) {
                $table->id();
                $table->uuid('uuid')->unique();
                $table->string('name')->unique();
                $table->string('venue_name', 255)->nullable();
                $table->string('venue_address')->nullable();
                $table->datetime('start_date')->nullable();
                $table->datetime('end_date')->nullable();
                $table->timestamp('created_at')->nullable();
                $table->timestamp('updated_at')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conferences');
    }
};
