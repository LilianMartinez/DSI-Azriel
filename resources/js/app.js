/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

//import swal from 'sweetalert2';
//window.swal = swal;



require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('calendario', require('./components/CalendarComponent.vue').default);
Vue.component('efectivo', require('./components/Efectivo.vue').default);
Vue.component('user', require('./components/User.vue').default);
Vue.component('historialefectivo', require('./components/HistorialEfectivo.vue').default);
Vue.component('montofijom', require('./components/MantenimientoMontoFijo.vue').default);
Vue.component('matrimonio1', require('./components/Matrimonio1.vue').default);
Vue.component('registroprimeracomunion', require('./components/RegistroPrimeraComunion.vue').default);
Vue.component('registroconfirmacion', require('./components/RegistroConfirmas.vue').default);
Vue.component('historialprimeracomunion', require('./components/HistorialPrimeraComunion.vue').default);
Vue.component('historialconfirmas', require('./components/HistorialConfirmas.vue').default);
Vue.component('historialsupletorias', require('./components/HistorialSupletorias.vue').default);
Vue.component('resumeneconomico', require('./components/ResumenEconomico.vue').default);
Vue.component('bautizo', require('./components/Bautizo.vue').default);
Vue.component('registrobautizo', require('./components/RegistroBautizo.vue').default);
Vue.component('categoriaresumen', require('./components/MantenimientoCategoriaResumen.vue').default);
Vue.component('religiosos', require('./components/MantenimientoReligiosos.vue').default);
Vue.component('iglesias', require('./components/MantenimientoIglesia.vue').default);
Vue.component('productos', require('./components/Producto.vue').default);
Vue.component('compras', require('./components/Compras.vue').default);
Vue.component('ventas', require('./components/Ventas.vue').default);
Vue.component('canasta', require('./components/Canasta.vue').default);
Vue.component('suelto', require('./components/Suelto.vue').default);
Vue.component('unidadmedida', require('./components/MantenimientoUnidadMedidas.vue').default);
Vue.component('zonas', require('./components/MantenimientoZona.vue').default);
Vue.component('feligreses', require('./components/RegistrarFeligres.vue').default);
Vue.component('inventarioiglesia', require('./components/RegistrarInventarioIglesia.vue').default);
Vue.component('controlsectorialfeligreses', require('./components/ControlSectorialFeligreses.vue').default);
Vue.component('controlsectorialinventarios', require('./components/ControlSectorialInventarios.vue').default);
Vue.component('escritorio', require('./components/Escritorio.vue').default);
Vue.component('categoriainventario', require('./components/MantenimientoCategoriaInventario.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data:{
        menu: 0
    }
});
