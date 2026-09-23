<?php $__env->startSection('title', 'Registrar Nueva Cirugía'); ?>
<?php $__env->startSection('contenido'); ?>
    <!--<div class="container mt-4">-->
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1
                class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent bg-clip-text drop-shadow-md flex items-center gap-2 px-2">
                Agregar Nueva Cirugía
            </h1>
        </div>

        
        <div class="card shadow-sm">
            <div class="card-body">
                <form action="<?php echo e(route('cirugias.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>

                    <div class="row mb-3">
                        
                        <div class="col-md-4">
                            <label for="paciente_id" class="form-label">Paciente</label>
                            <select name="paciente_id" id="paciente_id" class="form-control select2">
                                <option value="">Seleccione el Paciente</option>
                                <?php $__currentLoopData = $pacientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paciente): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($paciente->id); ?>"
                                        <?php echo e(old('paciente_id') == $paciente->id ? 'selected' : ''); ?>>
                                        <?php echo e($paciente->nombre); ?> <?php echo e($paciente->apellido); ?>

                                        DNI: <?php echo e($paciente->dni); ?>

                                        <?php echo e($paciente->fecha_nacimiento ? ' - ' . \Carbon\Carbon::parse($paciente->fecha_nacimiento)->age . ' años' : ''); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['paciente_id'];
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

                        
                        <div class="col-md-4">
                            <label for="especialidad" class="form-label">Especialidad</label>
                            <select name="especialidad_id" id="especialidad" class="form-control select2">
                                <option value="">Seleccione la especialidad</option>
                                <?php $__currentLoopData = $especialidades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $especialidad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($especialidad->id); ?>"
                                        <?php echo e(old('especialidad_id') == $especialidad->id ? 'selected' : ''); ?>>
                                        <?php echo e($especialidad->nombre); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['especialidad_id'];
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

                        
                        <div class="col-md-4">
                            <label for="procedimiento" class="form-label">Procedimiento</label>
                            <select name="procedimiento_id" id="procedimiento" class="form-control select2">
                            </select>
                            <?php $__errorArgs = ['procedimiento_id'];
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


                        
                        <div class="col-md-4">
                            <label for="procedimiento2" class="form-label">Procedimiento 2</label>
                            <select name="procedimiento_2_id" id="procedimiento2" class="form-control select2">
                            </select>
                            <?php $__errorArgs = ['procedimiento_2_id'];
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

                        
                        <div class="col-md-4">
                            <label for="quirofano_id" class="form-label">Quirofano</label>
                            <select name="quirofano_id" id="quirofano_id" class="form-control select2">
                                <option value="">Seleccione el N° de Quirofano</option>
                                <?php $__currentLoopData = $quirofanos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quirofano): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($quirofano->id); ?>"
                                        <?php echo e(old('quirofano_id') == $quirofano->id ? 'selected' : ''); ?>>
                                        <?php echo e($quirofano->nombre); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['quirofano_id'];
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

                        
                        <div class="col-md-4">
                            <label for="cirujano_id" class="form-label">Cirujano</label>
                            <select name="cirujano_id" id="cirujano_id" class="form-control select2">
                                <option value="">Seleccione el Cirujano</option>
                                <?php $profesionesPermitidas = [1,2]; ?>
                                <?php $__currentLoopData = $empleados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $empleado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(in_array($empleado->get_profesion->rol_id, $profesionesPermitidas)): ?>
                                        <option value="<?php echo e($empleado->id); ?>"
                                            <?php echo e(old('cirujano_id') == $empleado->id ? 'selected' : ''); ?>>
                                            <?php echo e($empleado->nombre); ?> <?php echo e($empleado->apellido); ?>

                                        </option>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['cirujano_id'];
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

                        
                        <div class="col-md-4">
                            <label for="ayudante_1_id" class="form-label">Ayudante 1</label>
                            <select name="ayudante_1_id" id="ayudante_1_id" class="form-control select2">
                                <option value="">Seleccione el Ayudante 1</option>
                                <?php $profesionesPermitidas = [1, 2]; ?>
                                <?php $__currentLoopData = $empleados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $empleado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(in_array($empleado->get_profesion->rol_id, $profesionesPermitidas)): ?>
                                        <option value="<?php echo e($empleado->id); ?>"
                                            <?php echo e(old('ayudante_1_id') == $empleado->id ? 'selected' : ''); ?>>
                                            <?php echo e($empleado->nombre); ?> <?php echo e($empleado->apellido); ?>

                                        </option>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['ayudante_1_id'];
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

                        
                        <div class="col-md-4">
                            <label for="ayudante_2_id" class="form-label">Ayudante 2</label>
                            <select name="ayudante_2_id" id="ayudante_2_id" class="form-control select2">
                                <option value="">Seleccione el Ayudante 2</option>
                                <?php $profesionesPermitidas = [1, 2]; ?>
                                <?php $__currentLoopData = $empleados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $empleado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(in_array($empleado->get_profesion->rol_id, $profesionesPermitidas)): ?>
                                        <option value="<?php echo e($empleado->id); ?>"
                                            <?php echo e(old('ayudante_2_id') == $empleado->id ? 'selected' : ''); ?>>
                                            <?php echo e($empleado->nombre); ?> <?php echo e($empleado->apellido); ?>

                                        </option>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['ayudante_2_id'];
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

                        
                        <div class="col-md-4">
                            <label for="ayudante_3_id" class="form-label">Ayudante 3</label>
                            <select name="ayudante_3_id" id="ayudante_3_id" class="form-control select2">
                                <option value="">Seleccione el Ayudante 3</option>
                                <?php $profesionesPermitidas = [1, 2]; ?>
                                <?php $__currentLoopData = $empleados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $empleado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(in_array($empleado->get_profesion->rol_id, $profesionesPermitidas)): ?>
                                        <option value="<?php echo e($empleado->id); ?>"
                                            <?php echo e(old('ayudante_3_id') == $empleado->id ? 'selected' : ''); ?>>
                                            <?php echo e($empleado->nombre); ?> <?php echo e($empleado->apellido); ?>

                                        </option>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['ayudante_3_id'];
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

                        
                        <div class="col-md-4">
                            <label for="anestesista_id" class="form-label">Anestesista</label>
                            <select name="anestesista_id" id="anestesista_id" class="form-control select2">
                                <option value="">Seleccione el Anestesista</option>
                                <?php $profesionesPermitidas = [3]; ?>
                                <?php $__currentLoopData = $empleados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $empleado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(in_array($empleado->get_profesion->rol_id, $profesionesPermitidas)): ?>
                                        <option value="<?php echo e($empleado->id); ?>"
                                            <?php echo e(old('anestesista_id') == $empleado->id ? 'selected' : ''); ?>>
                                            <?php echo e($empleado->nombre); ?> <?php echo e($empleado->apellido); ?>

                                        </option>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['anestesista_id'];
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
                        
                        <div class="col-md-4">
                            <label for="tipo_anestesia_id" class="form-label">Tipo de Anestesia</label>
                            <select name="tipo_anestesia_id" id="tipo_anestesia_id" class="form-control select2">
                                <option value="">Seleccione el Tipo de Anestesia</option>
                                <?php $__currentLoopData = $tipoAnestesias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipoAnestesia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($tipoAnestesia->id); ?>"
                                        <?php echo e(old('tipo_anestesia_id') == $tipoAnestesia->id ? 'selected' : ''); ?>>
                                        <?php echo e($tipoAnestesia->nombre); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['tipo_anestesia_id'];
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
                        
                        <div class="col-md-4">
                            <label for="tipo_anestesia_2_id" class="form-label">Tipo de Anestesia 2</label>
                            <select name="tipo_anestesia_2_id" id="tipo_anestesia_2_id" class="form-control select2">
                                <option value="">Seleccione el Tipo de Anestesia</option>
                                <?php $__currentLoopData = $tipoAnestesias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipoAnestesia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($tipoAnestesia->id); ?>"
                                        <?php echo e(old('tipo_anestesia_2_id') == $tipoAnestesia->id ? 'selected' : ''); ?>>
                                        <?php echo e($tipoAnestesia->nombre); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['tipo_anestesia_2_id'];
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
                        
                        <div class="col-md-4">
                            <label for="instrumentador_id" class="form-label">Instrumentador</label>
                            <select name="instrumentador_id" id="instrumentador_id" class="form-control select2">
                                <option value="">Seleccione el Instrumentador</option>
                                <?php $profesionesPermitidas = [4]; ?>
                                <?php $__currentLoopData = $empleados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $empleado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(in_array($empleado->get_profesion->rol_id, $profesionesPermitidas)): ?>
                                        <option value="<?php echo e($empleado->id); ?>"
                                            <?php echo e(old('instrumentador_id') == $empleado->id ? 'selected' : ''); ?>>
                                            <?php echo e($empleado->nombre); ?> <?php echo e($empleado->apellido); ?>

                                        </option>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['instrumentador_id'];
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
                        
                        <div class="col-md-4">
                            <label for="instrumentador_2_id" class="form-label">Instrumentador 2</label>
                            <select name="instrumentador_2_id" id="instrumentador_2_id" class="form-control select2">
                                <option value="">Seleccione el Instrumentador</option>
                                <?php $profesionesPermitidas = [4]; ?>
                                <?php $__currentLoopData = $empleados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $empleado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(in_array($empleado->get_profesion->rol_id, $profesionesPermitidas)): ?>
                                        <option value="<?php echo e($empleado->id); ?>"
                                            <?php echo e(old('instrumentador_2_id') == $empleado->id ? 'selected' : ''); ?>>
                                            <?php echo e($empleado->nombre); ?> <?php echo e($empleado->apellido); ?>

                                        </option>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['instrumentador_2_id'];
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
                        
                        <div class="col-md-4">
                            <label for="enfermero_id" class="form-label">Enfermero</label>
                            <select name="enfermero_id" id="enfermero_id" class="form-control select2">
                                <option value="">Seleccione el Enfermero</option>
                                <?php $profesionesPermitidas = [5]; ?>
                                <?php $__currentLoopData = $empleados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $empleado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(in_array($empleado->get_profesion->rol_id, $profesionesPermitidas)): ?>
                                        <option value="<?php echo e($empleado->id); ?>"
                                            <?php echo e(old('enfermero_id') == $empleado->id ? 'selected' : ''); ?>>
                                            <?php echo e($empleado->nombre); ?> <?php echo e($empleado->apellido); ?>

                                        </option>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['enfermero_id'];
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
                        
                        <div class="col-md-4">
                            <label for="enfermero_2_id" class="form-label">Enfermero 2</label>
                            <select name="enfermero_2_id" id="enfermero_2_id" class="form-control select2">
                                <option value="">Seleccione el Enfermero</option>
                                <?php $profesionesPermitidas = [5]; ?>
                                <?php $__currentLoopData = $empleados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $empleado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(in_array($empleado->get_profesion->rol_id, $profesionesPermitidas)): ?>
                                        <option value="<?php echo e($empleado->id); ?>"
                                            <?php echo e(old('enfermero_2_id') == $empleado->id ? 'selected' : ''); ?>>
                                            <?php echo e($empleado->nombre); ?> <?php echo e($empleado->apellido); ?>

                                        </option>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['enfermero_2_id'];
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
                        
                        <div class="col-md-4">
                            <label for="fecha_cirugia" class="form-label">Fecha de la cirugía</label>
                            <input type="date" name="fecha_cirugia" id="fecha_cirugia" class="form-control"
                                value="<?php echo e(old('fecha_cirugia')); ?>">
                            <?php $__errorArgs = ['fecha_cirugia'];
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
                        
                        <div class="col-md-4">
                            <label for="hora_cirugia" class="form-label">Hora de la cirugía</label>
                            <input type="time" name="hora_cirugia" id="hora_cirugia" class="form-control"
                                value="<?php echo e(old('hora_cirugia')); ?>">
                            <?php $__errorArgs = ['hora_cirugia'];
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
                        
                        
                        
                        
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-primary mb-1">Duración de la cirugía</label>

                            <div class="row gx-1 align-items-center">
                                <div class="col-6">
                                    <label for="duracion_horas" class="form-label mb-1 small">Horas</label>
                                    <input type="number" name="duracion_horas" id="duracion_horas"
                                        class="form-control form-control-sm py-0" min="0"
                                        value="<?php echo e(old('duracion_horas', 0)); ?>">
                                </div>
                                <div class="col-6">
                                    <label for="duracion_minutos" class="form-label mb-1 small">Minutos</label>
                                    <input type="number" name="duracion_minutos" id="duracion_minutos"
                                        class="form-control form-control-sm py-0" min="0" max="59"
                                        value="<?php echo e(old('duracion_minutos', 0)); ?>">
                                </div>
                            </div>
                            <?php $__errorArgs = ['duracion_horas'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <small class="text-danger d-block"><?php echo e($message); ?></small>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <?php $__errorArgs = ['duracion_minutos'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <small class="text-danger d-block"><?php echo e($message); ?></small>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>


                        
                        <div class="col-md-6 d-flex align-items-center">
                            <div class="me-4 text-center">
                                <label class="form-label d-block mb-2">Urgencia</label>
                                <label class="switch switch-urgencia">
                                    <input type="checkbox" name="urgencia" id="urgencia"
                                        <?php echo e(old('urgencia') ? 'checked' : ''); ?>>
                                    <span class="slider round"></span>
                                </label>
                                <?php $__errorArgs = ['urgencia'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div><small class="text-danger"><?php echo e($message); ?></small></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="me-4 text-center">
                                <label class="form-label d-block mb-2">Óbito</label>
                                <label class="switch switch-obito">
                                    <input type="checkbox" name="obito" id="obito"
                                        <?php echo e(old('obito') ? 'checked' : ''); ?>>
                                    <span class="slider round"></span>
                                </label>
                                <?php $__errorArgs = ['obito'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div><small class="text-danger"><?php echo e($message); ?></small></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="text-center me-4">
                                <label class="form-label d-block mb-2">Suspendida</label>
                                <label class="switch switch-suspendida">
                                    <input type="checkbox" name="suspendida" id="suspendida" value="1"
                                        <?php echo e(old('suspendida') ? 'checked' : ''); ?>>
                                    <span class="slider round"></span>
                                </label>
                                <?php $__errorArgs = ['suspendida'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div><small class="text-danger"><?php echo e($message); ?></small></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        
                        <div class="col-md-6" id="contenedor_observacion_suspension" style="<?php echo e(old('suspendida') ? '' : 'display: none;'); ?>">
                            <label for="observacion_suspension" class="form-label fw-semibold text-danger">Motivo / Observación de suspensión</label>
                            <textarea name="observacion_suspension" id="observacion_suspension" class="form-control" rows="2" placeholder="Ingrese el motivo por el cual se suspendió la cirugía"><?php echo e(old('observacion_suspension')); ?></textarea>
                            <?php $__errorArgs = ['observacion_suspension'];
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

                    <!-- Botones -->
                    <div class="flex justify-between pt-4 gap-2 flex-wrap">
                        <a href="<?php echo e(route('cirugias.index')); ?>"
                            class="btn btn-outline-danger px-5 py-2 rounded shadow-sm">
                            Cancelar
                        </a>

                        <div class="flex gap-2">
                            <button type="submit" name="action" value="cargar_medicamentos"
                                class="inline-block bg-[#1B7D8F] hover:bg-[#15606e] text-white font-medium py-2 px-6 rounded-full shadow-md cursor-pointer transition duration-300">
                                Registrar y Cargar Medicamentos
                            </button>
                            <button type="submit"
                                class="inline-block bg-neutral-700 hover:bg-neutral-800 text-white font-medium py-2 px-6 rounded-full shadow-md cursor-pointer transition duration-300">
                                Registrar Cirugía
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>

    <?php $__env->startPush('scripts'); ?>
    <!-- Select2 CSS/JS (mantener como estaba) -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <style>
        /* Select2 styling */
        .select2-container--default .select2-selection--single {
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
            height: 38px;
            padding: 5px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px;
        }

        /* Switch basic */
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
        }

        /* Default checked color (urgencia) */
        .switch-urgencia input:checked+.slider {
            background-color: #13850bff;
        }

        .switch-urgencia input:focus+.slider {
            box-shadow: 0 0 1px #13850bff;
        }

        .switch-urgencia input:checked+.slider:before {
            transform: translateX(26px);
        }

        /* Óbito: checked color black */
        .switch-obito input:checked+.slider {
            background-color: #000;
        }

        .switch-obito input:focus+.slider {
            box-shadow: 0 0 1px #000;
        }

        .switch-obito input:checked+.slider:before {
            transform: translateX(26px);
        }

        /* Suspendida: checked color red */
        .switch-suspendida input:checked+.slider {
            background-color: #dc3545;
        }

        .switch-suspendida input:focus+.slider {
            box-shadow: 0 0 1px #dc3545;
        }

        .switch-suspendida input:checked+.slider:before {
            transform: translateX(26px);
        }

        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

        /* Minor responsive tweak so the urgency/óbito area stacks on small screens */
        @media (max-width: 767px) {
            .d-flex {
                display: flex !important;
                flex-direction: column !important;
                gap: 0.75rem;
                align-items: center;
            }
        }
    </style>
    <script>
$(document).ready(function () {
    // Toggle observacion_suspension
    $('#suspendida').on('change', function () {
        if ($(this).is(':checked')) {
            $('#contenedor_observacion_suspension').slideDown();
        } else {
            $('#contenedor_observacion_suspension').slideUp();
            $('#observacion_suspension').val('');
        }
    });

    // Inicializar Select2
    $('.select2').select2({
        placeholder: "Seleccione una opción",
        allowClear: true,
        width: '100%'
    });

    // Restaurar valores antiguos
    const oldEspecialidadId = "<?php echo e(old('especialidad_id')); ?>";
    const oldProcedimientoId = "<?php echo e(old('procedimiento_id')); ?>";
    const oldProcedimiento2Id = "<?php echo e(old('procedimiento_2_id')); ?>";

    // Función genérica para cargar procedimientos
    function cargarProcedimientos(especialidadId, selector, selectedId = null) {
        fetch(`/medstats-api/procedimientos/${especialidadId}`)
            .then(res => res.json())
            .then(data => {
                const select = $(selector);
                select.html('<option value="">Seleccione un procedimiento</option>');
                data.forEach(p => {
                    const selected = (selectedId == p.id) ? 'selected' : '';
                    select.append(`<option value="${p.id}" ${selected}>${p.nombre_procedimiento}</option>`);
                });
                select.trigger('change'); // Refresca visualmente
            });
    }

    // Evento cambio de especialidad
    $('#especialidad').on('change', function () {
        const especialidadId = $(this).val();
        if (especialidadId) {
            cargarProcedimientos(especialidadId, '#procedimiento');
            cargarProcedimientos(especialidadId, '#procedimiento2');
        } else {
            $('#procedimiento, #procedimiento2').html('<option value="">Seleccione un procedimiento</option>');
        }
    });

    // Restaurar valores si hay datos viejos
    if (oldEspecialidadId) {
        $('#especialidad').val(oldEspecialidadId).trigger('change');
        cargarProcedimientos(oldEspecialidadId, '#procedimiento', oldProcedimientoId);
        cargarProcedimientos(oldEspecialidadId, '#procedimiento2', oldProcedimiento2Id);
    }

    const grupos = {
        enfermeros: ['#enfermero_id', '#enfermero_2_id'],
        procedimientos: ['#procedimiento', '#procedimiento2'],
        ayudantes: ['#ayudante_1_id', '#ayudante_2_id', '#ayudante_3_id'],
        instrumentadores: ['#instrumentador_id', '#instrumentador_2_id'],
        anestesias: ['#tipo_anestesia_id', '#tipo_anestesia_2_id']
    };

    // Función para deshabilitar opciones repetidas
    function actualizarOpcionesUnificadas(grupoSelectores) {
    if (grupoSelectores.length < 2) return;

    const valoresSeleccionados = grupoSelectores.map(id => $(id).val()).filter(val => val !== '');

    grupoSelectores.forEach(selector => {
        const select = $(selector);
        const valorActual = select.val();

        // Deshabilitar opciones duplicadas
        select.find('option').each(function () {
            const val = $(this).attr('value');
            if (!val) return;

            const debeDeshabilitar = val !== valorActual && valoresSeleccionados.includes(val);
            $(this).prop('disabled', debeDeshabilitar);
        });

        // Refrescar Select2 correctamente
        if (select.hasClass('select2')) {
            select.select2('destroy'); // Eliminar instancia actual
            select.select2({
                placeholder: "Seleccione una opción",
                allowClear: true,
                width: '100%'
            });
        }
    });
}

    // Activar deshabilitación dinámica en todos los grupos
    Object.values(grupos).forEach(grupo => {
        grupo.forEach(id => $(id).on('change', () => actualizarOpcionesUnificadas(grupo)));
        actualizarOpcionesUnificadas(grupo);
    });

    // Función para detectar duplicados
    function hayDuplicados(valores) {
        const filtrados = valores.filter(v => v !== '');
        return filtrados.some((v, i) => filtrados.indexOf(v) !== i);
    }

    // Validación al enviar el formulario
    $('form').on('submit', function (e) {
        for (const [nombreGrupo, grupo] of Object.entries(grupos)) {
            const seleccionados = grupo.map(id => $(id).val());
            if (hayDuplicados(seleccionados)) {
                e.preventDefault();
                alert(`Los valores seleccionados en "${nombreGrupo}" deben ser diferentes.`);
                break;
            }
        }
    });

    // Función para cambiar color de fondo si está completado
    function actualizarColorFondo() {
        const bgColor = '#e6f4f3';
        const whiteColor = '#ffffff';

        // Para inputs y selects normales
        $('input, select, textarea').not('.select2-hidden-accessible, [type="checkbox"], [type="hidden"], [type="search"]').each(function() {
            if ($(this).val() && $(this).val() !== '' && $(this).val() !== '0') {
                $(this).css('background-color', bgColor);
            } else {
                $(this).css('background-color', whiteColor);
            }
        });

        // Para select2
        $('.select2-hidden-accessible').each(function() {
            const select2Container = $(this).next('.select2-container').find('.select2-selection');
            if ($(this).val() && $(this).val() !== '') {
                select2Container.css('background-color', bgColor);
            } else {
                select2Container.css('background-color', whiteColor);
            }
        });
    }

    // Ejecutar al cargar la página (con un pequeño delay para select2 si es necesario, pero suele ser inmediato)
    setTimeout(actualizarColorFondo, 100);

    // Ejecutar al cambiar cualquier input/select/textarea
    $(document).on('change input', 'input, select, textarea', function() {
        actualizarColorFondo();
    });
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\MedStats-trazabilidad\resources\views/cirugias/create.blade.php ENDPATH**/ ?>