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
        Schema::create('troubles', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('function');
            $table->timestamp('occurred_at');
            $table->text('phenomenon');
            $table->text('reproduction_steps');
            $table->text('cause')->nullable();
            $table->unsignedInteger('cause_type')->nullable();
            $table->unsignedInteger('cause_process')->nullable();
            $table->unsignedBigInteger('corresponding_user_id')->nullable();
            $table->date('corresponding_limit')->nullable();
            $table->unsignedInteger('priority');
            $table->text('remarks')->nullable();
            $table->unsignedInteger('status');
            $table->unsignedInteger('register_type');
            $table->unsignedBigInteger('create_user');
            $table->unsignedBigInteger('update_user')->nullable();
            $table->nullableTimestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('troubles');
    }
};
