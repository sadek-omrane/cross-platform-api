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
        Schema::table('users', function (Blueprint $table) {
            // update profile image id column to be foreign key
            $table->foreignId('profile_image_id')->nullable()->after('name')->change();
            // update cover image id column to be foreign key
            $table->foreignId('cover_image_id')->nullable()->after('profile_image_id')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
