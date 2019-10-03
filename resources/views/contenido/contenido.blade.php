@extends("principal")
@section("contenido")
    
      @if (Auth::check())
            @if(Auth::user()->idrol==1)
                        <template v-if="menu==0">
                            <h1>Escritorio</h1>
                        </template>

                        <template v-if="menu==3">
                            <h1>Bautizo</h1>
                        </template>
                        
                        <template v-if="menu==4">
                            <h1>Primera Comunión</h1>
                        </template>
                        
                        <template v-if="menu==5">
                            <h1>Confirma</h1>
                        </template>
                        
                        <template v-if="menu==6">
                                <matrimonio1></matrimonio1>
                        </template>

                        <template v-if="menu==10">
                                <user></user> 
                        </template>

                        <template v-if="menu==14">
                            <h1>Ayuda</h1>
                        </template>
                        
                        <template v-if="menu==15">
                            <h1>Acerca de...</h1>
                        </template>

            @elseif(Auth::user()->idrol==2)
                        <template v-if="menu==0">
                            <h1>Escritorio</h1>
                        </template>
                        
                        <template v-if="menu==1">
                            <h1>Eventos</h1>
                        </template>
                    
                        <template v-if="menu==2">
                            <h1>Calendario de Avisos</h1>
                        </template>
                        
                        <template v-if="menu==3">
                            <h1>Bautizo</h1>
                        </template>
                        
                        <template v-if="menu==4">
                        <registroprimeracomunion></registroprimeracomunion>
                        </template>
                        
                        <template v-if="menu==5">
                        <historialprimeracomunion></historialprimeracomunion>
                        </template>
                        
                        <template v-if="menu==6">
                            <matrimonio1></matrimonio1>
                        </template>
                        
                        <template v-if="menu==7">
                            <historialefectivo></historialefectivo>
                        </template>
                        
                        <template v-if="menu==8">
                            <resumeneconomico></resumeneconomico>
                        </template>
                        
                        <template v-if="menu==9">
                            <h1>Listado donaciones</h1>
                        </template>
                            
                        <template v-if="menu==12">
                            <h1>Comunidad Parroquial</h1>
                        </template>
                        
                        <template v-if="menu==13">
                            <h1>Inventario de Iglesias</h1>
                        </template>
                        <template v-if="menu==20">
                        <historialconfirmas></historialconfirmas>
                        </template>
                        <template v-if="menu==21">
                        <historialsupletorias></historialsupletorias>
                        </template>
                        
                        <template v-if="menu==14">
                            <h1>Ayuda</h1>
                        </template>
                        
                        <template v-if="menu==15">
                            <h1>Acerca de...</h1>
                        </template>

                        <template v-if="menu==16">
                            <efectivo></efectivo>
                        </template>
                        <template v-if="menu==17">
                        <montofijom></montofijom>
                        </template>
                        <template v-if="menu==18">
                        <categoriaresumen></categoriaresumen>
                        </template>
                        <template v-if="menu==19">
                        <religiosos></religiosos>
                        </template>
                        <template v-if="menu==22">
                        <iglesias></iglesias>
                        </template>
            @else
            @endif
      @endif

   
    @endsection