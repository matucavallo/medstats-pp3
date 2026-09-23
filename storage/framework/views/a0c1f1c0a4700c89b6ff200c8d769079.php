<?php $__env->startSection('titulo', 'Estadísticas de Esterilización'); ?>

<?php $__env->startSection('contenido'); ?>
<div class="container mx-auto">
    <!-- Encabezado -->
    <div class="d-flex justify-content-between align-items-center mb-8">
 
         <div>
                <h2 class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent bg-clip-text drop-shadow-md">
                    Estadísticas de Esterilización y Trazabilidad
                </h2>
                <p class="text-gray-500 mt-1">Resumen del estado actual del instrumental quirúrgico</p>
         </div>
        
        <div class="d-flex align-items-center gap-2">
            <a href="<?php echo e(route('cirugias.estadisticas')); ?>" 
               class="btn bg-white text-gray-700 shadow-sm hover:shadow-md border border-gray-200 d-flex align-items-center px-4 py-2 rounded-lg transition-all" style="text-decoration: none;">
                <i class="bi bi-activity me-2 text-[#1B7D8F]"></i> 
                <span class="font-medium">Estadísticas de Cirugías</span>
            </a>
            <a href="<?php echo e(route('stocks.estadisticasstock')); ?>" 
               class="btn bg-white text-gray-700 shadow-sm hover:shadow-md border border-gray-200 d-flex align-items-center px-4 py-2 rounded-lg transition-all" style="text-decoration: none;">
                <i class="bi bi-box-seam me-2 text-[#1B7D8F]"></i> 
                <span class="font-medium">Estadísticas de Stock</span>
            </a>
        </div>
    </div>

   <!-- Tarjetas de Métricas -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        
        <!-- Total -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 border-l-4 border-l-gray-600">
            <div class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">Total de Cajas</div>
            <div class="text-3xl font-bold text-gray-800"><?php echo e($totalCajas); ?></div>
        </div>

        <!-- Almacenadas -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 border-l-4 border-l-[#1B7D8F]">
            <div class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">Almacenadas</div>
            <div class="text-3xl font-bold text-[#1B7D8F]"><?php echo e($cajasAlmacenadas); ?></div>
        </div>

        <!-- En Uso -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 border-l-4 border-l-red-500">
            <div class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">En Uso</div>
            <div class="text-3xl font-bold text-red-500"><?php echo e($cajasEnUso); ?></div>
        </div>

        <!-- Depósito Estéril -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 border-l-4 border-l-purple-500">
            <div class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">Depósito Estéril</div>
            <div class="text-3xl font-bold text-purple-500"><?php echo e($cajasDeposito); ?></div>
        </div>

        <!-- Esterilizadas: Autoclave -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 border-l-4 border-l-green-500">
            <div class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">Esterilizada. (Autoclave)</div>
            <div class="text-3xl font-bold text-green-500"><?php echo e($cajasEsterilizadasAuto); ?></div>
        </div>

        <!-- Esterilizadas: Óxido de Etileno -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 border-l-4 border-l-emerald-400">
            <div class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">Esterilizada. (Óx. Etileno)</div>
            <div class="text-3xl font-bold text-emerald-500"><?php echo e($cajasEsterilizadasOxido); ?></div>
        </div>

        <!-- En Desuso -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 border-l-4 border-l-orange-500">
            <div class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">En Desuso</div>
            <div class="text-3xl font-bold text-orange-500"><?php echo e($cajasEnDesuso); ?></div>
        </div>

    </div>

<!-- Contenedor de la Tabla -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h3 class="text-xl font-bold text-[#1B7D8F] mb-4">Historial de Movimientos</h3>
        
        <div class="overflow-x-auto">
            <table id="tabla-historial" class="table table-hover w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="py-3 px-4 text-left font-semibold text-gray-600">Fecha y Hora</th>
                        <th class="py-3 px-4 text-left font-semibold text-gray-600">Caja Quirúrgica</th>
                        <th class="py-3 px-4 text-left font-semibold text-gray-600">Estado</th>
                        <th class="py-3 px-4 text-left font-semibold text-gray-600">Registrado por</th>
                        <th class="py-3 px-4 text-left font-semibold text-gray-600">Observaciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $historial; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movimiento): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="border-b border-gray-50">
                        <!-- Fecha formateada (Día/Mes/Año Hora:Minutos) -->
                        <td class="py-3 px-4 align-middle">
                            <?php echo e(\Carbon\Carbon::parse($movimiento->created_at)->format('d/m/Y H:i')); ?>

                        </td>
                        
                        <!-- Datos de la caja -->
                        <td class="py-3 px-4 align-middle">
                            <span class="font-bold text-gray-800"><?php echo e($movimiento->cajaQuirurgica->codigo ?? 'N/A'); ?></span><br>
                            <span class="text-xs text-gray-500"><?php echo e($movimiento->cajaQuirurgica->nombre ?? 'Caja eliminada'); ?></span>
                        </td>
                        
                       <!-- Estado con colores y métodos dinámicos -->
                        <td class="py-3 px-4 align-middle">
                        <span class="px-3 py-1 text-xs font-semibold rounded-full
                            <?php echo e($movimiento->estado_registrado == 'Depósito Estéril' ? 'bg-purple-100 text-purple-800' : ''); ?>

                            <?php echo e($movimiento->estado_registrado == 'Almacenada' ? 'bg-[#e6f4f3] text-[#1B7D8F]' : ''); ?>

                            <?php echo e($movimiento->estado_registrado == 'En Uso' ? 'bg-red-100 text-red-800' : ''); ?>

                            <?php echo e($movimiento->estado_registrado == 'En Desuso' ? 'bg-orange-100 text-orange-800' : ''); ?>

                            <?php echo e($movimiento->estado_registrado == 'Esterilizada' && optional($movimiento->cajaQuirurgica)->tipo_esterilizacion == 'Autoclave' ? 'bg-green-100 text-green-800' : ''); ?>

                            <?php echo e($movimiento->estado_registrado == 'Esterilizada' && optional($movimiento->cajaQuirurgica)->tipo_esterilizacion == 'Óxido de Etileno' ? 'bg-emerald-100 text-emerald-800' : ''); ?>

                            <?php echo e($movimiento->estado_registrado == 'Esterilizada' && !optional($movimiento->cajaQuirurgica)->tipo_esterilizacion ? 'bg-green-100 text-green-800' : ''); ?>

                            ">
                            <?php if($movimiento->estado_registrado == 'Esterilizada' && optional($movimiento->cajaQuirurgica)->tipo_esterilizacion): ?>
                                Esterilizada (<?php echo e($movimiento->cajaQuirurgica->tipo_esterilizacion); ?>)
                            <?php else: ?>
                            <?php echo e($movimiento->estado_registrado); ?>

                            <?php endif; ?>
                        </span>
                        </td>
                        
                        <!-- Empleado (preparado por si usan el campo name o nombre) -->
                        <td class="py-3 px-4 align-middle">
                            <?php echo e($movimiento->empleado->name ?? ($movimiento->empleado->nombre . ' ' . $movimiento->empleado->apellido) ?? 'Sistema'); ?>

                        </td>
                        
                        <!-- Observaciones -->
                        <td class="py-3 px-4 align-middle text-gray-600">
                            <?php echo e($movimiento->observaciones ?? '-'); ?>

                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>    <div id="contenedor-tabla-historial">
        <!-- Próximo paso -->
    </div>

</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script>
    $(document).ready(function() {
        $('#tabla-historial').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
            },
            order: [[0, 'desc']],
            pageLength: 10,
            dom: '<"flex justify-between items-center mb-4"lf>rt<"flex justify-between items-center mt-4"ip>',
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app_estadisticas', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\MedStats-trazabilidad\resources\views/trazabilidad/estadisticas.blade.php ENDPATH**/ ?>