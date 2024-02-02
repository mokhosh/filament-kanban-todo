<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->boolean('urgent')->default(false);
            $table->tinyInteger('progress')->default(0);
            $table->foreignId('user_id')->constrained();
            $table->string('status')->default('Todo');
            $table->unsignedInteger('order_column');
            $table->timestamps();
        });

        Schema::create('task_user', function(Blueprint $table) {
            $table->foreignId('task_id')->constrained();
            $table->foreignId('user_id')->constrained();
        });
    }
};
