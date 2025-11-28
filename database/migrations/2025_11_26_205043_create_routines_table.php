<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('routines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_peau_id')->constrained('types_peau')->onDelete('cascade');
            $table->string('titre');
            $table->text('description');
            $table->enum('periode', ['matin', 'soir', 'hebdomadaire']);
            $table->integer('ordre')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('routines');
    }
};
