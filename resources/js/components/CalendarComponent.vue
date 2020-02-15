<template>
    
    <main class="main">

<!-- PLUGIN DE CITAS DE FACEBOOK -->
      <!-- <meta property="og:url"           content="https://www.google.com" />
      <meta property="og:type"          content="AZRIEL prueba" />
      <meta property="og:title"         content="Azrielito" />
      <meta property="og:description"   content="Descripcion de la publicazion" />
      <meta property="og:image"         content="http://www.your-domain.com/path/image.jpg" /> -->


            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <label class="titulo-encabezados">Calendario de Eventos</label>
                    </div>
                    <div class="card-body">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="input-group margen">
                            <button type="button" @click="abrirModal()" class="btn btn-primary">
                                    <i class="icon-plus"></i>&nbsp;Nuevo Evento
                            </button>
                        </div>
        
      </div>
      <div class="col-md-8">
        <Fullcalendar @eventClick="showEvent" locale="es" :plugins="calendarPlugins" :events="events" :buttonText="{ today: 'Hoy'}" />
      </div>
    </div>
  </div>

                    </div>
                </div>
                
            </div>

            <!-- INICIO DEL MODAL NUEVO EVENTO -->
      <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <!--el v-text="tituloModal" muestra el titulo segun el metodo mostrarModal -->
                            <h4 class="modal-title" v-text="tituloModal"></h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">

        <form @submit.prevent>
          <div class="form-group">
            <label for="event_name">Nombre</label>
            <input type="text" id="event_name" class="form-control" v-model="newEvent.event_name">
          </div>
          <div class="form-group">
            <label for="event_description">Descripción</label>
            <div class="fb-quotable"> <!-- plugin de facebook de lo que esta dentro del modal -->
            <textarea id="event_description" rows="5" class="form-control" v-model="newEvent.event_description"></textarea>
            <div class="fb-quote"></div>
            </div>
            <!-- <input type="text" id="event_description" class="form-control" v-model="newEvent.event_description">
             -->
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="start_date">Fecha de Inicio</label>
                <input
                  type="date"
                  id="start_date"
                  class="form-control"
                  v-model="newEvent.start_date"
                >
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="end_date">Fecha de finalización</label>
                <input type="date" id="end_date" class="form-control" v-model="newEvent.end_date">
              </div>
            </div>
                                
            <div class="col-md-6 mb-4" v-if="addingMode">
              <button class="btn btn-sm btn-primary" @click="addNewEvent">Guardar Evento</button>
              <button class="btn btn-sm btn-secondary" @click="cerrarModal()">Cancelar</button>
            </div>
            <template v-else>
              <div class="col-md-6 mb-4">
                <button class="btn btn-sm btn-success" @click="updateEvent">Actualizar</button>
                <button class="btn btn-sm btn-danger" @click="deleteEvent">Borrar</button>
                <button class="btn btn-sm btn-secondary" @click="cerrarModal()">Cancelar</button>
              </div>
            </template>
          </div>

          <div v-show="errorModal" class="form-group row div-error">
                <div class="text-center text-error">
                    <div v-for="error in errorMostrarMsjModal" :key="error" v-text="error">
                    </div>
                </div>
            </div>
            
        </form>

        </div>
              </div>
          <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
      </div>
      <!-- FIN DEL MODAL NUEVO EVENTO -->
    </main>
</template>

<script>
import Fullcalendar from "@fullcalendar/vue";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";
import axios from "axios";

