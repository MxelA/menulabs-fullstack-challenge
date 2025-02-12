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
        Schema::create('weathers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->decimal('temp', 5, 2);
            $table->string('unit', '10');
            $table->decimal('pressure', 6, 2);
            $table->decimal('humidity', 6, 2);
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
            ;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weathers');
    }
};
