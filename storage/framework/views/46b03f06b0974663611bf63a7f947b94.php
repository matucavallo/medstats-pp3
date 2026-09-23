<?php $__env->startSection('title', 'Editar Caja Quirúrgica'); ?>

<?php $__env->startSection('contenido'); ?>
<div class="container mt-4">
    <a href="<?php echo e(route('trazabilidad.index')); ?>" class="text-secondary mb-3 d-inline-block text-decoration-none">
        &larr; Volver al listado
    </a>

    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <h4 class="font-weight-bold mb-4" style="color: #245360;">
                <i data-lucide="edit-3" class="d-inline-block mr-2" style="width: 20px; height: 20px;"></i>
                Editar Caja: <?php echo e($caja->codigo); ?>

            </h4>

            <!-- EL FORMULARIO APUNTA AL MÉTODO UPDATE Y USA $caja->id -->
            <form action="<?php echo e(route('trazabilidad.update', $caja->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?> <!-- OBLIGATORIO EN LARAVEL PARA EDITAR -->

                <div class="mb-3">
                    <label class="form-label font-weight-bold">Código de la Caja</label>
                    <input type="text" name="codigo" class="form-control" value="<?php echo e(old('codigo', $caja->codigo)); ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label font-weight-bold">Nombre descriptivo</label>
                    <input type="text" name="nombre" class="form-control" value="<?php echo e(old('nombre', $caja->nombre)); ?>" required>
                </div>
                <!-- NUEVO CAMPO: Tipo de Esterilización -->
                <div class="mb-3">
                    <label class="form-label font-weight-bold" style="color: #495057;">Tipo de Esterilización Requerida</label>
                    <select name="tipo_esterilizacion" class="form-select" style="border-radius: 5px; padding: 10px;" required>
                        <option value="" disabled selected>Seleccione el método...</option>
                        <option value="Autoclave" <?php echo e(old('tipo_esterilizacion', isset($caja) ? $caja->tipo_esterilizacion : '') == 'Autoclave' ? 'selected' : ''); ?>>
                            Autoclave 
                        </option>
                        <option value="Óxido de Etileno" <?php echo e(old('tipo_esterilizacion', isset($caja) ? $caja->tipo_esterilizacion : '') == 'Óxido de Etileno' ? 'selected' : ''); ?>>
                            Óxido de Etileno 
                        </option>
                    </select>
                    <small class="text-muted d-block mt-1">Defina el proceso adecuado según el material de la caja.</small>
                </div>

                <div class="mb-4">
                    <label class="form-label font-weight-bold">Descripción y Contenido de la Caja</label>
                    <textarea class="form-control" name="descripcion" rows="3"><?php echo e(old('descripcion', $caja->descripcion)); ?></textarea>
                </div>

                <div class="text-end">
                    <a href="<?php echo e(route('trazabilidad.index')); ?>" class="btn btn-light border mr-2">Cancelar</a>
                    
                    <!-- EL BOTÓN AHORA ES DINÁMICO -->
                    <button type="submit" class="btn btn-primary text-white" style="background-color: #0d6efd;">
                        <?php echo e($caja->trashed() ? 'Restaurar Caja' : 'Actualizar Caja'); ?>

                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        if(typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\MedStats-trazabilidad\resources\views/trazabilidad/edit.blade.php ENDPATH**/ ?>