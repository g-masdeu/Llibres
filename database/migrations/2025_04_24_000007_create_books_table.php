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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->string('author');
            $table->text('summary');
            $table->date('publication_date');
            $table->decimal('price', 8, 2);
            $table->string('image');
            $table->integer('min_age');
            $table->foreignId('category_id')
                ->nullable()
                ->constrained('categories') 
                ->cascadeOnUpdate()
                ->nullOnDelete();            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
