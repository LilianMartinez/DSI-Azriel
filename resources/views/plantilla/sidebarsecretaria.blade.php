<div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li @click="menu=0" class="nav-item">
                        <a class="nav-link active" href="#"><i class="icon-speedometer"></i> Escritorio</a>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-wallet"></i> Caja chica</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=16" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-wallet"></i>Caja chica diaria</a>
                            </li>
                            <li @click="menu=7" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-wallet"></i>Historial de registros</a>
                            </li>
                            <li @click="menu=8" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-notebook"></i>Resumen Economico</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-bag"></i>Sacramentos</a>
                        <ul class="nav-dropdown-items">
                        <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-bag"></i>Bautizo</a>
                            <ul class="nav-dropdown-items">
                            <li @click="menu=3" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-bag"></i>Historial</a>
                            </li>
                            <li @click="menu=18" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-bag"></i>Registro</a>
                            </li>
                            </ul>
                        </li>
                            <li class="nav-item nav-dropdown">
                            <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-bag"></i>Primera Comunion</a>
                            <ul class="nav-dropdown-items">
                            <li @click="menu=4" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-bag"></i>Registro</a>
                            </li>
                            <li @click="menu=5" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-bag"></i>Historial</a>
                            </li>
                            </ul>
                            </li>
                            <li class="nav-item nav-dropdown">
                            <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-bag"></i>Confirma</a>
                            <ul class="nav-dropdown-items">
                            <li @click="menu=10" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-bag"></i>Registro</a>
                            </li>
                            <li @click="menu=20" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-bag"></i>Historial</a>
                            </li>
                            </ul>
                            </li>
                            <li @click="menu=6" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-bag"></i>Matrimonio</a>
                            </li>
                        </ul>
                    </li>
        
                    <li @click="menu=2" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-bag"></i>Calendario de Eventos</a>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-pie-chart"></i> Control Sectorial</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=12" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-chart"></i>Comunidad Parroquial</a>
                            </li>
                            <li @click="menu=13" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-chart"></i>Inventarios de Iglesias</a>
                            </li>
                            
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-pie-chart"></i>Donaciones</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=30" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-chart"></i>Productos</a>
                            </li>
                            <li @click="menu=31" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-chart"></i>Compras</a>
                            </li>
                            <li @click="menu=33" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-chart"></i>Canastas</a>
                            </li>
                            <li @click="menu=32" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-chart"></i>Productos individuales</a>
                            </li>
                            <li @click="menu=34" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-chart"></i>Informe</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-pie-chart"></i> Mantenimientos</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=17" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-chart"></i> Precios fijos</a>
                            </li>
                            <li @click="menu=23" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-wallet"></i>Categorias para resumenes</a>
                            </li>
                            <li @click="menu=19" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-wallet"></i>Personal Religioso</a>
                            </li>
                            <li @click="menu=22" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-wallet"></i>Iglesias</a>
                            </li>
                            <li @click="menu=24" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-wallet"></i>Zonas</a>
                            </li>
                            <li @click="menu=26" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-wallet"></i>Categorias para inventario</a>
                            </li>
                            <li @click="menu=35" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-wallet"></i>Unidad medida</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <button class="sidebar-minimizer brand-minimizer" type="button"></button>
        </div>
