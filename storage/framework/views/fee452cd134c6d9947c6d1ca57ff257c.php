<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('titulo', 'Estadísticas'); ?></title>

    <!-- Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Tailwind (CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>">
    <!-- Archivo CSS opcional específico para estadísticas -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/estadisticas.css')); ?>">

    <!-- jQuery UI CSS -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>


        body {
            background-color: #e6f4f3;
            color: #1a1a1a;
            font-family: 'Poppins', sans-serif;
        }

        main {
            padding-top: 5rem;
            padding-bottom: 3rem;
        }

        .card {
            border-radius: 0.75rem;
        }

        /* Pequeñas adaptaciones visuales para mantener look & feel */
        .bg-info { background-image: none; }
    </style>
</head>

<body class="bg-[#e6f4f3] text-gray-900">
    <?php echo $__env->make('layouts._partials.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="flex min-h-screen"> <!-- Contenedor para sidebar + contenido -->
        <?php echo $__env->make('layouts._partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <!-- Tu sidebar expandible -->


        <!--<main class="flex-1 p-8 pb-20 transition-all duration-300 ease-in-out">

    <div class="max-w-full mx-auto">-->

        <main id="mainContent" class="flex-1 pt-20 px-8 pb-20 transition-all duration-300 ease-in-out transform">
            <div class="max-w-full mx-auto">

                <?php echo $__env->yieldContent('contenido'); ?>
                
            </div>
        </main>
    </div>


    <?php echo $__env->make('components.boton-volver', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('layouts._partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- jQuery UI -->
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <!-- Chart.js y AOS los cargamos solo cuando la vista los necesita (pero pueden estar aquí) -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

    <script>
        if (window.lucide) lucide.createIcons();
        if (window.AOS) AOS.init();
    </script>

    <script>

    </script>



    <?php echo $__env->yieldPushContent('scripts'); ?>
    <?php echo $__env->yieldPushContent('modales'); ?>
</body>

</html>
<?php /**PATH C:\laragon\www\MedStats-trazabilidad\resources\views/layouts/app_estadisticas.blade.php ENDPATH**/ ?>