<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('titulo'); ?></title>
    <!-- Bootstrap -->
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>">
    <!-- jQuery UI CSS -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
        #mainContent {
            transform-origin: top left;
            /* para que el scale se haga desde la esquina */
        }
    </style>

</head>

<!--<body class="min-h-screen bg-gray-100">-->
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
    <style>
        #mainContent {
            padding-top: 5rem !important;
            /* fuerza el padding-top sin afectar padding otros lados */
        }
    </style>
    <!-- jQuery (solo una vez) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- jQuery UI JS -->
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Tailwind (si lo usás con CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- AOS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <!-- Lucide Iconos -->
    <script>
        if (window.lucide) {
            lucide.createIcons();
        } else {
            console.error('Lucide no se cargó correctamente');
        }
    </script>


    <script>
        window.addEventListener('scroll', () => {
            const footer = document.querySelector('footer');
            const boton = document.querySelector('.boton-volver');
            if (!footer || !boton) return;

            const footerRect = footer.getBoundingClientRect();
            const windowHeight = window.innerHeight;

            if (footerRect.top < windowHeight) {
                const overlap = windowHeight - footerRect.top;
                boton.style.bottom = (20 + overlap) + 'px';
            } else {
                boton.style.bottom = '20px';
            }
        });
    </script>

    <!-- Script del botón menú -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const menuBtn = document.getElementById("menuBtn");
            const dropdownMenu = document.getElementById("dropdownMenu");

            if (menuBtn && dropdownMenu) {
                menuBtn.addEventListener("click", function() {
                    dropdownMenu.classList.toggle("hidden");
                });
            }
        });
    </script>


        <script>
            window.addEventListener('load', ajustarPadding);
            window.addEventListener('resize', ajustarPadding);

            function ajustarPadding() {
                const header = document.querySelector('header'); // Cambia selector si tu header no es <header>
                const container = document.querySelector('.container');

                if (header && container) {
                    const alturaHeader = header.offsetHeight;
                    container.style.paddingTop = alturaHeader + 'px';
                }
            }
        </script>


    <!-- Scripts adicionales desde las vistas -->
    <?php echo $__env->yieldPushContent('scripts'); ?>

      <?php echo $__env->yieldPushContent('modales'); ?>

</body>
</html><?php /**PATH C:\laragon\www\MedStats-trazabilidad\resources\views/layouts/app.blade.php ENDPATH**/ ?>