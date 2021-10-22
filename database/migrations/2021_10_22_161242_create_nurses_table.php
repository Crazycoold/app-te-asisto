<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nurses', function (Blueprint $table) {
            $table->string('id', 50)->primary();
            $table->enum('document_type', ['CC', 'CE']);
            $table->string('dni', 20);
            $table->string('first_name', 50);
            $table->string('last_name', 50)->nullable();
            $table->string('first_surname', 50);
            $table->string('last_surname', 50)->nullable();
            $table->enum('gender', ['MASCULINO', 'FEMENINO']);
            $table->string('phone', 10);
            $table->string('email', 50);
            $table->longText('url');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nurses');
    }
}
