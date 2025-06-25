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
          Schema::create('financesTable', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id') -> constrained('users', 'id') -> onDelete('cascade');
            $table->string('description', 191);
            $table->enum('type', ['entrada', 'saida']);
            $table->decimal('priceTotal', 10,2);
            $table->timestamps();       
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financesTable');
    }
};
