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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('cnic');
            $table->string('accountNo')->unique();
            $table->string('accountType');       // current ou saving
            $table->string('city');
            $table->string('address');
            $table->string('email')->unique();
            $table->string('password');
            $table->decimal('balance', 12, 2)->default(0);
            $table->string('source');            // source de revenus
            $table->string('number');            // téléphone
            $table->string('image')->nullable(); // photo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
