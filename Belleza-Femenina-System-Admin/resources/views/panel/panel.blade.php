<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Panel</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
  <link rel="stylesheet" href="{{ asset('css/panel.css') }}">
</head>
<body>
  <!-- Navbar -->
  <nav class="siteNav">
    <button class="sidebarToggle">
      <span class="material-symbols-rounded">Menu</span>
    </button>
  </nav>
  
  <div class="container">
    <!-- Sidebar -->
    <aside class="sidebar">
      <!-- Sidebar header -->
      <div class="sidebarHeader">
        <img src="logo.png" alt="Mujeres Lucete" class="headerLogo" />
        <button class="sidebarToggle">
          <span class="material-symbols-rounded">chevron_left</span>
        </button>
      </div>
      
      <div class="sidebarContent">
        <!-- Sidebar Menu -->
        <ul class="menuList">
          <!-- Productos Dropdown -->
          <li class="menuItem">
            <a href="#" class="menuLink" id="productosDropdown">
              <span class="material-symbols-rounded menuIcon">inventory_2</span>
              <span class="menuLabel">Productos</span>
              <span class="material-symbols-rounded dropdownIcon" style="margin-left: auto;">chevron_right</span>
            </a>
            <ul class="dropdownMenu" id="productosMenu">
              <li>
                <a href="{{ url('/categorias') }}" class="dropdownLink">
                  <span class="material-symbols-rounded menuIcon">category</span>
                  <span class="menuLabel">Categoría Productos</span>
                </a>
              </li>
              <li>
                <a href="{{ url('/productos') }}" class="dropdownLink">
                  <span class="material-symbols-rounded menuIcon">category</span>
                  <span class="menuLabel">Productos</span>
                </a>
              </li>
              <li>
                <a href="{{ url('/tallas') }}" class="dropdownLink">
                  <span class="material-symbols-rounded menuIcon">category</span>
                  <span class="menuLabel">tallas</span>
                </a>
              </li><li>
                <a href="{{ url('/variantes-productos') }}" class="dropdownLink">
                  <span class="material-symbols-rounded menuIcon">category</span>
                  <span class="menuLabel">Variantes productos</span>
                </a>
              </li>
            </ul>
          </li>
          
          <!-- Empleados Dropdown -->
          <li class="menuItem">
            <a href="#" class="menuLink" id="empleadosDropdown">
              <span class="material-symbols-rounded menuIcon">badge</span>
              <span class="menuLabel">Empleados</span>
              <span class="material-symbols-rounded dropdownIcon" style="margin-left: auto;">chevron_right</span>
            </a>
            <ul class="dropdownMenu" id="empleadosMenu">
              <li>
                <a href="#" class="dropdownLink">
                  <span class="material-symbols-rounded menuIcon">lock</span>
                  <span class="menuLabel">Permisos</span>
                </a>
              </li>
              <li>
                <a href="#" class="dropdownLink">
                  <span class="material-symbols-rounded menuIcon">groups</span>
                  <span class="menuLabel">Empleados</span>
                </a>
              </li>
            </ul>
          </li>
          
          <!-- Otros elementos del menú -->
          <li class="menuItem">
            <a href="#" class="menuLink">
              <span class="material-symbols-rounded menuIcon">inventory</span>
              <span class="menuLabel">Inventario</span>
            </a>
          </li>
          
          <li class="menuItem">
            <a href="#" class="menuLink">
              <span class="material-symbols-rounded menuIcon">receipt</span>
              <span class="menuLabel">Gastos operativos</span>
            </a>
          </li>
          
          <li class="menuItem">
            <a href="#" class="menuLink">
              <span class="material-symbols-rounded menuIcon">shopping_cart</span>
              <span class="menuLabel">Compras</span>
            </a>
          </li>
          
          <li class="menuItem">
            <a href="#" class="menuLink">
              <span class="material-symbols-rounded menuIcon">point_of_sale</span>
              <span class="menuLabel">Ventas</span>
            </a>
          </li>
          
          <li class="menuItem">
            <a href="#" class="menuLink">
              <span class="material-symbols-rounded menuIcon">list_alt</span>
              <span class="menuLabel">Pedidos</span>
            </a>
          </li>
          
          <li class="menuItem">
            <a href="#" class="menuLink">
              <span class="material-symbols-rounded menuIcon">people</span>
              <span class="menuLabel">Clientes</span>
            </a>
          </li>
        </ul>
      </div>
      
      <!-- Sidebar Footer -->
      <div class="sidebarFooter">
        <button class="logoutBtn">
          <span class="material-symbols-rounded menuIcon">logout</span>
          <span class="menuLabel">Logout</span>
        </button>
      </div>
    </aside>
    
     <!-- Main Content -->
    <div class="mainContent">
      @yield('content')
    </div>
  </div>
  
  <script src="{{ asset('js/panel.js') }}"></script>
</body>
</html>