<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('usuario_perfils', function (Blueprint $table) {
            $table->boolean('esterilizacion')->nullable()->after('cirugias');
        });

        if (!DB::table('usuario_perfils')->where('perfil', 'Esterilización')->exists()) {
            DB::table('usuario_perfils')->insert([
                'perfil' => 'Esterilización',
                'admin' => false,
                'insumos' => false,
                'estadisticas' => false,
                'pacientes' => false,
                'camas' => false,
                'cirugias' => false,
                'esterilizacion' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        DB::table('usuario_perfils')->where('perfil', 'Esterilización')->delete();

        Schema::table('usuario_perfils', function (Blueprint $table) {
            $table->dropColumn('esterilizacion');
        });
    }
};