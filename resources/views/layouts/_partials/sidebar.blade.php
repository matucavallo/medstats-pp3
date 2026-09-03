<!-- Sidebar global -->
<aside id="sidebar"
    class="fixed top-16 left-0 h-[calc(100vh-4rem)] w-20 bg-white shadow-xl flex flex-col transition-all duration-300 ease-in-out z-40 border-r border-gray-100 sidebar-colapsado collapsed">

    <!-- Header del sidebar -->
    <div class="flex items-center justify-between px-4 h-16 border-b border-gray-100 shrink-0">
        <span id="sidebar-title" class="font-bold text-[#1B7D8F] text-lg hidden whitespace-nowrap overflow-hidden transition-all duration-300">Menú</span>
        <button id="toggleSidebar" aria-expanded="false" aria-label="Abrir menú" class="p-2 rounded-lg hover:bg-gray-50 text-gray-500 hover:text-[#1B7D8F] focus:outline-none transition-colors mx-auto">
            <i data-lucide="menu" class="w-6 h-6"></i>
        </button>
    </div>

    <!-- Contenido Scrollable -->
    <div class="flex-1 overflow-y-auto py-4 space-y-1 px-3 custom-scrollbar">

                    <!-- Botón Inicio -->
            @php
                $rutaActual = request()->route() ? request()->route()->getName() : '';
            @endphp

            @if ($rutaActual !== 'inicio')
                <a href="{{ route('inicio') }}" 
                class="flex items-center gap-3 p-3 rounded-xl text-gray-600 hover:bg-gray-50 hover:text-[#1B7D8F] transition-all group relative overflow-hidden"
                title="Inicio">
                    <i data-lucide="home" class="w-6 h-6 flex-shrink-0"></i>
                    <span class="link-text font-medium whitespace-nowrap hidden opacity-0 transition-opacity duration-300">Inicio</span>

                    <!-- Tooltip para modo colapsado -->
                    <div class="absolute left-full top-1/2 -translate-y-1/2 ml-2 px-2 py-1 bg-gray-800 text-white text-xs rounded opacity-0 group-hover:opacity-100 pointer-events-none transition-opacity z-50 whitespace-nowrap md:hidden">
                        Inicio
                    </div>
                </a>
                <div class="my-2 border-t border-gray-100 mx-2"></div>
            @endif

        <!-- Links Principales -->
        @php
            $menuItems = [
                ['route' => 'stocks.index', 'title' => 'Insumos', 'icon' => 'package', 'access' => 'insumos'],
                ['route' => 'trazabilidad.index', 'title' => 'Trazabilidad', 'icon' => 'git-commit', 'access' => 'insumos'],
                ['route' => 'cirugias.estadisticas', 'title' => 'Estadísticas', 'icon' => 'bar-chart-2', 'access' => 'estadisticas'],
                ['route' => 'pacientes.index', 'title' => 'Pacientes', 'icon' => 'users', 'access' => 'pacientes'],
                ['route' => 'camas.index', 'title' => 'Camas', 'icon' => 'bed', 'access' => 'camas'],
                ['route' => 'cirugias.index', 'title' => 'Cirugías', 'icon' => 'activity', 'access' => 'cirugias'],
                ['route' => 'ajustes', 'title' => 'Ajustes', 'icon' => 'settings', 'access' => null], // Visible para todos
            ];
        @endphp

        @foreach($menuItems as $item)
            @if(Auth::user()->hasAccess($item['access']))
            <a href="{{ route($item['route']) }}" 
               class="flex items-center gap-3 p-3 rounded-xl transition-all group relative overflow-hidden
                      {{ request()->routeIs($item['route']) ? 'bg-[#1B7D8F]/10 text-[#1B7D8F]' : 'text-gray-600 hover:bg-gray-50 hover:text-[#1B7D8F]' }}"
               title="{{ $item['title'] }}">
                <i data-lucide="{{ $item['icon'] }}" class="w-6 h-6 flex-shrink-0"></i>
                <span class="link-text font-medium whitespace-nowrap hidden opacity-0 transition-opacity duration-300">{{ $item['title'] }}</span>
            </a>
            @endif
        @endforeach

    </div>

    <!-- Footer del Sidebar (Logout) -->
    <div class="p-3 border-t border-gray-100 shrink-0">
        <form method="POST" action="{{ route('logout') }}" onsubmit="return confirm('¿Seguro que querés cerrar sesión?');">
            @csrf
            <button type="submit"
                class="w-full flex items-center gap-3 p-3 rounded-xl text-red-500 hover:bg-red-50 transition-all group relative overflow-hidden"
                title="Cerrar Sesión">
                <i data-lucide="log-out" class="w-6 h-6 flex-shrink-0"></i>
                <span class="link-text font-medium whitespace-nowrap hidden opacity-0 transition-opacity duration-300">Cerrar Sesión</span>
            </button>
        </form>
    </div>

