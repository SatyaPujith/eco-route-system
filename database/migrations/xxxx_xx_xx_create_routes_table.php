<?php
// database/migrations/xxxx_xx_xx_create_routes_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('routes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('origin');
            $table->string('destination');
            $table->string('suggested_route');
            $table->integer('eco_score');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('routes');
    }
};
