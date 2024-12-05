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
        Schema::create('diy_requests', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->string('user_name');
            $table->string('phone');
            $table->enum('status', ['Создан', 'Принят', 'Отменен'])->default('Создан');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diy_requests');
    }
};
