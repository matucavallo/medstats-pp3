<?php $__env->startSection('titulo', 'Gestión de Pacientes'); ?>
<?php $__env->startSection('contenido'); ?>
   <!-- <div class="flex min-h-screen bg-gray-100 transition-all duration-300 ease-in-out">-->

        <!-- Main -->
        <main class="flex-1 p-5 max-w-full">
            <div class="flex justify-between items-center mb-6">
                <h1
                    class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent  bg-clip-text drop-shadow-md  flex items-center gap-2 px-2">
                    Pacientes Registrados</h1>
                <a href="<?php echo e(route('pacientes.create')); ?>"
                    class="inline-block bg-neutral-700 hover:bg-neutral-800 text-white font-medium py-2 px-6 rounded-full shadow-md cursor-pointer transition duration-300"
                    style="text-decoration: none;">
                    Ingresar Nuevo Paciente
                </a>
            </div>

            <?php if(session('success')): ?>
                <div class="alert alert-success">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <?php if(session('error')): ?>
                <div class="alert alert-danger">
                    <?php echo e(session('error')); ?>

                </div>
            <?php endif; ?>

            <div class="bg-white shadow rounded-lg border border-gray-200 overflow-auto">
                <table id="tablaPacientes" class="table table-hover table-bordered shadow-sm text-center rounded">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 border">DNI</th>
                            <th class="px-4 py-2 border">Nombre</th>
                            <th class="px-4 py-2 border">Apellido</th>
                            <th class="px-4 py-2 border">Alergias</th>
                            <th class="px-4 py-2 border">Género</th>
                            <th class="px-4 py-2 border">Habitación</th>
                            <th class="px-4 py-2 border">Cama</th>
                            <th class="px-4 py-2 border text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $pacientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paciente): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 border"><?php echo e($paciente->dni); ?></td>
                                <td class="px-4 py-2 border"><?php echo e($paciente->nombre); ?></td>
                                <td class="px-4 py-2 border"><?php echo e($paciente->apellido); ?></td>
                                <td class="px-4 py-2 border"><?php echo e($paciente->alergias ?? '—'); ?></td>
                                <td class="px-4 py-2 border"><?php echo e($paciente->genero); ?></td>
                                <td class="px-4 py-2 border"><?php echo e($paciente->habitacion?->numero ?? '—'); ?></td>
                                <td class="px-4 py-2 border"><?php echo e($paciente->cama?->codigo ?? '—'); ?></td>
                                <td class="px-4 py-2 border text-center">
                                    <a href="<?php echo e(route('pacientes.show', $paciente)); ?>"
                                        class="btn btn-outline-primary btn-sm me-1 btn-acciones">Ver</a>
                                    <a href="<?php echo e(route('pacientes.edit', $paciente)); ?>"
                                        class="btn btn-outline-warning btn-sm me-1 btn-acciones">Editar</a>
                                    <?php if($paciente->cama_id): ?>
                                        <form action="<?php echo e(route('pacientes.darDeAlta', $paciente)); ?>" method="POST"
                                            class="inline-block form-dar-de-alta">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit"
                                                class="btn btn-outline-success btn-sm me-1 btn-acciones">Dar de
                                                alta</button>
                                        </form>
                                    <?php else: ?>
                                        <form action="<?php echo e(route('pacientes.asignar', $paciente)); ?>" method="GET"
                                            class="inline-block form-asignar">
                                            <button type="submit"
                                                class="btn btn-outline-secondary btn-sm me-1 btn-acciones"> Asignar
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                    <form action="<?php echo e(route('pacientes.destroy', $paciente)); ?>" method="POST"
                                        class="inline-block form-eliminar">
                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                        <button type="submit"
                                            class="btn btn-outline-danger btn-sm me-1 btn-acciones">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="8" class="px-4 py-2 text-center text-gray-500">No hay pacientes registrados.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

            </div>
        </main>
    </div>

    <!-- MODAL DE CONFIRMACIÓN PERSONALIZADO -->
    <div id="modal-confirmacion" class="modal">
        <div class="modal-content">
            <p id="modal-mensaje">¿Estás seguro?</p>
            <div class="botones">
                <button id="modal-cancelar">Cancelar</button>
                <button id="modal-confirmar">Confirmar</button>
            </div>
        </div>
    </div>

    <!-- ESTILOS DEL MODAL -->
    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 50;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            border-radius: 8px;
            width: 90%;
            max-width: 400px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.25);
        }

        .botones {
            margin-top: 20px;
            display: flex;
            justify-content: space-around;
        }

        .botones button {
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #modal-cancelar {
            background-color: #ccc;
            color: #333;
        }

        #modal-confirmar {
            background-color: #d9534f;
            color: white;
        }

        .btn-acciones {
            min-width: 110px;
            /* ajusta hasta que quede igual al "Dar de alta" */
            text-align: center;
        }
    </style>
    <?php $__env->startPush('scripts'); ?>
        <!-- SCRIPT PARA MANEJAR LOS MODALES -->
        <script src="<?php echo e(asset('js/modal.js')); ?>">

        </script>
        <script>
            $(document).ready(function() {
                $('#tablaPacientes').DataTable({
                    dom: '<"top-controls"Blf>rt<"bottom-controls"ip>',
                    buttons: [{
                            extend: 'excelHtml5',
                            text: 'Exportar a Excel',
                            className: 'btn btn-success btn-sm'
                        },
                        {
                            extend: 'pdfHtml5',
                            text: 'Exportar a PDF',
                            className: 'btn btn-danger btn-sm',
                            orientation: 'landscape',
                            pageSize: 'A4',
                            customize: function(doc) {
                                doc.defaultStyle.fontSize = 8;
                            }
                        }
                    ],
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
                        search: "Buscar paciente:",
                        lengthMenu: "Mostrar _MENU_ pacientes por página",
                        info: "Mostrando _START_ a _END_ de _TOTAL_ pacientes",
                        infoEmpty: "No hay pacientes para mostrar",
                        infoFiltered: "(filtrado de _MAX_ pacientes en total)"
                    },
                    order: [
                        [1, 'asc']
                    ], // Orden por nombre
                    columnDefs: [{
                            orderable: false,
                            targets: [7]
                        } // Desactiva orden en columna Acciones
                    ]
                });
            });
        </script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\MedStats-trazabilidad\resources\views/pacientes/index.blade.php ENDPATH**/ ?>