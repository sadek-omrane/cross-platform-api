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
            // add profile image id column
            $table->string('profile_image_id')->nullable()->after('name')->change();
            // add cover image id column
            $table->string('cover_image_id')->nullable()->after('profile_image_id')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('profile_image_id');
            $table->dropColumn('cover_image_id');
        });
    }
};