export default {
  components: {
    Fullcalendar
  },

  data() {
    return {
      calendarPlugins: [dayGridPlugin, interactionPlugin],
      events: "",
      newEvent: {
        event_name: "",
        event_description: "",
        start_date: "",
        end_date: ""
      },
      modal:0,
      tituloModal: '',
      addingMode: true,
      indexToUpdate: "",
      errorModal: 0,
      errorMostrarMsjModal: []
     /*  d:document,
      s:"script",
      id:"facebook-jssdk" */
    };
  },

  created() {
    this.getEvents();
  },
  methods: {
   
  //PLUGIN DE FACEBOOK
  /* function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6";
    fjs.parentNode.insertBefore(js, fjs);
  }, */

  /* new: Vue({
    el: '#event_description',
  created: function() {
    console.log('created main');
    window.fbAsyncInit = function() {
      FB.init({
        appId      : '1111111111',
        xfbml      : true,
        version    : 'v2.7'
      });

      //This function should be here, inside window.fbAsyncInit
      FB.getLoginStatus(function(response) {
        console.log(response);
     });

   };

    (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
  }
  }), */

    abrirModal(){
      this.modal=1;
      this.tituloModal='Registro de evento';
    },
    abrirModal2(){
      this.modal=1;
      this.tituloModal='Modificar Evento';
    },
    cerrarModal(){
      this.modal=0;
      this.tituloModal='';
      this.addingMode=true;
      this.newEvent.event_name="";
      this.newEvent.event_description="";
      this.newEvent.start_date="";
      this.newEvent.end_date="";
      this.errorModal=0;
      this.errorMostrarMsjModal=[];

    },

    validarDatos(){
            this.errorModal=0;
            this.errorMostrarMsjModal=[];

            var valFecha = new Date();
            var actualYear = valFecha.getFullYear();
            var actualMes = valFecha.getMonth();
            var actualDay = valFecha.getDate();
            var values1 = this.newEvent.start_date.split("-");
            var values2 = this.newEvent.end_date.split("-");
            var anio1 = values1[0];
            var mes1 = values1[1];
            var dia1 = values1[2];
            var anio2 = values2[0];
            var mes2 = values2[1];
            var dia2 = values2[2];

            if(this.newEvent.event_name=="") this.errorMostrarMsjModal.push("Por favor ingrese el nombre del evento");

            if(!this.newEvent.start_date){
                this.errorMostrarMsjModal.push("Seleccione la fecha de inicio del evento");
            }else{

              if(anio1 < actualYear){
                this.errorMostrarMsjModal.push("Año malo - No se puede iniciar un evento de días anteriores");
              }else{
                if(mes1 < actualMes+1 && anio1 == actualYear){
                  this.errorMostrarMsjModal.push("Mes malo - No se puede iniciar un evento de días anteriores");
                }else{
                  if(dia1 < actualDay+1 && mes1 == actualMes+1 && anio1 == actualYear){
                    this.errorMostrarMsjModal.push("Día malo - No se puede iniciar un evento de días anteriores");
                  }
                }
              }
                if((actualYear+1)<anio1)this.errorMostrarMsjModal.push("La fecha inicial del evento debe ser anterior al año " + (actualYear+1));
            }
            
            if(!this.newEvent.end_date){
              this.errorMostrarMsjModal.push("Seleccione la fecha de finalización del evento");
            }else{
              if(anio2 < anio1){
                this.errorMostrarMsjModal.push("Año malo - La fecha de finalización del evento debe ser posterior a la fecha de inicio del evento");
              }else{
                if(mes2 < mes1 && anio2 == anio1){
                  this.errorMostrarMsjModal.push("Mes malo - La fecha de finalización del evento debe ser posterior a la fecha de inicio del evento");
                }else{
                  if(dia2 < dia1 && mes2 == mes1 && anio2 == anio1){
                    this.errorMostrarMsjModal.push("Día malo - La fecha de finalización del evento debe ser posterior a la fecha de inicio del evento");
                  }
                }
              }
              if((actualYear+1)<anio1)this.errorMostrarMsjModal.push("La fecha inicial del evento debe ser anterior al año " + (actualYear+1));
            }
            
            if (this.errorMostrarMsjModal.length) this.errorModal = 1;

            return this.errorModal;
        },

    msjExito(){
        swal({
            type: 'success',
            title: 'Evento guardado con éxito',
            showConfirmButton: false,
            timer: 1500
        })
    },

    msjExito2(){
        swal({
            type: 'success',
            title: 'Evento actualizado con éxito',
            showConfirmButton: false,
            timer: 1500
        })
    },
        
    addNewEvent() {
      if(this.validarDatos()){
        return;
      }

      axios
        .post("/api/calendar", {
          ...this.newEvent
        })
        .then(data => {
          this.getEvents(); // update our list of events
          this.resetForm(); // clear newEvent properties (e.g. title, start_date and end_date)
          this.cerrarModal();
          this.msjExito();
        })
        .catch(err =>
          console.log("Unable to add new event!", err.response.data)
        );
    },
    showEvent(arg) {
      this.addingMode = false;
      const { id, title, descrip, start, end } = this.events.find(
        event => event.id === +arg.event.id
      );
      this.indexToUpdate = id;
      this.newEvent = {
        event_name: title,
        event_description: descrip,
        start_date: start,
        end_date: end
      };
      this.abrirModal2();
    },
    updateEvent() {
      if(this.validarDatos()){
        return;
      }

      axios
        .put("/api/calendar/" + this.indexToUpdate, {
          ...this.newEvent
        })
        .then(resp => {
          this.resetForm();
          this.getEvents();
          this.addingMode = !this.addingMode;
          this.cerrarModal();
          this.msjExito2();
        })
        .catch(err =>
          console.log("Unable to update event!", err.response.data)
        );
    },
    deleteEvent() {
      swal({
        title: '¿Esta seguro de eliminar este evento?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar!',
        cancelButtonText: 'Cancelar',
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: false,
        reverseButtons: true
        }).then((result) => {
        if (result.value) {
            let me = this;

      axios
        .delete("/api/calendar/" + this.indexToUpdate)
        .then(resp => {
          this.resetForm();
          this.getEvents();
          this.addingMode = !this.addingMode;
          this.cerrarModal();
          swal(
                'Eliminado!',
                'El evento ha sido eliminado con éxito.',
                'success'
                )
        })
        .catch(err =>
          console.log("Unable to delete event!", err.response.data)
        );

        } else if (
                // Read more about handling dismissals
                result.dismiss === swal.DismissReason.cancel
            ) {
                
            }
            })
    },
    getEvents() {
      axios
        .get("/api/calendar")
        .then(resp => (this.events = resp.data.data))
        .catch(err => console.log(err.response.data));
    },
    resetForm() {
      Object.keys(this.newEvent).forEach(key => {
        return (this.newEvent[key] = "");
      });
    }
  },
  watch: {
    indexToUpdate() {
      return this.indexToUpdate;
    }
  }
};
</script>

<style lang="css">
@import "~@fullcalendar/core/main.css";
@import "~@fullcalendar/daygrid/main.css";

.fc-title {
  color: #fff;
}

.fc-title:hover {
  cursor: pointer;
}
</style>

