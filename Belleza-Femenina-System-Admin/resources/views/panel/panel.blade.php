<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Panel</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
  <link rel="stylesheet" href="{{ asset('css/panel.css') }}">
  @stack('styles')
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

  <nav class="siteNavbar">
    <button class="toggleSiderbar">
      <span class="material-symbols-rounded">Menu</span>
    </button>
  </nav>
  
  <div class="containerMain">

    <aside class="mainSidebar">
      <div class="mainSidebarHeader">
        <img src="logo.png" alt="Mujeres Lucete" class="logoHeader" />
        <button class="toggleSiderbar">
          <span class="material-symbols-rounded">chevron_left</span>
        </button>
      </div>
      
      <div class="sidebarcontentMain">
        <ul class="listMenu">
          <li class="itemMenu">
            <a href="#" class="linkMenu" id="productosDropdown">
              <span class="material-symbols-rounded menuIcon">inventory_2</span>
              <span class="labelMenu">Productos</span>
              <span class="material-symbols-rounded dropdownIcon" style="margin-left: auto;">chevron_right</span>
            </a>

            <ul class="menuDropdown" id="productosMenu">
              <li>
                <a href="{{ url ('/categorias') }}" class="linkDropdown">
                  <span class="material-symbols-rounded menuIcon">category</span>
                  <span class="labelMenu">Categoría Productos</span>
                </a>
              </li>

              <li>
                <a href="{{ url ('/productos') }}" class="linkDropdown">
                  <span class="material-symbols-rounded menuIcon">category</span>
                  <span class="labelMenu">Productos</span>
                </a>
              </li>

              <li>
                <a href="{{ url ('/tallas') }}" class="linkDropdown">
                  <span class="material-symbols-rounded menuIcon">category</span>
                  <span class="labelMenu">Tallas</span>
                </a>
              </li>

              <li>
                <a href="{{ url ('/variantes-productos') }}" class="linkDropdown">
                  <span class="material-symbols-rounded menuIcon">category</span>
                  <span class="labelMenu">Variantes Productos</span>
                </a>
              </li>

            </ul>
          </li>
          
          <li class="itemMenu">
            <a href="#" class="linkMenu" id="empleadosDropdown">
              <span class="material-symbols-rounded menuIcon">badge</span>
              <span class="labelMenu">Empleados</span>
              <span class="material-symbols-rounded dropdownIcon" style="margin-left: auto;">chevron_right</span>
            </a>

            <ul class="menuDropdown" id="empleadosMenu">
              <li>
                <a href="{{url('permisos')}}" class="linkDropdown">
                  <span class="material-symbols-rounded menuIcon">lock</span>
                  <span class="labelMenu">Permisos</span>
                </a>
              </li>

              <li>
                <a href="{{url('empleados')}}" class="linkDropdown">
                  <span class="material-symbols-rounded menuIcon">groups</span>
                  <span class="labelMenu">Empleados</span>
                </a>
              </li>

            </ul>
          </li>
          
          <li class="itemMenu">
            <a href="#" class="linkMenu">
              <span class="material-symbols-rounded menuIcon">inventory</span>
              <span class="labelMenu">Inventario</span>
            </a>
          </li>
          
          <li class="itemMenu">
            <a href="{{ url ('/gastos-operativos') }}" class="linkMenu">
              <span class="material-symbols-rounded menuIcon">receipt</span>
              <span class="labelMenu">Gastos operativos</span>
            </a>
          </li>
          
          <li class="itemMenu">
            <a href="{{url ('compras')}}" class="linkMenu">
              <span class="material-symbols-rounded menuIcon">shopping_cart</span>
              <span class="labelMenu">Compras</span>
            </a>
          </li>
          
         <li class="itemMenu">
            <a href="{{ route('ventas.index') }}" class="linkMenu">
              <span class="material-symbols-rounded menuIcon">point_of_sale</span>
              <span class="labelMenu">Ventas</span>
            </a>
          </li>

          
          <li class="itemMenu">
            <a href="#" class="linkMenu">
              <span class="material-symbols-rounded menuIcon">list_alt</span>
              <span class="labelMenu">Pedidos</span>
            </a>
          </li>
          
          <li class="itemMenu">
            <a href="#" class="linkMenu">
              <span class="material-symbols-rounded menuIcon">people</span>
              <span class="labelMenu">Clientes</span>
            </a>
          </li>

        </ul>
      </div>
      
      <div class="mainSidebarFooter">
        <button class="btnLogout">
          <span class="material-symbols-rounded menuIcon">logout</span>
          <span class="labelMenu">Logout</span>
        </button>
      </div>

    </aside>
    
    <div class="mainContent">
      @yield('content')
    </div>

  </div>
  <script src="{{ asset('js/panel.js') }}"></script>
</body>
</html>