<div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li @click="menu=0" class="nav-item ocultar2">
                        <a class="nav-link active" href="#"><i class="icon-doc"></i> Escritorio</a>
                    </li>
                    <li class="nav-title">
                        Menú
                    </li>
                    <li class="nav-item nav-dropdown ocultar2">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-bag"></i> Calendario Parroquial</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=1" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-bag"></i> Eventos</a>
                            </li>
                            <li @click="menu=2" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-bag"></i> Calendario de Avisos</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown ocultar2">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-bag"></i> Certificados</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=3" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-bag"></i> Bautizo</a>
                            </li>
                            <li @click="menu=4" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-bag"></i> Primera Comunión</a>
                            </li>
                            <li @click="menu=5" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-bag"></i> Confirma</a>
                            </li>
                            <li @click="menu=6" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-bag"></i> Matrimonio</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-options-vertical"></i> Caja Chica</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=16" class="nav-item">
                                <a class="nav-link" href="#">Caja chica diaria</a>
                            </li>
                            <li @click="menu=7" class="nav-item">
                                <a class="nav-link" href="#">Historial de registros</a>
                            </li>
                            <li @click="menu=8" class="nav-item ocultar2">
                                <a class="nav-link" href="#"> Informe</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown ocultar2">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-basket"></i> Donaciones</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=9" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-notebook"></i> Listado donaciones</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown ocultar2">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-people"></i> Acceso</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=10" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-user"></i> Usuarios</a>
                            </li>
                            <li @click="menu=11" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-user-following"></i> Credenciales</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown ocultar2">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-pie-chart"></i> Control Sectorial</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=12" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-chart"></i> Comunidad Parroquial</a>
                            </li>
                            <li @click="menu=13" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-chart"></i> Inventario de Iglesias</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-lock"></i> Mantenimiento</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=17" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-briefcase"></i> Precio Fijos</a>
                            </li>
                        </ul>
                    </li>
                    <li @click="menu=14" class="nav-item ocultar2">
                        <a class="nav-link" href="#"><i class="icon-book-open"></i> Ayuda <span class="badge badge-danger">PDF</span></a>
                    </li>
                    <li @click="menu=15" class="nav-item ocultar2">
                        <a class="nav-link" href="#"><i class="icon-info"></i> Acerca de...<span class="badge badge-info">IT</span></a>
                    </li>
                </ul>
            </nav>
            <button class="sidebar-minimizer brand-minimizer" type="button"></button>
        </div>
