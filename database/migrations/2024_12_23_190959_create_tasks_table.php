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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('description', 7000)->nullable();
            $table->enum('status', ['pending','in_progress','completed']);
            $table->unsignedBigInteger('created_user_id')->nullable();
            $table->unsignedBigInteger('responsible_user_id')->nullable();
            $table->timestamps();
            
            $table->foreign('created_user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('responsible_user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
