<?php $__env->startSection('contenido'); ?>
    <div class="container-fluid py-4">
        
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h2 class="text-3xl font-bold text-gray-800 tracking-tight">
                    Estadísticas de Cirugías
                </h2>
                <p class="text-gray-500 mt-1">Resumen y métricas clave del quirófano</p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <a href="<?php echo e(route('stocks.estadisticasstock')); ?>" 
                   class="btn bg-white text-gray-700 shadow-sm hover:shadow-md border border-gray-200 d-flex align-items-center px-4 py-2 rounded-lg transition-all">
                    <i class="bi bi-box-seam me-2 text-[#1B7D8F]"></i> 
                    <span class="font-medium">Estadísticas de Stock</span>
                </a>
                <a href="<?php echo e(route('trazabilidad.estadisticas')); ?>" 
                   class="btn bg-white text-gray-700 shadow-sm hover:shadow-md border border-gray-200 d-flex align-items-center px-4 py-2 rounded-lg transition-all">
                    <i class="bi bi-droplet-half me-2 text-[#1B7D8F]"></i>
                    <span class="font-medium">Estadísticas de Esterilización</span>
                </a>
            </div>
        </div>

        
        <form method="GET" action="<?php echo e(route('cirugias.estadisticas')); ?>" 
              class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 mb-5 transition-all hover:shadow-md">
            <?php if(request('anio')): ?> <input type="hidden" name="anio" value="<?php echo e(request('anio')); ?>"> <?php endif; ?>
            <div class="row g-4 align-items-end">
                <div class="col-md-3">
                    <label for="desde" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">
                        Desde
                    </label>
                    <input type="date" name="desde" id="desde" value="<?php echo e(request('desde')); ?>" 
                           class="form-control bg-gray-50 border-gray-200 rounded-lg focus:ring-[#1B7D8F] focus:border-[#1B7D8F] text-gray-700">
                </div>

                <div class="col-md-3">
                    <label for="hasta" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">
                        Hasta
                    </label>
                    <input type="date" name="hasta" id="hasta" value="<?php echo e(request('hasta')); ?>" 
                           class="form-control bg-gray-50 border-gray-200 rounded-lg focus:ring-[#1B7D8F] focus:border-[#1B7D8F] text-gray-700">
                </div>

                <div class="col-md-2">
                    <label for="especialidad_id" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">
                        Especialidad
                    </label>
                    <select name="especialidad_id" id="especialidad_id" 
                            class="form-select bg-gray-50 border-gray-200 rounded-lg focus:ring-[#1B7D8F] focus:border-[#1B7D8F] text-gray-700" 
                            onchange="this.form.submit()">
                        <option value="">Todas</option>
                        <?php $__currentLoopData = $especialidades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $esp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($esp->id); ?>" <?php echo e($esp->id == request('especialidad_id') ? 'selected' : ''); ?>>
                                <?php echo e($esp->nombre); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="col-md-2">
                    <label for="cirujano_id" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">
                        Cirujano
                    </label>
                    <select name="cirujano_id" id="cirujano_id" 
                            class="form-select bg-gray-50 border-gray-200 rounded-lg focus:ring-[#1B7D8F] focus:border-[#1B7D8F] text-gray-700">
                        <option value="">Todos</option>
                        <?php $__currentLoopData = $cirujanosDisponibles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cirujano): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($cirujano->id); ?>" <?php echo e($cirujano->id == request('cirujano_id') ? 'selected' : ''); ?>>
                                <?php echo e($cirujano->apellido); ?>, <?php echo e($cirujano->nombre); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="col-md-2">
                    <button type="submit" 
                            class="btn w-100 rounded-lg d-flex align-items-center justify-content-center gap-2 text-white font-medium shadow-md hover:shadow-lg transition-all" 
                            style="background: linear-gradient(135deg, #1B7D8F 0%, #245360 100%);">
                        <i class="bi bi-funnel-fill"></i> Filtrar
                    </button>
                </div>
            </div>
        </form>

        <?php if($errors->has('desde') || $errors->has('hasta')): ?>
            <div class="alert alert-warning rounded-lg shadow-sm border-0 mb-4 d-flex align-items-center">
                <i class="bi bi-exclamation-triangle-fill me-3 text-warning fs-4"></i>
                <div>
                    <strong class="d-block text-gray-800">Atención</strong>
                    <ul class="mb-0 ps-3 text-sm text-gray-600">
                        <?php $__currentLoopData = $errors->get('desde'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <li><?php echo e($error); ?></li> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php $__currentLoopData = $errors->get('hasta'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <li><?php echo e($error); ?></li> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
        <?php endif; ?>

        <?php if(request('desde') && request('hasta')): ?>
            <div class="bg-blue-50 border border-blue-100 rounded-lg p-3 mb-5 d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center text-blue-800">
                    <i class="bi bi-calendar-check me-2"></i>
                    <span class="font-medium me-2">Filtro activo:</span>
                    <span><?php echo e(\Carbon\Carbon::parse(request('desde'))->format('d/m/Y')); ?> - <?php echo e(\Carbon\Carbon::parse(request('hasta'))->format('d/m/Y')); ?></span>
                </div>
                <a href="<?php echo e(route('cirugias.estadisticas')); ?>" class="text-sm text-blue-600 hover:text-blue-800 font-medium hover:underline">
                    Limpiar filtros
                </a>
            </div>
        <?php endif; ?>

        <div class="row g-4 mb-5">
            
            <div class="col-lg-6" data-aos="fade-up" data-aos-duration="800">
                <div class="card border-0 shadow-sm rounded-xl h-100 overflow-hidden">
                    <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="font-bold text-gray-800 mb-1">Resumen General</h5>
                            <p class="text-sm text-gray-500 mb-0">Métricas de rendimiento anual</p>
                        </div>
                        <form method="GET" action="<?php echo e(route('cirugias.estadisticas')); ?>">
                            <?php if(request('desde')): ?> <input type="hidden" name="desde" value="<?php echo e(request('desde')); ?>"> <?php endif; ?>
                            <?php if(request('hasta')): ?> <input type="hidden" name="hasta" value="<?php echo e(request('hasta')); ?>"> <?php endif; ?>
                            <?php if(request('especialidad_id')): ?> <input type="hidden" name="especialidad_id" value="<?php echo e(request('especialidad_id')); ?>"> <?php endif; ?>
                            <?php if(request('cirujano_id')): ?> <input type="hidden" name="cirujano_id" value="<?php echo e(request('cirujano_id')); ?>"> <?php endif; ?>
                            <select name="anio" id="anio"
                                class="form-select form-select-sm bg-gray-50 border-gray-200 text-gray-600 font-medium rounded-lg"
                                onchange="this.form.submit()">
                                <?php $__currentLoopData = $aniosDisponibles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $anio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($anio); ?>" <?php echo e($anio == $anioSeleccionado ? 'selected' : ''); ?>>
                                        <?php echo e($anio); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </form>
                    </div>

                    <div class="card-body px-4">
                        
                        <div class="row g-3 mb-4">
                            <div class="col-4">
                                <div class="p-3 rounded-xl bg-blue-50 text-center h-100 border border-blue-100">
                                    <div class="text-xs font-bold text-blue-600 uppercase tracking-wider mb-1">Total</div>
                                    <div class="text-2xl font-bold text-gray-800"><?php echo e($total); ?></div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="p-3 rounded-xl bg-emerald-50 text-center h-100 border border-emerald-100">
                                    <div class="text-xs font-bold text-emerald-600 uppercase tracking-wider mb-1">Mensual</div>
                                    <div class="text-2xl font-bold text-gray-800"><?php echo e($promedioMensual); ?></div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="p-3 rounded-xl bg-amber-50 text-center h-100 border border-amber-100">
                                    <div class="text-xs font-bold text-amber-600 uppercase tracking-wider mb-1">Semanal</div>
                                    <div class="text-2xl font-bold text-gray-800"><?php echo e($promedioSemanal); ?></div>
                                </div>
                            </div>
                        </div>

                        <div style="height: 250px;">
                            <canvas id="cirugiasPorMes"></canvas>
                        </div>
                        
                        <div class="text-center mt-3">
                            <button type="button" class="btn btn-link text-decoration-none text-[#1B7D8F] font-medium text-sm" 
                                    data-bs-toggle="modal" data-bs-target="#modalCirugias">
                                Ver tabla detallada <i class="bi bi-arrow-right ms-1"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="col-lg-6" data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
                <div class="card border-0 shadow-sm rounded-xl h-100">
                    <div class="card-header bg-white border-0 pt-4 px-4">
                        <h5 class="font-bold text-gray-800 mb-1">Top Cirujanos</h5>
                        <p class="text-sm text-gray-500 mb-0">Profesionales con mayor actividad</p>
                    </div>
                    <div class="card-body px-4">
                        <div class="row align-items-center h-100">
                            <div class="col-md-7">
                                <div class="d-flex flex-column gap-3">
                                    <?php $__currentLoopData = $porCirujano->sortByDesc('total')->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="d-flex align-items-center justify-content-between p-2 rounded-lg hover:bg-gray-50 transition-colors">
                                            <div class="d-flex align-items-center gap-3">
                                                <span class="d-flex align-items-center justify-content-center w-6 h-6 rounded-full bg-gray-100 text-xs font-bold text-gray-500">
                                                    <?php echo e($index + 1); ?>

                                                </span>
                                                <span class="text-sm font-medium text-gray-700">
                                                    <?php echo e(optional($item->get_cirujano)->apellido); ?>, <?php echo e(optional($item->get_cirujano)->nombre); ?>

                                                </span>
                                            </div>
                                            <span class="badge bg-blue-100 text-blue-700 rounded-pill px-3 py-1">
                                                <?php echo e($item->total); ?>

                                            </span>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <button type="button" class="btn btn-link text-decoration-none text-[#1B7D8F] font-medium text-sm mt-3 ps-0"
                                        data-bs-toggle="modal" data-bs-target="#modalCirujanos">
                                    Ver listado completo <i class="bi bi-arrow-right ms-1"></i>
                                </button>
                            </div>
                            <div class="col-md-5 d-flex justify-content-center">
                                <div style="width: 200px; height: 200px;">
                                    <canvas id="graficoCirujanos"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-5">
            
            <div class="col-md-12" data-aos="fade-up" data-aos-duration="800">
                <div class="card border-0 shadow-sm rounded-xl h-100">
                    <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="font-bold text-gray-800 mb-1">Top 5 Cirugías / Procedimientos Más Realizados</h5>
                            <p class="text-sm text-gray-500 mb-0">Procedimientos con mayor frecuencia registrados</p>
                        </div>
                    </div>
                    <div class="card-body px-4">
                        <div class="row align-items-center">
                            <div class="col-md-7">
                                <div class="d-flex flex-column gap-3">
                                    <?php $__currentLoopData = $topProcedimientos->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="d-flex align-items-center justify-content-between p-2 rounded-lg hover:bg-gray-50 transition-colors">
                                            <div class="d-flex align-items-center gap-3">
                                                <span class="d-flex align-items-center justify-content-center w-6 h-6 rounded-full bg-teal-100 text-xs font-bold text-teal-700">
                                                    <?php echo e($index + 1); ?>

                                                </span>
                                                <span class="text-sm font-medium text-gray-700">
                                                    <?php echo e(optional($item->get_procedimiento)->nombre_procedimiento ?? 'Sin especificar'); ?>

                                                </span>
                                            </div>
                                            <span class="badge bg-teal-50 text-teal-700 rounded-pill px-3 py-1 font-bold">
                                                <?php echo e($item->total); ?>

                                            </span>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <button type="button" class="btn btn-link text-decoration-none text-[#1B7D8F] font-medium text-sm mt-3 ps-0"
                                        data-bs-toggle="modal" data-bs-target="#modalProcedimientos">
                                    Ver todos los procedimientos <i class="bi bi-arrow-right ms-1"></i>
                                </button>
                            </div>
                            <div class="col-md-5 d-flex justify-content-center">
                                <div style="width: 220px; height: 220px;">
                                    <canvas id="graficoProcedimientos"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-5">
            
            <div class="col-md-6" data-aos="fade-up" data-aos-duration="800">
                <div class="card border-0 shadow-sm rounded-xl h-100">
                    <div class="card-header bg-white border-0 pt-4 px-4">
                        <h5 class="font-bold text-gray-800 mb-1">Enfermería</h5>
                        <p class="text-sm text-gray-500 mb-0">Personal de asistencia destacado</p>
                    </div>
                    <div class="card-body px-4 d-flex align-items-center">
                        <div class="flex-grow-1">
                            <ul class="list-unstyled mb-0 d-flex flex-column gap-2">
                                <?php $__currentLoopData = $topEnfermeros->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="d-flex justify-content-between align-items-center text-sm text-gray-700 border-b border-gray-50 pb-2">
                                        <span><?php echo e(optional($item->get_enfermero)->nombre); ?> <?php echo e(optional($item->get_enfermero)->apellido); ?></span>
                                        <span class="font-bold text-gray-900"><?php echo e($item->total); ?></span>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                            <button type="button" class="btn btn-link text-decoration-none text-[#1B7D8F] font-medium text-sm mt-2 ps-0" 
                                    data-bs-toggle="modal" data-bs-target="#modalEnfermeros">
                                Ver todos
                            </button>
                        </div>
                        <div class="ms-3">
                            <div style="width: 140px; height: 140px;">
                                <canvas id="graficoEnfermeros"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="col-md-6" data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
                <div class="card border-0 shadow-sm rounded-xl h-100">
                    <div class="card-header bg-white border-0 pt-4 px-4">
                        <h5 class="font-bold text-gray-800 mb-1">Instrumentación</h5>
                        <p class="text-sm text-gray-500 mb-0">Personal técnico destacado</p>
                    </div>
                    <div class="card-body px-4 d-flex align-items-center">
                        <div class="flex-grow-1">
                            <ul class="list-unstyled mb-0 d-flex flex-column gap-2">
                                <?php $__currentLoopData = $topInstrumentadors->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="d-flex justify-content-between align-items-center text-sm text-gray-700 border-b border-gray-50 pb-2">
                                        <span><?php echo e(optional($item->get_instrumentador)->nombre); ?> <?php echo e(optional($item->get_instrumentador)->apellido); ?></span>
                                        <span class="font-bold text-gray-900"><?php echo e($item->total); ?></span>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                            <button type="button" class="btn btn-link text-decoration-none text-[#1B7D8F] font-medium text-sm mt-2 ps-0"
                                    data-bs-toggle="modal" data-bs-target="#modalInstrumentadors">
                                Ver todos
                            </button>
                        </div>
                        <div class="ms-3">
                            <div style="width: 140px; height: 140px;">
                                <canvas id="graficoInstrumentadors"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="card border-0 shadow-sm rounded-xl mb-5" data-aos="fade-up">
            <div class="card-header bg-white border-0 pt-4 px-4">
                <h5 class="font-bold text-gray-800 mb-1">Tipo de Intervención</h5>
                <p class="text-sm text-gray-500 mb-0">Comparativa Urgencias vs Programadas</p>
            </div>
            <div class="card-body px-4">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <div class="d-flex flex-column gap-3">
                            <div class="p-3 rounded-xl bg-red-50 border border-red-100">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-red-700 font-medium">Urgencias</span>
                                    <span class="text-2xl font-bold text-red-700"><?php echo e($urgentes); ?></span>
                                </div>
                            </div>
                            <div class="p-3 rounded-xl bg-amber-50 border border-amber-100">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-amber-700 font-medium">Programadas</span>
                                    <span class="text-2xl font-bold text-amber-700"><?php echo e($programadas); ?></span>
                                </div>
                            </div>
                            <div class="text-center mt-2">
                                <span class="text-sm text-gray-500">Tasa de Urgencias</span>
                                <div class="text-3xl font-bold text-gray-800">
                                    <?php if($urgentes + $programadas > 0): ?>
                                        <?php echo e(round(($urgentes / ($urgentes + $programadas)) * 100, 1)); ?>%
                                    <?php else: ?>
                                        0%
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div style="height: 250px;">
                            <?php if($urgentes + $programadas > 0): ?>
                                <canvas id="graficoUrgenciasProgramadas"></canvas>
                            <?php else: ?>
                                <div class="d-flex align-items-center justify-content-center h-100 bg-gray-50 rounded-xl text-gray-400">
                                    Sin datos suficientes
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    
<?php $__env->startPush('modales'); ?>
    
    <div class="modal fade" id="modalProcedimientos" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg rounded-xl">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title font-bold text-gray-800">Listado de Procedimientos / Cirugías</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="text-xs text-gray-500 uppercase bg-gray-50">
                                <tr>
                                    <th class="border-0 rounded-start py-3">Procedimiento</th>
                                    <th class="border-0 text-end rounded-end py-3">Cantidad Realizada</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $topProcedimientos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="border-gray-100 py-3 font-medium text-gray-800">
                                            <?php echo e(optional($item->get_procedimiento)->nombre_procedimiento ?? 'Sin especificar'); ?>

                                        </td>
                                        <td class="border-gray-100 text-end py-3">
                                            <span class="badge bg-teal-50 text-teal-700 rounded-pill px-3 py-2 font-bold"><?php echo e($item->total); ?></span>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="modalCirugias" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-xl">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title font-bold text-gray-800">Detalle Mensual</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-hover">
                        <thead class="text-xs text-gray-500 uppercase bg-gray-50">
                            <tr><th class="border-0 rounded-start">Mes</th><th class="border-0 text-end rounded-end">Total</th></tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $porMes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="border-gray-100"><?php echo e($item->mes_nombre); ?></td>
                                    <td class="border-gray-100 text-end font-bold text-[#1B7D8F]"><?php echo e($item->total); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    
    <div class="modal fade" id="modalCirujanos" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg rounded-xl">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title font-bold text-gray-800">Listado de Cirujanos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="text-xs text-gray-500 uppercase bg-gray-50">
                                <tr>
                                    <th class="border-0 rounded-start py-3">Profesional</th>
                                    <th class="border-0 text-end rounded-end py-3">Intervenciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $porCirujano->sortByDesc('total'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="border-gray-100 py-3">
                                            <div class="font-medium text-gray-800"><?php echo e(optional($item->get_cirujano)->apellido); ?></div>
                                            <div class="text-sm text-gray-500"><?php echo e(optional($item->get_cirujano)->nombre); ?></div>
                                        </td>
                                        <td class="border-gray-100 text-end py-3">
                                            <span class="badge bg-blue-50 text-blue-700 rounded-pill px-3 py-2"><?php echo e($item->total); ?></span>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="modal fade" id="modalEnfermeros" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg rounded-xl">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title font-bold text-gray-800">Listado de Enfermería</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-hover align-middle">
                        <thead class="text-xs text-gray-500 uppercase bg-gray-50">
                            <tr><th class="border-0 rounded-start py-3">Nombre</th><th class="border-0 text-end rounded-end py-3">Asistencias</th></tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $topEnfermeros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="border-gray-100 py-3"><?php echo e(optional($item->get_enfermero)->apellido); ?>, <?php echo e(optional($item->get_enfermero)->nombre); ?></td>
                                    <td class="border-gray-100 text-end py-3"><span class="badge bg-emerald-50 text-emerald-700 rounded-pill px-3 py-2"><?php echo e($item->total); ?></span></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    
    <div class="modal fade" id="modalInstrumentadors" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg rounded-xl">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title font-bold text-gray-800">Listado de Instrumentadores</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-hover align-middle">
                        <thead class="text-xs text-gray-500 uppercase bg-gray-50">
                            <tr><th class="border-0 rounded-start py-3">Nombre</th><th class="border-0 text-end rounded-end py-3">Asistencias</th></tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $topInstrumentadors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="border-gray-100 py-3"><?php echo e(optional($item->get_instrumentador)->apellido); ?>, <?php echo e(optional($item->get_instrumentador)->nombre); ?></td>
                                    <td class="border-gray-100 text-end py-3"><span class="badge bg-amber-50 text-amber-700 rounded-pill px-3 py-2"><?php echo e($item->total); ?></span></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Chart.defaults.font.family = "'Inter', sans-serif";
            Chart.defaults.color = '#64748b';
            
            const commonOptions = {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { usePointStyle: true, padding: 20, boxWidth: 8 }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(255, 255, 255, 0.95)',
                        titleColor: '#1e293b',
                        bodyColor: '#475569',
                        borderColor: '#e2e8f0',
                        borderWidth: 1,
                        padding: 12,
                        displayColors: true,
                        boxPadding: 4
                    }
                }
            };

            // Cirugías por mes - Bar Chart Moderno
            new Chart(document.getElementById('cirugiasPorMes'), {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($porMesLabels); ?>,
                    datasets: [{
                        label: 'Cirugías',
                        data: <?php echo json_encode($porMesValores); ?>,
                        backgroundColor: '#1B7D8F',
                        borderRadius: 6,
                        barThickness: 24
                    }]
                },
                options: {
                    ...commonOptions,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: '#f1f5f9', drawBorder: false },
                            ticks: { padding: 10 }
                        },
                        x: {
                            grid: { display: false, drawBorder: false }
                        }
                    }
                }
            });

            // Donut Charts Config
            const donutColors = ['#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6', '#ec4899', '#06b6d4'];
            const donutOptions = {
                ...commonOptions,
                cutout: '75%',
                plugins: {
                    ...commonOptions.plugins,
                    legend: { display: false } // Ocultamos leyenda en donuts pequeños para limpieza
                }
            };

            // Cirujanos
            new Chart(document.getElementById('graficoCirujanos'), {
                type: 'doughnut',
                data: {
                    labels: <?php echo json_encode($cirujanoLabels, 15, 512) ?>,
                    datasets: [{
                        data: <?php echo json_encode($cirujanoValores, 15, 512) ?>,
                        backgroundColor: donutColors,
                        borderWidth: 0
                    }]
                },
                options: donutOptions
            });

            // Procedimientos / Cirugías más realizadas
            new Chart(document.getElementById('graficoProcedimientos'), {
                type: 'doughnut',
                data: {
                    labels: <?php echo json_encode($procedimientoLabels, 15, 512) ?>,
                    datasets: [{
                        data: <?php echo json_encode($procedimientoValores, 15, 512) ?>,
                        backgroundColor: donutColors,
                        borderWidth: 0
                    }]
                },
                options: donutOptions
            });

            // Enfermeros
            new Chart(document.getElementById('graficoEnfermeros'), {
                type: 'doughnut',
                data: {
                    labels: <?php echo json_encode($enfermeroLabels, 15, 512) ?>,
                    datasets: [{
                        data: <?php echo json_encode($enfermeroValores, 15, 512) ?>,
                        backgroundColor: donutColors,
                        borderWidth: 0
                    }]
                },
                options: donutOptions
            });

            // Instrumentadores
            new Chart(document.getElementById('graficoInstrumentadors'), {
                type: 'doughnut',
                data: {
                    labels: <?php echo json_encode($instrumentadorLabels, 15, 512) ?>,
                    datasets: [{
                        data: <?php echo json_encode($instrumentadorValores, 15, 512) ?>,
                        backgroundColor: donutColors,
                        borderWidth: 0
                    }]
                },
                options: donutOptions
            });

            // Urgencias vs Programadas
            new Chart(document.getElementById('graficoUrgenciasProgramadas'), {
                type: 'doughnut', // Cambiado a bar horizontal para mejor comparación o mantener doughnut
                data: {
                    labels: ['Urgentes', 'Programadas'],
                    datasets: [{
                        data: [<?php echo e($urgentes); ?>, <?php echo e($programadas); ?>],
                        backgroundColor: ['#ef4444', '#f59e0b'],
                        borderWidth: 0
                    }]
                },
                options: {
                    ...commonOptions,
                    cutout: '60%'
                }
            });
        });
        AOS.init();
    </script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app_estadisticas', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\MedStats-trazabilidad\resources\views/cirugias/estadisticas.blade.php ENDPATH**/ ?>