@extends("principal")
@section("contenido")
    
      @if (Auth::check())
            @if(Auth::user()->idrol==1)
                        <template v-if="menu==0">
                          <escritorio></escritorio>
                        </template>

                        <template v-if="menu==7">
                            <historialefectivo></historialefectivo>
                        </template>
                        
                        <template v-if="menu==8">
                            <resumeneconomico></resumeneconomico>
                        </template>
                        
                        <template v-if="menu==2">
                            <calendario></calendario>
                        </template>

                        <template v-if="menu==10">
                                <user></user> 
                        </template>

                        <template v-if="menu==12">
                        <controlsectorialfeligreses></controlsectorialfeligreses>
                        </template>
                            
                        <template v-if="menu==13">
                           <controlsectorialinventarios></controlsectorialinventarios>
                        </template>

                        <template v-if="menu==3">
                            <bautizo></bautizo>
                        </template>

                        <template v-if="menu==5">
                        <historialprimeracomunion></historialprimeracomunion>
                        </template>

                        <template v-if="menu==20">
                        <historialconfirmas></historialconfirmas>
                        </template>

                        <template v-if="menu==6">
                            <matrimonio1></matrimonio1>
                        </template>

                        <template v-if="menu==34">
                            <ventas></ventas>
                        </template>

            @elseif(Auth::user()->idrol==2)
                        <template v-if="menu==0">
                            <escritorio></escritorio>
                        </template>
                        
                        <template v-if="menu==1">
                            <h1>Posiblemente quitemos esta onda</h1>
                        </template>
                    
                        <template v-if="menu==2">
                            <calendario></calendario>
                        </template>
                        
                        <template v-if="menu==3">
                            <bautizo></bautizo>
                        </template>

                        <template v-if="menu==18">
                            <registrobautizo></registrobautizo>
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
                        <controlsectorialfeligreses></controlsectorialfeligreses>
                        </template>
                            
                        <template v-if="menu==13">
                           <controlsectorialinventarios></controlsectorialinventarios>
                        </template>
                        <!--<template v-if="menu==25">
                            <inventarioiglesia></inventarioiglesia>
                        </template>-->                                          

                        <template v-if="menu==20">
                        <historialconfirmas></historialconfirmas>
                        </template>
                        <template v-if="menu==21">
                        <historialsupletorias></historialsupletorias>
                        </template>
                        
                        <template v-if="menu==10">
                        <registroconfirmacion></registroconfirmacion>
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
                        <template v-if="menu==23">
                        <categoriaresumen></categoriaresumen>
                        </template>
                        <template v-if="menu==19">
                        <religiosos></religiosos>
                        </template>
                        <template v-if="menu==22">
                        <iglesias></iglesias>
                        </template>
                        <template v-if="menu==24">
                            <zonas></zonas>
                        </template>
                        <template v-if="menu==26">
                         <categoriainventario></categoriainventario>
                        </template>
                        <template v-if="menu==30">
                        <productos></productos>
                        </template>
                        <template v-if="menu==31">
                        <compras></compras>
                        </template>
                        <template v-if="menu==32">
                        <suelto></suelto>
                        </template>
                        <template v-if="menu==33">
                        <canasta></canasta>
                        </template>
                        <template v-if="menu==34">
                        <ventas></ventas>
                        </template>
                        <template v-if="menu==35">
                        <unidadmedida></unidadmedida>
                        </template>
                        
            @else
            @endif
      @endif

   
    @endsection