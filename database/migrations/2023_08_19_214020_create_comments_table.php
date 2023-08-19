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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('post_id');
            $table->text('content');
            $table->string('username');
            $table->timestamps();

            // Define foreign key constraints if you have a users table.
             $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Define foreign key constraints if you have a posts table.
             $table->foreign('post_id')->references('id')->on('blog')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
