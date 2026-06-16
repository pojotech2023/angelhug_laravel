<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pojo Course Pilot Admin Panel</title>
    <link href="{{ asset('img/logo (2).png') }}" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <style>
        body {
            overflow-x: hidden;
            background: #f4f7fb;
        }
        .sidebar {
            position: fixed;
            top: 0;
            left: -250px;
            width: 250px;
            height: 100%;
            background: linear-gradient(180deg, #0b4f74 0%, #083954 100%);
            padding-top: 60px;
            transition: left 0.3s;
            z-index: 1030;
            box-shadow: 12px 0 28px rgba(8, 57, 84, 0.18);
        }
        .sidebar.active { left: 0; }
        .sidebar a {
            color: #fff !important;
            padding: 14px 18px;
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            font-weight: 600;
            margin: 8px 14px;
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 14px;
            background: rgba(255, 255, 255, 0.04);
            backdrop-filter: blur(4px);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.04);
            transition: background-color 0.2s ease, border-color 0.2s ease, transform 0.2s ease, box-shadow 0.2s ease;
        }
        .sidebar a:hover {
            background: linear-gradient(135deg, rgba(126, 208, 246, 0.18) 0%, rgba(255, 255, 255, 0.08) 100%) !important;
            border-color: rgba(126, 208, 246, 0.38);
            transform: translateX(4px);
            box-shadow: 0 10px 20px rgba(2, 20, 31, 0.16);
        }
        .sidebar .close-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 24px;
            color: #fff !important;
            cursor: pointer;
        }
        .navbar {
            background: #ffffff;
            box-shadow: 0 6px 20px rgba(15, 23, 42, 0.08);
        }
        @media (min-width: 992px) {
            .sidebar {
                left: 0;
                padding-top: 56px;
            }
            .sidebar .close-btn { display: none; }
            #main-content { margin-left: 250px; }
            .navbar-toggler { display: none; }
          

        }
	        @media (min-width: 1200px) {
	    .container, .container-lg, .container-md, .container-sm, .container-xl {
	        max-width: 1106px;
	    }
	    
	}
  .navbar-toggler-icon {
    background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='black' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
}
 a {
        text-decoration: none !important;
        color: inherit !important;  /* use parent color */
    }

    a:hover {
        text-decoration: none !important;
        color: inherit !important;
    }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark  fixed-top">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" onclick="openSidebar()">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand ms-2"  href="#"></a>
       
    </div>
</nav>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <span class="close-btn" onclick="closeSidebar()">&times;</span>
    <a href="{{ url('/dashboard') }}">Dashboard</a>
     <a href="{{ url('/admin/courses') }}">Course List</a>
      <a href="{{ route('admin.purchased_list') }}">Purchased List</a>
   <a href="{{ url('/logout') }}">Logout</a>
   
   
</div>

<!-- Main Content -->
<div id="main-content" class="container mt-5 pt-4">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function openSidebar() {
        document.getElementById("sidebar").classList.add("active");
    }
    function closeSidebar() {
        document.getElementById("sidebar").classList.remove("active");
    }
    function toggleSubmenu() {
        var submenu = document.getElementById("masters-submenu");
        submenu.style.display = submenu.style.display === "none" ? "block" : "none";
    }
</script>
</body>
</html>
