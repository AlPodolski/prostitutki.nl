<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('cloud_zones', function (Blueprint $table) {
            $table->string('site_id')->change();
        });
    }

    public function down(): void
    {
        Schema::table('cloud_zones', function (Blueprint $table) {
            $table->integer('site_id')->change();
        });
    }
};