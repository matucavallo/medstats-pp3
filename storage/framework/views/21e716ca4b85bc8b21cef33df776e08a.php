<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title>Inicio</title>

    <!-- Preload del CSS antes de cargar todo -->
    <link rel="preload" as="style" href="<?php echo e(Vite::asset('resources/css/app.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(Vite::asset('resources/css/app.css')); ?>">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>

<body class="font-sans text-gray-900 antialiased bg-[#f8fafc] transition-all duration-500">
    <div class="relative min-h-screen flex items-center justify-center p-4 bg-cover bg-center bg-no-repeat"
        style="background-image: url('<?php echo e(asset('assets/img/hospital.png')); ?>');">

        <div class="absolute inset-0 bg-white/55"></div>

        <div class="relative z-10 flex flex-col items-center justify-center w-full sm:max-w-md px-8 py-6 bg-white shadow-lg rounded-2xl">
            <?php echo e($slot); ?>

        </div>
    </div>
</body>

</html>
<?php /**PATH C:\laragon\www\MedStats-trazabilidad\resources\views/layouts/guest.blade.php ENDPATH**/ ?>