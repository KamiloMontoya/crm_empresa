<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="/dashboard">
                    <i class="nav-icon icon-speedometer"></i> Dashboard
                </a>
            </li>


            <li class="nav-item">
                <a class="nav-link" href="/contacts">
                    <i class="nav-icon fa fa-users"></i> Contactos
                </a>
            </li>


            <li class="nav-item">
                <a class="nav-link" href="/contact_has_services">
                    <i class="nav-icon fa fa-list"></i> Serv. Contratados
                </a>
            </li>

           
            @can('read-users','read-roles', 'read-services')
            <li class="nav-title">Configuración</li>
            @endcan

            @can('read-services')
            <li class="nav-item">
                <a class="nav-link" href="/services">
                    <i class="nav-icon fa fa-book"></i> Admin. Servicios
                </a>
            </li>
            @endcan


            @can('read-users')
            <li class="nav-item">
                <a class="nav-link" href="/users">
                    <i class="nav-icon icon-people"></i> Usuarios
                </a>
            </li>
            @endcan
            @can('read-roles')
            <li class="nav-item">
                <a class="nav-link" href="/roles">
                    <i class="nav-icon icon-key"></i> Roles
                </a>
            </li>
            @endcan

            
        </ul>
    </nav>
    <sidebar></sidebar>
</div>
