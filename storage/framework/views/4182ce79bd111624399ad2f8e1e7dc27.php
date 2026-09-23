<?php $__env->startSection('titulo', 'Ingresar Medicamento'); ?>
<?php $__env->startSection('contenido'); ?>
<div class="max-w-3xl mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1
                class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent  bg-clip-text drop-shadow-md  flex items-center gap-2 px-2">
                Ingresar nuevo medicamento al stock</h1>

        </div>


        <form action="<?php echo e(route('stocks.store')); ?>" method="POST"
            class="bg-white shadow rounded-lg border border-gray-200 p-6 space-y-6">
            <?php echo csrf_field(); ?>

            <!-- Medicamento con autocompletado -->
            <div>
                <label for="medicamento_input" class="block text-sm font-medium text-gray-700 mb-1">Medicamento</label>
                <input type="text" id="medicamento_input" name="medicamento_id"
                    class="w-full border-2 border-gray-400 rounded-md shadow-sm px-4 py-2 focus:ring-2 focus:ring-gray-200 focus:border-gray-700"
                    placeholder="Escriba para buscar un medicamento...">
                <?php $__errorArgs = ['medicamento_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <small class="text-danger"><?php echo e($message); ?></small>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Detalles del lote -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="cantidad_act" class="block text-sm font-medium text-gray-700 mb-1">Cantidad</label>
                    <input type="number" name="cantidad_act" id="cantidad_act"
                        class="w-full border-2 border-gray-400 rounded-md shadow-sm px-4 py-2 focus:ring-2 focus:ring-gray-500 focus:border-gray-700"
                        value="<?php echo e(old('cantidad_act')); ?>">
                    <?php $__errorArgs = ['cantidad_act'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <small class="text-danger"><?php echo e($message); ?></small>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label for="lote" class="block text-sm font-medium text-gray-700 mb-1">Lote</label>
                    <input type="text" name="lote" id="lote"
                        class="w-full border-2 border-gray-400 rounded-md shadow-sm px-4 py-2 focus:ring-2 focus:ring-gray-500 focus:border-gray-700"
                        value="<?php echo e(old('lote')); ?>">
                    <?php $__errorArgs = ['lote'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <small class="text-danger"><?php echo e($message); ?></small>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label for="servicio_id" class="block text-sm font-medium text-gray-700 mb-1">Servicio</label>
                    <select name="servicio_id" id="servicio_id"
                        class="w-full border-2 border-gray-400 rounded-md shadow-sm px-4 py-2 focus:ring-2 focus:ring-gray-500 focus:border-gray-700">
                        <?php $__currentLoopData = $servicios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $servicio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($servicio->id); ?>" <?php echo e(old('servicio_id') == $servicio->id ? 'selected' : ''); ?>>
                                <?php echo e($servicio->nombre); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['servicio_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <small class="text-danger"><?php echo e($message); ?></small>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <div>
                <label for="fecha_vencimiento" class="block text-sm font-medium text-gray-700 mb-1">Fecha de
                    vencimiento</label>
                <input type="date" name="fecha_vencimiento" id="fecha_vencimiento"
                    class="w-full border-2 border-gray-400 rounded-md shadow-sm px-4 py-2 focus:ring-2 focus:ring-gray-500 focus:border-gray-700"
                    value="<?php echo e(old('fecha_vencimiento')); ?>">
                <?php $__errorArgs = ['fecha_vencimiento'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <small class="text-danger"><?php echo e($message); ?></small>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>



            <!-- Botón -->
            <div class="flex justify-between pt-4">

                <a href="<?php echo e(route('stocks.index')); ?>" class="btn btn-outline-danger px-5 py-2 rounded shadow-sm">
                    ← Cancelar
                </a>
                <button type="submit"
                    class="inline-block bg-neutral-700 hover:bg-neutral-800 text-white font-medium py-2 px-6 rounded-full shadow-md cursor-pointer transition duration-300"
                    style="text-decoration: none;">
                    Agregar
                </button>
            </div>
        </form>


    <!-- Script para alerta de vencimiento -->
        <script>
            const vencimiento = document.getElementById('fecha_vencimiento');
            vencimiento.addEventListener('change', () => {
                const inputDate = new Date(vencimiento.value);
                const today = new Date();
                const limit = new Date();
                limit.setDate(today.getDate() + 15);

                if (inputDate <= today) {
                    showWarning("Este medicamento está vencido o vence hoy.");
                } else if (inputDate <= limit) {
                    showWarning("Este medicamento vence en los próximos 15 días.");
                } else {
                    hideWarning();
                }
            });

            function showWarning(message) {
                let alertBox = document.getElementById('vencimiento-alert');
                if (!alertBox) {
                    alertBox = document.createElement('div');
                    alertBox.id = 'vencimiento-alert';
                    alertBox.className =
                        'mb-4 px-4 py-3 bg-yellow-100 border border-yellow-300 text-yellow-800 rounded shadow-sm';
                    vencimiento.parentNode.insertBefore(alertBox, vencimiento.parentNode.firstChild);
                }
                alertBox.innerText = message;
            }

            function hideWarning() {
                const alertBox = document.getElementById('vencimiento-alert');
                if (alertBox) alertBox.remove();
            }
        </script>

        <!-- Tom Select CSS y JS -->
        <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>

        <!-- Inicialización de autocompletado -->
        <script>
            new TomSelect('#medicamento_input', {
                options: [
                    <?php $__currentLoopData = $medicamentos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $nombre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        {
                            value: '<?php echo e($id); ?>',
                            text: '<?php echo e($nombre); ?>'
                        },
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                ],
                create: false,
                maxItems: 1,
                placeholder: "Escriba para buscar un medicamento...",
                allowEmptyOption: true,
                sortField: {
                    field: "text",
                    direction: "asc"
                },
                render: {
                    no_results: function(data, escape) {
                        return '<div class="no-results">No se encontró ningún medicamento</div>';
                    }
                }
            });
        </script>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\MedStats-trazabilidad\resources\views/stocks/create.blade.php ENDPATH**/ ?>