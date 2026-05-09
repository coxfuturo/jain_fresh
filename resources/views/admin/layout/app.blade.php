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

        #sidebar {
            min-width: 250px;
            max-width: 250px;
            background: #fcfcfc;
            color: #000000;
            transition: all 0.3s;
        }

        #sidebar.active {
            margin-left: -250px;
        }

        #sidebar .sidebar-header {

            padding: 20px;
            background: #fafafa;
        }


        #sidebar ul.components {
            padding: 20px 0;
            border-bottom: 1px solid #343a40;
        }

        #sidebar ul p {
            color: #fff;
            padding: 10px;
        }

        #sidebar ul li a {
            padding: 10px 20px;
            font-size: 1.1em;
            display: block;
            color: #adb5bd;
            text-decoration: none;
            transition: all 0.3s;
        }

        #sidebar ul li a:hover {
            color: #fff;
            background: #343a40;
        }

        #sidebar ul li.active > a {
            color: #fff;
            background: #0d6efd;
            border-left: 4px solid #fff;
        }
</style
    @stack('styles')
</head>
<body>

    <div class="wrapper">
        
        <!-- Sidebar -->
        @include('admin.layout.sidebar')

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

            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('active');
                    content.classList.toggle('active');
                });
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
