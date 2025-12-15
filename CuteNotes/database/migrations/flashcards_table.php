<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('flashcards', function (Blueprint $table) {
        $table->id();

        $table->foreignId('user_id')
              ->constrained()
              ->onDelete('cascade');

        $table->foreignId('flashcard_category_id')
              ->nullable()
              ->constrained('flashcard_categories')
              ->onDelete('set null');

        $table->string('question');
        $table->text('answer');

        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('flashcards');
}

};
