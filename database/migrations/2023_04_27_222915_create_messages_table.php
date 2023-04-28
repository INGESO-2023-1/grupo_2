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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('sender_id')->constrained(
                table: 'users'
            );
            $table->foreignId('chat_id')->constrainer()->cascadeOnDelete();
            $table->string('content', 4096);
            $table->dateTime('send_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
