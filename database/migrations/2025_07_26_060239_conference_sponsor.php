<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('conference_sponsor')) {
            Schema::table('', function (Blueprint $table) {
                Schema::create('conference_sponsor', function (Blueprint $table) {
                    $table->id();
                    $table->uuid('sponsor_uuid');
                    $table->uuid('conference_uuid');
                    $table->string('sponsorship_level')->nullable();
                    $table->string('sponsorship_level_details')->nullable(); // This is for level `other` so can be something like 'coffee'
                    $table->timestamps();
                });
            });
        }
    }

    public function down(): void
    {
        Schema::table('', function (Blueprint $table) {
            //
        });
    }
};
