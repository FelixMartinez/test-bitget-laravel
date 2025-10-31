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
        Schema::create('bitget_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name'); // Nombre descriptivo de la cuenta
            $table->string('api_key');
            $table->text('secret_key'); // Encriptado
            $table->string('passphrase'); // Encriptado
            $table->boolean('is_active')->default(false); // Solo una puede estar activa
            $table->boolean('is_demo')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bitget_accounts');
    }
};
