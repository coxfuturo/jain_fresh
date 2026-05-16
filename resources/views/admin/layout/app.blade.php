<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') | Zain Fresh</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Custom Modern Admin CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin-custom.css') }}">
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .wrapper {
            display: flex;
            width: 100%;
            align-items: stretch;
            min-height: 100vh;
        }

    </style>
    @stack('styles')
</head>
<body>

    <div class="wrapper">
        
        <!-- Sidebar -->
        @include('admin.layout.sidebar')
        <div id="sidebarOverlay" class="d-none" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 998; backdrop-filter: blur(2px);"></div>

        <!-- Main Content -->
        <div id="content">
            
            <!-- Header -->
            @include('admin.layout.header')

            <!-- Main Page Content -->
            <div class="container-fluid p-4">
                @yield('content')
            </div>
            
            <!-- Footer -->
            @include('admin.layout.footer')
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Sidebar Toggle Script -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('sidebar');
            const content = document.getElementById('content');
            const overlay = document.getElementById('sidebarOverlay');

            function toggleSidebar() {
                sidebar.classList.toggle('active');
                content.classList.toggle('active');
                
                if (window.innerWidth <= 992) {
                    overlay.classList.toggle('d-none');
                }
            }

            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function(e) {
                    e.stopPropagation();
                    toggleSidebar();
                });
            }

            if (overlay) {
                overlay.addEventListener('click', toggleSidebar);
            }

            // Close sidebar on window resize if it's open on mobile
            window.addEventListener('resize', function() {
                if (window.innerWidth > 992) {
                    overlay.classList.add('d-none');
                } else if (sidebar.classList.contains('active')) {
                    // Keep overlay if sidebar was toggled on mobile
                    overlay.classList.remove('d-none');
                }
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
