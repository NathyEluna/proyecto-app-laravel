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
        Schema::create('chat_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_session_id')->constrained('game_sessions')->onDelete('cascade');
            $table->string('chatbot_id'); // Pickaxe chatbot ID
            $table->longText('conversation_log')->nullable(); // Store chat logs if needed
            $table->timestamp('start_time')->default(now());
            $table->timestamp('end_time')->nullable();
            $table->enum('status', ['active', 'completed'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_sessions');
    }
};
