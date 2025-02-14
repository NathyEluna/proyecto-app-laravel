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
        Schema::create('game_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('room_theme'); // Haunted, Cyberpunk, etc.
            $table->text('progress')->nullable(); // JSON or text to store game state
            $table->dateTime('start_time');
            $table->dateTime('end_time')->nullable();
            $table->foreignId('chatbot_id')->nullable()->constrained('chatbots')->onDelete('set null'); // Chatbot used
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_sessions');
    }
};
