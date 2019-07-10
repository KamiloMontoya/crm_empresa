<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">

            <li class="nav-item">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="nav-icon icon-speedometer"></i> Dashboard
                </a>
            </li>

            @can('read-contacts')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('contacts.index') }}">
                    <i class="nav-icon fa fa-users"></i> Clientes
                </a>
            </li>
            @endcan

            @can('read-contact_has_service')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('contact_has_services.index') }}">
                    <i class="nav-icon fa fa-list"></i> Serv. Contratados
                </a>
            </li>
            @endcan

            @can('read-installation_order')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('installation_orders.index') }}">
                    <i class="nav-icon fa fa-briefcase"></i> Ordenes Instalación
                </a>
            </li>
            @endcan
           
            @can('read-users','read-roles','read-services', 'read-installation_order_status', 'read-discounts')
            <li class="nav-title">Configuración</li>
            @endcan

            @can('read-services')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('services.index') }}">
                    <i class="nav-icon fa fa-book"></i> Admin. Servicios
                </a>
            </li>
            @endcan


            @can('read-installation_order_status')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('installation_orders_statuses.index') }}">
                    <i class="nav-icon fa fa-briefcase"></i> Estados Instalación
                </a>
            </li>
            @endcan

            @can('read-promotions')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('promotions.index') }}">
                    <i class="nav-icon fa fa fa-sort-amount-down"></i> Promociones
                </a>
            </li>
            @endcan
            

            @can('read-users')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('users.index') }}">
                    <i class="nav-icon icon-people"></i> Usuarios
                </a>
            </li>
            @endcan
            @can('read-roles')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('roles.index') }}">
                    <i class="nav-icon icon-key"></i> Roles
                </a>
            </li>
            @endcan

            
        </ul>
    </nav>
    <sidebar></sidebar>
</div>