</aside>

<style>
    /* Estilos para el scrollbar personalizado */
    .custom-scrollbar::-webkit-scrollbar {
        width: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background-color: #e5e7eb;
        border-radius: 20px;
    }
    .custom-scrollbar:hover::-webkit-scrollbar-thumb {
        background-color: #d1d5db;
    }
</style>

<script>
    function initSidebar() {
        if (window.lucide) lucide.createIcons();
        
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('toggleSidebar');
        const linkTexts = document.querySelectorAll('.link-text');
        const sidebarTitle = document.getElementById('sidebar-title');
        const mainContent = document.getElementById('mainContent'); 

        // Función original intacta para aplicar el estado visual
        function setSidebarState(expanded) {
            const footer = document.getElementById('footer');
            
            if (expanded) {
                sidebar.classList.remove('w-20', 'sidebar-colapsado', 'collapsed');
                sidebar.classList.add('w-64', 'sidebar-expandido');

                if (toggleBtn) {
                toggleBtn.setAttribute('aria-expanded', 'true');
                toggleBtn.setAttribute('aria-label', 'Cerrar menú');
                }
                
                linkTexts.forEach(el => {
                    el.classList.remove('hidden');
                    setTimeout(() => el.classList.remove('opacity-0'), 50);
                });
                
                if(sidebarTitle) {
                    sidebarTitle.classList.remove('hidden');
                    setTimeout(() => sidebarTitle.classList.remove('opacity-0'), 50);
                }

                if(mainContent) {
                    mainContent.style.marginLeft = "16rem";
                    mainContent.style.transform = "scale(0.98)";
                }
                
                if(footer) {
                    footer.style.marginLeft = "16rem";
                    footer.style.width = "calc(100% - 16rem)";
                    footer.style.transition = "all 0.3s ease-in-out";
                }

            } else {
                sidebar.classList.remove('w-64', 'sidebar-expandido');
                sidebar.classList.add('w-20', 'sidebar-colapsado', 'collapsed');

                if (toggleBtn) {
                    toggleBtn.setAttribute('aria-expanded', 'false');
                    toggleBtn.setAttribute('aria-label', 'Abrir menú');
                }
                
                linkTexts.forEach(el => {
                    el.classList.add('opacity-0');
                    el.classList.add('hidden');
                });

                if(sidebarTitle) {
                    sidebarTitle.classList.add('hidden');
                }

                if(mainContent) {
                    mainContent.style.marginLeft = "5rem";
                    mainContent.style.transform = "scale(1)";
                }
                
                if(footer) {
                    footer.style.marginLeft = "5rem";
                    footer.style.width = "calc(100% - 5rem)";
                    footer.style.transition = "all 0.3s ease-in-out";
                }
            }
        }

        // --- NUEVA LÓGICA DE INICIALIZACIÓN ESTÁTICA ---
        
        // 1. Apagamos transiciones temporalmente para el renderizado inicial
        sidebar.classList.remove('transition-all', 'duration-300');
        if(mainContent) mainContent.classList.remove('transition-all', 'duration-300');

        // 2. Forzamos el estado COLAPSADO (cerrado) por defecto en cada recarga
        setSidebarState(false);

        // 3. Forzamos Reflow para evitar parpadeos visuales
        void sidebar.offsetWidth; 

        // 4. Encendemos las animaciones para que el botón manual funcione con fluidez
        sidebar.classList.add('transition-all', 'duration-300');
        if(mainContent) mainContent.classList.add('transition-all', 'duration-300');

        // 5. Asignamos el evento al botón de las 3 líneas sin guardar en localStorage
        if (toggleBtn) {
            toggleBtn.onclick = function(event) {
                // Detenemos cualquier otro evento fantasma o propagación
                event.preventDefault(); 
                
                // Calculamos el estado actual y lo invertimos
                const isCurrentlyExpanded = sidebar.classList.contains('w-64');
                setSidebarState(!isCurrentlyExpanded);
            };
        }
    }
    document.addEventListener("DOMContentLoaded", initSidebar);
    document.addEventListener("turbo:load", initSidebar);
</script>