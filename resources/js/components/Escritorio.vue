<template>
   <main class="main">
            <!-- Breadcrumb -->
          
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div id="cabezara">
                        <label id="titulo-escri">SISTEMA INFORMÁTICO DE LA PARROQUIA SAN LUIS GONZAGA (MSC)</label>
                    </div>
                    <div class="card-body">
                    <div class="input-group margen">
                            <div id="ima"> 
                                <img id="imagen" src="img/SanLuisMa.jpg">
                            </div>
                    </div>
                 <br>
                 <br>
                        <table id="table">
                            <thead>
                                <tr>
                                    <th id="textoAlin">OBJETIVO ARQUIDIOCESANO </th>
                                    <th id="textoAlin">OBJETIVO GENERAL PARROQUIAL</th>
                                    <th id="textoAlin">OBJETIVO ESPECÍFICO PARROQUIAL</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>   
                                    <td id="textoAlinJ">Hacer de la Iglesia Arquidiocesana una iglesia misionera en el espíritu de Aparecida, para que con el poder de Jesucristo sea fermento del reino en la transformación y salvación de la sociedad</td>
                                    <td id="textoAlinJ">Dentro del Plan Arquidiocesano, promover un espíritu de comunión y solidaridad que articule las fuerzas vivas de la Parroquia en torno a la Misión Evangelizadora para contribuir a la formación de personas y estructuras desde una fe más comprometida.</td>
                                    <td id="textoAlinJ">Fortalecer el encuentro con Jesús en todas las dimensiones de la vida, para que nos identifiquemos más con Él y fortalecer así la vida comunitaria, la misión, el compromiso con los pobres y la creación.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- tabla Listado -->
            </div>
        </main>
</template>
<style>
    .modal-content{
        width: 100% !important;
        position: absolute !important
    }
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }
    .margen{
        margin-bottom: 10px;
    }
    .div-error{
        clear:both;
        justify-content:center;
    }
    .text-error{
        color: red !important;
        font-weight:bold;
    }
    #imagen{
        width: 800px; 
        height: 600px;
        }
    #titulo-escri {
      font-size:  xx-large;
      font-weight: bold;
      text-align: center;
    }
    #ima{
         margin-left: auto;
         margin-right: auto;
    }
    #textoAlin{
        text-align: center;
    }
    #table {
            display: table;
            width: 100%;
            max-width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
            border-collapse: collapse;
        }
    #textoAlinJ{
        text-align: justify;
        border: 1px solid #c2cfd6;
        padding: 10px;
    }
    #cabezara{
        background-color: #f0f3f5;
        border-bottom: 1px solid #c2cfd6; 
        text-align: center;
    }
</style>