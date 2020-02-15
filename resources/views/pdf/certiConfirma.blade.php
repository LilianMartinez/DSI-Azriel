<!DOCTYPE>
<html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Certificado de Confirm</title>
    <style>
        body {
        /*position: relative;*/
        /*width: 16cm;  */
        /*height: 29.7cm; */
        /*margin: 0 auto; */
        /*color: #555555;*/
        /*background: #FFFFFF; */
        font-family: Arial, sans-serif; 
        font-size: 15px;
        /*font-family: SourceSansPro;*/
        }

        #logo{
        float: left;
        margin-top: 1%;
        margin-left: 2%;
        margin-right: 2%;
        }
        #imagen{
        width: 100px; 
        height: 100px;
        }

        #datos{
        float: left;
        margin-top: -2%;
        margin-left: 8%;
        margin-right: -8%;
        /*text-align: justify;*/
        }

        #titulo1{
        font-family: Lucida; 
        font-size: 22px;
        text-align: center;
        line-height : 1.5px;
        /*margin-left: 2%;
        /*margin-right: 35%;*/

        }
        #encabezado{
        text-align: center;
        margin-left: 10%;
        margin-right: 35%;
        font-size: 15px;
        }

        #titulo2{
        font-family: Arial; 
        color:#FF0000;
        font-size: 14px;
        text-align: center;
        line-height: 1.5px;
        /*margin-left: 2%;
        margin-right: 35%;*/
        font-style: italic;
        }
        #titulo3{
        font-family: Arial, sans-serif; 
        font-size: 11px;
        text-align: center;
        margin-top: -10%;
        /*margin-left: 2%;
        margin-right: 35%;*/
        }
        #parrafoM{
        float: center;
        margin-top: 0%;
        margin-left: 10%;
        margin-right: 10%;
        }
        #TituloCert{
        font-family: Arial, sans-serif; 
        font-size: 27px;
        text-align: center;
        }
        #parrafo{
        font-family: Arial, sans-serif; 
        font-size: 18px;
        text-align: justify;
        }
        #parrafo2{
        font-family: Arial, sans-serif; 
        font-size: 18px;
        text-align: center;
        }
        #parrafo3{
        font-family: Arial, sans-serif; 
        font-size: 22px;
        text-align: justify;
        text-decoration: underline;
        }
        #fact{
        /*position: relative;*/
        float: right;
        margin-top: 2%;
        margin-left: 2%;
        margin-right: 2%;
        font-size: 20px;
        }

        section{
        clear: left;
        }

        #cliente{
        text-align: left;
        }

        #facliente{
        width: 40%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }

        #fac, #fv, #fa{
        color: #FFFFFF;
        font-size: 15px;
        }

        #facliente thead{
        padding: 20px;
        background: #2183E3;
        text-align: left;
        border-bottom: 1px solid #FFFFFF;  
        }

        #facvendedor{
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }

        #facvendedor thead{
        padding: 20px;
        background: #2183E3;
        text-align: center;
        border-bottom: 1px solid #FFFFFF;  
        }

        #facarticulo{
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }

        #facarticulo thead{
        padding: 20px;
        background: #2183E3;
        text-align: center;
        border-bottom: 1px solid #FFFFFF;  
        }
    </style>
    <body>
        <?php

            //FECHA ACTUAL
            $diaA=date("d");
            $anioA=date("Y");
            $mesA=date("m");
            $anioAL=valorEnLetras($anioA);

            switch($mesA){
                case 01: $mesA="enero";
                break;
                case 02: $mesA="febrero";
                break;
                case 03: $mesA="marzo";
                break;
                case 04: $mesA="abril";
                break;
                case 05: $mesA="mayo";
                break;
                case 06: $mesA="junio";
                break;
                case 07: $mesA="julio";
                break;
                case 8: $mesA="agosto";
                break;
                case 9: $mesA="septiembre";
                break;
                case 10: $mesA="octubre";
                break;
                case 11: $mesA="noviembre";
                break;
                case 12: $mesA="diciembre";
                break;
                }

                switch($diaA){
                    case 01: $diaA="uno";
                    break;
                    case 02: $diaA="dos";
                    break;
                    case 03: $diaA="tres";
                    break;
                    case 04: $diaA="cuatro";
                    break;
                    case 05: $diaA="cinco";
                    break;
                    case 06: $diaA="seis";
                    break;
                    case 07: $diaA="siete";
                    break;
                    case 8: $diaA="ocho";
                    break;
                    case 9: $diaA="nueve";
                    break;
                    case 10: $diaA="diez";
                    break;
                    case 11: $diaA="once";
                    break;
                    case 12: $diaA="doce";
                    break;
                    case 13: $diaA="trece";
                    break;
                    case 14: $diaA="catorce";
                    break;
                    case 15: $diaA="quince";
                    break;
                    case 16: $diaA="dieciséis";
                    break;
                    case 17: $diaA="diecisiete";
                    break;
                    case 18: $diaA="dieciocho";
                    break;
                    case 19: $diaA="diecinueve";
                    break;
                    case 20: $diaA="veinte";
                    break;
                    case 21: $diaA="veintiuno";
                    break;
                    case 22: $diaA="veintidós";
                    break;
                    case 23: $diaA="veintitrés";
                    break;
                    case 24: $diaA="veinticuatro";
                    break;
                    case 25: $diaA="veinticinco";
                    break;
                    case 26: $diaA="veintiséis";
                    break;
                    case 27: $diaA="veintisiete";
                    break;
                    case 28: $diaA="veintiocho";
                    break;
                    case 29: $diaA="veintinueve";
                    break;
                    case 31: $diaA="veintinueve";
                    break;
                    case 31: $diaA="treinta y uno";
                    break;
                    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                    function valorEnLetras($x)
                    {
                    if ($x<0) { $signo = "menos ";}
                    else      { $signo = "";}
                    $x = abs ($x);
                    $C1 = $x;
                    
                    $G6 = floor($x/(1000000));  // 7 y mas
                    
                    $E7 = floor($x/(100000));
                    $G7 = $E7-$G6*10;   // 6
                    
                    $E8 = floor($x/1000);
                    $G8 = $E8-$E7*100;   // 5 y 4
                    
                    $E9 = floor($x/100);
                    $G9 = $E9-$E8*10;  //  3
                    
                    $E10 = floor($x);
                    $G10 = $E10-$E9*100;  // 2 y 1
                    
                    
                    $G11 = round(($x-$E10)*100,0);  // Decimales
                    //////////////////////
                    
                    $H6 = unidades($G6);
                    
                    if($G7==1 AND $G8==0) { $H7 = "cien "; }
                    else {    $H7 = decenas($G7); }
                    
                    $H8 = unidades($G8);
                    
                    if($G9==1 AND $G10==0) { $H9 = "cien "; }
                    else {    $H9 = decenas($G9); }
                    
                    $H10 = unidades($G10);
                    
                    if($G11 < 10) { $H11 = "0".$G11; }
                    else { $H11 = $G11; }
                    
                    /////////////////////////////
                        if($G6==0) { $I6=" "; }
                    elseif($G6==1) { $I6="millón "; }
                             else { $I6="millones "; }
                             
                    if ($G8==0 AND $G7==0) { $I8=" "; }
                             else { $I8="mil "; }
                             
                  /*  $I10 = "Pesos ";
                    $I11 = "/100 M.N. ";*/
                    
                    $C3 = $signo.$H6.$I6.$H7.$H8.$I8.$H9.$H10;
                    
                    return $C3; //Retornar el resultado
                    
                    }
                    
                    function unidades($u)
                    {
                        if ($u==0)  {$ru = " ";}
                    elseif ($u==1)  {$ru = "un ";}
                    elseif ($u==2)  {$ru = "dos ";}
                    elseif ($u==3)  {$ru = "tres ";}
                    elseif ($u==4)  {$ru = "cuatro ";}
                    elseif ($u==5)  {$ru = "cinco ";}
                    elseif ($u==6)  {$ru = "seis ";}
                    elseif ($u==7)  {$ru = "siete ";}
                    elseif ($u==8)  {$ru = "ocho ";}
                    elseif ($u==9)  {$ru = "nueve ";}
                    elseif ($u==10) {$ru = "diez ";}
                    
                    elseif ($u==11) {$ru = "once ";}
                    elseif ($u==12) {$ru = "doce ";}
                    elseif ($u==13) {$ru = "trece ";}
                    elseif ($u==14) {$ru = "catorce ";}
                    elseif ($u==15) {$ru = "quince ";}
                    elseif ($u==16) {$ru = "dieciseis ";}
                    elseif ($u==17) {$ru = "decisiete ";}
                    elseif ($u==18) {$ru = "dieciocho ";}
                    elseif ($u==19) {$ru = "diecinueve ";}
                    elseif ($u==20) {$ru = "veinte ";}
                    
                    elseif ($u==21) {$ru = "veintiun ";}
                    elseif ($u==22) {$ru = "veintidos ";}
                    elseif ($u==23) {$ru = "veintitres ";}
                    elseif ($u==24) {$ru = "veinticuatro ";}
                    elseif ($u==25) {$ru = "veinticinco ";}
                    elseif ($u==26) {$ru = "veintiseis ";}
                    elseif ($u==27) {$ru = "veintisiente ";}
                    elseif ($u==28) {$ru = "veintiocho ";}
                    elseif ($u==29) {$ru = "veintinueve ";}
                    elseif ($u==30) {$ru = "treinta ";}
                    
                    elseif ($u==31) {$ru = "treintayun ";}
                    elseif ($u==32) {$ru = "treintaydos ";}
                    elseif ($u==33) {$ru = "treintaytres ";}
                    elseif ($u==34) {$ru = "treintaycuatro ";}
                    elseif ($u==35) {$ru = "treintaycinco ";}
                    elseif ($u==36) {$ru = "treintayseis ";}
                    elseif ($u==37) {$ru = "treintaysiete ";}
                    elseif ($u==38) {$ru = "treintayocho ";}
                    elseif ($u==39) {$ru = "treintaynueve ";}
                    elseif ($u==40) {$ru = "cuarenta ";}
                    
                    elseif ($u==41) {$ru = "cuarentayun ";}
                    elseif ($u==42) {$ru = "cuarentaydos ";}
                    elseif ($u==43) {$ru = "cuarentaytres ";}
                    elseif ($u==44) {$ru = "cuarentaycuatro ";}
                    elseif ($u==45) {$ru = "cuarentaycinco ";}
                    elseif ($u==46) {$ru = "cuarentayseis ";}
                    elseif ($u==47) {$ru = "cuarentaysiete ";}
                    elseif ($u==48) {$ru = "cuarentayocho ";}
                    elseif ($u==49) {$ru = "cuarentaynueve ";}
                    elseif ($u==50) {$ru = "cincuenta ";}
                    
                    elseif ($u==51) {$ru = "cincuentayun ";}
                    elseif ($u==52) {$ru = "cincuentaydos ";}
                    elseif ($u==53) {$ru = "cincuentaytres ";}
                    elseif ($u==54) {$ru = "cincuentaycuatro ";}
                    elseif ($u==55) {$ru = "cincuentaycinco ";}
                    elseif ($u==56) {$ru = "cincuentayseis ";}
                    elseif ($u==57) {$ru = "cincuentaysiete ";}
                    elseif ($u==58) {$ru = "cincuentayocho ";}
                    elseif ($u==59) {$ru = "cincuentaynueve ";}
                    elseif ($u==60) {$ru = "sesenta ";}
                    
                    elseif ($u==61) {$ru = "sesentayun ";}
                    elseif ($u==62) {$ru = "sesentaydos ";}
                    elseif ($u==63) {$ru = "sesentaytres ";}
                    elseif ($u==64) {$ru = "sesentaycuatro ";}
                    elseif ($u==65) {$ru = "sesentaycinco ";}
                    elseif ($u==66) {$ru = "sesentayseis ";}
                    elseif ($u==67) {$ru = "sesentaysiete ";}
                    elseif ($u==68) {$ru = "sesentayocho ";}
                    elseif ($u==69) {$ru = "sesentaynueve ";}
                    elseif ($u==70) {$ru = "setenta ";}
                    
                    elseif ($u==71) {$ru = "setentayun ";}
                    elseif ($u==72) {$ru = "setentaydos ";}
                    elseif ($u==73) {$ru = "setentaytres ";}
                    elseif ($u==74) {$ru = "setentaycuatro ";}
                    elseif ($u==75) {$ru = "setentaycinco ";}
                    elseif ($u==76) {$ru = "setentayseis ";}
                    elseif ($u==77) {$ru = "setentaysiete ";}
                    elseif ($u==78) {$ru = "setentayocho ";}
                    elseif ($u==79) {$ru = "setentaynueve ";}
                    elseif ($u==80) {$ru = "ochenta ";}
                    
                    elseif ($u==81) {$ru = "ochentayun ";}
                    elseif ($u==82) {$ru = "ochentaydos ";}
                    elseif ($u==83) {$ru = "ochentaytres ";}
                    elseif ($u==84) {$ru = "ochentaycuatro ";}
                    elseif ($u==85) {$ru = "ochentaycinco ";}
                    elseif ($u==86) {$ru = "ochentayseis ";}
                    elseif ($u==87) {$ru = "ochentaysiete ";}
                    elseif ($u==88) {$ru = "ochentayocho ";}
                    elseif ($u==89) {$ru = "ochentaynueve ";}
                    elseif ($u==90) {$ru = "noventa ";}
                    
                    elseif ($u==91) {$ru = "noventayun ";}
                    elseif ($u==92) {$ru = "noventaydos ";}
                    elseif ($u==93) {$ru = "noventaytres ";}
                    elseif ($u==94) {$ru = "noventaycuatro ";}
                    elseif ($u==95) {$ru = "noventaycinco ";}
                    elseif ($u==96) {$ru = "noventayseis ";}
                    elseif ($u==97) {$ru = "noventaysiete ";}
                    elseif ($u==98) {$ru = "noventayocho ";}
                    else            {$ru = "noventaynueve ";}
                    return $ru; //Retornar el resultado
                    }
                    
                    function decenas($d)
                    {
                        if ($d==0)  {$rd = "";}
                    elseif ($d==1)  {$rd = "ciento ";}
                    elseif ($d==2)  {$rd = "doscientos ";}
                    elseif ($d==3)  {$rd = "trescientos ";}
                    elseif ($d==4)  {$rd = "cuatrocientos ";}
                    elseif ($d==5)  {$rd = "quinientos ";}
                    elseif ($d==6)  {$rd = "seiscientos ";}
                    elseif ($d==7)  {$rd = "setecientos ";}
                    elseif ($d==8)  {$rd = "ochocientos ";}
                    else            {$rd = "novecientos ";}
                    return $rd; //Retornar el resultado
                    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
            //FECHA DE REALIZACIÓN
            foreach($confirmando as &$c){
            $fecha= $c->fecha_realizacion;
            $dia=date("d", strtotime($fecha));
            $mes=date("m", strtotime($fecha));
            $anio=date("Y", strtotime($fecha));
            $anioL=valorEnLetras($anio);

            switch($mes){
                case 01: $mes="enero";
                break;
                case 02: $mes="febrero";
                break;
                case 03: $mes="marzo";
                break;
                case 04: $mes="abril";
                break;
                case 05: $mes="mayo";
                break;
                case 06: $mes="junio";
                break;
                case 07: $mes="julio";
                break;
                case 8: $mes="agosto";
                break;
                case 9: $mes="septiembre";
                break;
                case 10: $mes="octubre";
                break;
                case 11: $mes="noviembre";
                break;
                case 12: $mes="diciembre";
                break;
                }
                
                if($c->sexo == 'F'){
                    $sexoPersona1="Hija de";
                    $sexoPersona2="Nacida el";
                    $sexoPersona3="Bautizada en";
                    $sexoPersona4="Fue Confirmada";
                }else{
                    $sexoPersona1="Hijo de";
                    $sexoPersona2="Nacido el";
                    $sexoPersona3="Bautizado en";
                    $sexoPersona4="Fue Confirmado";
                }

            }
        // FECHA DE NACIMIENTO
            foreach($confirmando as &$c){
                $fecha= $c->fecha_nacimiento;
                $diaN=date("d", strtotime($fecha));
                $mesN=date("m", strtotime($fecha));
                $anioN=date("Y", strtotime($fecha));
                $anioL=valorEnLetras($anio);
    
                switch($mesN){
                    case 01: $mesN="enero";
                    break;
                    case 02: $mesN="febrero";
                    break;
                    case 03: $mesN="marzo";
                    break;
                    case 04: $mesN="abril";
                    break;
                    case 05: $mesN="mayo";
                    break;
                    case 06: $mesN="junio";
                    break;
                    case 07: $mesN="julio";
                    break;
                    case 8: $mesN="agosto";
                    break;
                    case 9: $mesN="septiembre";
                    break;
                    case 10: $mesN="octubre";
                    break;
                    case 11: $mesN="noviembre";
                    break;
                    case 12: $mesN="diciembre";
                    break;
                    }
                }

        
                    if($idpapa != 0 && $idmama == 0){
                        $yde='';
                    } elseif ($idpapa == 0 && $idmama != 0){
                        $yde='';
                    } else if ($idpapa != 0 && $idmama != 0){
                        $yde='Y de:';
                    }

            ?>

        <header>
            <div id="datos">
                <div id="logo"> 
                    <img id="imagen" src="img/logo-msc.png">
                </div>
                 <p id="titulo1">
                    <b>PARROQUIA DE SAN LUIS MARIONA
                </p>
                <p id="titulo2">
                    <br>MISIONEROS DEL SAGRADO CORAZÓN
                </p>
                <p id="titulo3">
                    <br>Km.9 Carretera Principal,San Luis Mariona,Cuscatancingo,San Salvador,El Salvador,C.A.<br>Apartado Postal 2356. Tel.:2204-0163<br>E-mail: parroquiasanluismariona.msc@gmail.com
                </p>
            </div>
        </header>
        <br>
        <br>
        <br>
        <br>
        <section>
        <div id="parrafoM">
                 <p id="TituloCert">
                 CERTIFICADO DE CONFIRMACIÓN
                 </p>
                 <p id="parrafo">
                 El suscrito Párroco de la Parroquia de San Luis Gonzaga en Mariona de  la Ciudad Cuscatancingo hace constar que:
                 @foreach ($confirmando as $c)
                 <br>En el libro de Confirmaciones No. {{$c->libro}}, Folio No. {{$c->folio}}, Asiento No. {{$c->asiento}} que nuestra
                 parroquia lleva. Se encuentra registrado: 
                 </p>
                 <p id="parrafo3">
                 <b>{{$c->nomrea}} {{$c->apelrea}}</b>
                 @endforeach
                 </p>
                <p id="parrafo">
                <br>{{$sexoPersona1}}: 
                @if($idpapa != 0 and $idmama == 0)
                        @foreach ($papa as $p)
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$p->nompapa}} {{$p->apelpapa}}
                        @endforeach
                    @elseif ($idpapa == 0 and $idmama != 0)
                        @foreach ($mama as $m)
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$m->nommama}} {{$m->apelmama}}
                        @endforeach
                    @elseif ($idpapa != 0 and $idmama != 0)
                        @foreach ($papa as $p)
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$p->nompapa}} {{$p->apelpapa}}
                        @endforeach
                        <br> {{$yde}}
                        @foreach ($mama as $m)
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$m->nommama}} {{$m->apelmama}}
                        @endforeach
                @endif


                <br> {{$sexoPersona2}}:
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$diaN}} de {{$mesN}} de {{$anioN}}
                <br> {{$sexoPersona3}}:
                @foreach ($iglesiaBa as $i)
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$i->nombre_iglesia}}
                @endforeach
                <br>{{$sexoPersona4}}: 
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$dia}} de {{$mes}} de {{$anio}}

                 <br>Por:
                 @foreach ($padre as $padree)
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$padree->titulo}} {{$padree->nompadre}} {{$padree->apelpadre}}
                 @endforeach
                </p>

                 <p id="parrafo">
                 <!-- modificar -->
                 <br>Siendo sus padrinos: 
                 @foreach ($p1 as $pa1)
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$pa1->nompad1}} {{$pa1->apelpad1}}
                 @endforeach
                 @foreach ($p2 as $pa2)
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$pa2->nompad2}} {{$pa2->apelpad2}}
                 @endforeach
                 @foreach ($p3 as $pa3)
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$pa3->nompad3}} {{$pa3->apelpad3}}
                 @endforeach
                 @foreach ($p4 as $pa4)
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$pa4->nompad4}} {{$pa4->apelpad4}}   
                 @endforeach
                 </p>

                 <p id="parrafo">  
                 @foreach($sacerFirma as $sf)           
                    <br>Es Copia conforme al original y para efectos de <b>{{$sf->conceptoim}}</b>
                @endforeach   
                     firmo y sello la presente en Cuscatancingo a {{$diaA}} días del mes de {{$mesA}} del año {{$anioAL}} 

                 </p>
                 <br>
                 <br>
                 <p id="parrafo2">  
                 @foreach($sacerFirma as $ss)      
                  <br>{{$ss->sacerFirmN}} {{$ss->sacerFirmA}}, MSC
                  <br>{{$ss->cargoim}}
                  @endforeach
                 </p>
        </div>        
        </section>
        <br>
    </body>
</html>