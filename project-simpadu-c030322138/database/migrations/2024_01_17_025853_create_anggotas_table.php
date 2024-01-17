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
        Schema::create('anggotas', function (Blueprint $table) {
            $table->id();
                $table->string('nama');
                $table->string('email')->unique();
                $table->integer('usia')->nullable();
                $table->date('tgl_lahir')->nullable();
                $table->text('alamat')->nullable();
                $table->boolean('gender')->nullable();
                $table->enum('status',['lajang','menikah']);
                $table->string('hobi')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggotas');
    }
};
