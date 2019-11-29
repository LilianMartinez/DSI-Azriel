<div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li @click="menu=0" class="nav-item">
                        <a class="nav-link active" href="#"><i class="icon-speedometer"></i> Escritorio</a>
                    </li>
            
                  <!--
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-bag"></i> Calendario Parroquial</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=1" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-bag"></i> Eventos</a>
                            </li>
                            <li @click="menu=2" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-bag"></i> Calendario de Avisos</a>
                            </li>
                        </ul>
                    </li>-->
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-bag"></i>Sacramentos</a>
                        <ul class="nav-dropdown-items">
                        <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-bag"></i>Bautizo</a>
                            <ul class="nav-dropdown-items">
                            <li @click="menu=3" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-bag"></i> Bautizo</a>
                            </li>
                            <li @click="menu=18" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-bag"></i> Registro Bautizo</a>
                            </li>
                            </ul>
                        </li>
                            <li class="nav-item nav-dropdown">
                            <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-bag"></i>Primera Comunion</a>
                            <ul class="nav-dropdown-items">
                            <li @click="menu=4" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-bag"></i>Hacer registro</a>
                            </li>
                            <li @click="menu=5" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-bag"></i>Historial</a>
                            </li>
                            </ul>
                            </li>
                            <li @click="menu=20" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-bag"></i> Confirma</a>
                            </li>
                            <li @click="menu=6" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-bag"></i> Matrimonio</a>
                            </li>
                            <li @click="menu=21" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-bag"></i> Supletorias</a>
                            </li>
                        </ul>
                    </li>
                  
        
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-wallet"></i> Caja chica</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=16" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-wallet"></i>Caja chica diaria</a>
                            </li>
                            <li @click="menu=7" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-wallet"></i> Historial de registros</a>
                            </li>
                            <li @click="menu=8" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-notebook"></i>Resumen Económico</a>
                            </li>
                        </ul>
                    </li>
                   <!--  <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-basket"></i> Donaciones</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=9" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-notebook"></i> Listado donaciones</a>
                            </li>
                        </ul>
                    </li>-->
                  
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
                   <!-- <li @click="menu=14" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-book-open"></i> Ayuda <span class="badge badge-danger">PDF</span></a>
                    </li>
                    <li @click="menu=15" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-info"></i> Acerca de...<span class="badge badge-info">IT</span></a>
                    </li>-->
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
                        </ul>
                    </li>
                </ul>
            </nav>
            <button class="sidebar-minimizer brand-minimizer" type="button"></button>
        </div>
