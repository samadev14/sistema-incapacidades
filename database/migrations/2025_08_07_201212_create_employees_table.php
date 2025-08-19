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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name_employee');
            $table->string('last_name_employee');
            $table->integer('id_employee')->unique()->index();
            $table->string('email_employee')->unique();
            $table->foreignId('position_id')
                ->constrained()
                ->OnDelete('cascade');
            $table->foreignId('healthcare_id')
                ->constrained()
                ->OnDelete('cascade');
            $table->timestamps();

            $table->unique(['name_employee', 'last_name_employee']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
