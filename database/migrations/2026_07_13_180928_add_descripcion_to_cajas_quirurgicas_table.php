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
    Schema::table('caja_quirurgicas', function (Blueprint $table) {
        // Usamos 'text' porque una descripción puede ser larga, y 'nullable' por si a veces la dejan vacía
        $table->text('descripcion')->nullable()->after('nombre');
    });
}

public function down()
{
    Schema::table('caja_quirurgicas', function (Blueprint $table) {
        $table->dropColumn('descripcion');
    });
}
};
