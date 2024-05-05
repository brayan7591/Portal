<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>curriculum pdf</title>
    <style>
        table, td, th{
            border: 2px solid black;
            border-collapse: collapse;
        }
        .color{
            background-color: lightgrey;
        }

        table h1, table h2, table h3, table h4{
            font-weight: 0;
            padding: 0 10px;
        }

        .margin{
            margin: 0;
            padding-left: 3px;
            padding-right: 3px;
        }

        .text-center{
            text-align: center;
        }

        .detalle{
            padding-left: 30px; 
        }
    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th class="color" colspan="3"><h1>1. INFORMACION BASICA DEL PROGRAMA DE FORMACION TITULADA</h1></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="color"><h2>1.1 DENOMINACION DEL PROGRAMA:</h2></td>
                <td colspan="2"><h3>{{$curriculum->programa->NombrePrograma}}</h3></td>
            </tr>
            <tr>
                <td class="color"><h2>1.2 CODIGO DEL PROGRAMA:</h2></td>
                <td colspan="2"><h3>{{$curriculum->programa->codigoPrograma}}</h3></td>
            </tr>
            <tr>
                <td class="color"><h2>1.3 VERSION DEL PROGRAMA:</h2></td>
                <td colspan="2"><h3>1</h3></td>
            </tr>
            <tr>
                <td class="color" rowspan="2"><h2>1.3 VIGENCIA DEL PROGRAMA:</h2></td>
                <td class="color"><h2 class="margin">Fecha de inicio:</h2></td>
                <td><h3 class="margin">{{$curriculum->FechaInicio}}</h3></td>
            </tr>
            <tr>
                <td class="color"><h2 class="margin">Fecha de finalización:</h2></td>
                <td><h3 class="margin">{{$curriculum->FechaFin ? $curriculum->FechaFin : 'El programa aun se encuentra vigente'}}</h3></td>
            </tr>
            <tr>
                <td class="color" rowspan="3"><h2>1.5 DURACIÓN MÁXIMA ESTIMADA DEL APRENDIZAJE (Horas)</h2></td>
                <td class="color"><h2 class="margin">Etapa Lectiva:</h2></td>
                <td><h3 class="margin">{{$curriculum->HorasEtapaLectiva}} horas</h3></td>
            </tr>
            <tr>
                <td class="color"><h2 class="margin">Etapa Productiva:</h2></td>
                <td><h3 class="margin">{{$curriculum->HorasEtapaProductiva}} horas</h3></td>
            </tr>
            <tr>
                <td class="color"><h2 class="margin">Total:</h2></td>
                <td><h3 class="margin">{{$curriculum->HorasEtapaLectiva + $curriculum->HorasEtapaProductiva}} horas</h3></td>
            </tr>
            <tr>
                <td class="color"><h2>1.6 TIPO DEL PROGRAMA:</h2></td>
                <td colspan="2"><h3>Titulado</h3></td>
            </tr>
            <tr>
                <td class="color"><h2>1.7 TITULO O CERTIFICADO QUE OBTENDRA:</h2></td>
                <td colspan="2"><h3>{{ucfirst($curriculum->nivel)}}</h3></td>
            </tr>
        </tbody>
    </table><br>
    @if ($curriculum->competencias->count() > 0)
        @foreach ($curriculum->competencias as $value => $competencia)
            <table>
                <thead>
                    <tr>
                        <th class="color" colspan="3"><h1>{{$value+1}}. CONTENIDO CURRICULAR DE LA COMPETENCIA</h1></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="color"><h2>{{$value+1}}.1 NORMA / UNIDAD DE COMPETENCIA</h2></td>
                        <td colspan="2"><h3>{{$competencia->norma}}</h3></td>
                    </tr>
                    <tr>
                        <td class="color"><h2>{{$value+1}}.2 CÓDIGO NORMA DE COMPETENCIA LABORAL</h2></td>
                        <td colspan="2"><h3>{{$competencia->codigo}}</h3></td>
                    </tr>
                    <tr>
                        <td class="color"><h2>{{$value+1}}.3 NOMBRE DE LA COMPETENCIA</h2></td>
                        <td colspan="2"><h3>{{$competencia->nombre}}</h3></td>
                    </tr>
                    <tr>
                        <td class="color" colspan="2"><h2>{{$value+1}}.4 DURACION MAXIMA ESTIMADA PARA EL LOGRO DEL APRENDIZAJE</h2></td>
                        <td><h3>{{$competencia->duracion}} horas</h3></td>
                    </tr>
                    <tr>
                        <td class="color text-center" colspan="3"><h2>{{$value+1}}.5 RESULTADOS DE APRENDIZAJE (RAPS)</h2></td>
                    </tr>
                    @if ($competencia->raps->count() > 0)
                        @foreach ($competencia->raps as $value2 => $rap)
                        <tr>
                            <td colspan="3"><h3 class="text-start">{{$value2 + 1}}. {{$rap->descripcion}}</h3></td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3"><h3 class="text-start">En el momento de obtener este documento: {{date('d-m-Y')}} no hay raps para esta competencia</h3></td>
                        </tr>
                    @endif
                    <tr>
                        <td class="color text-center" colspan="3"><h2>{{$value+1}}.6 SABERES, CONCEPTOS Y PRINCIPIOS</h2></td>
                    </tr>
                    @if ($competencia->conceptos->count() > 0)
                        @foreach ($competencia->conceptos as $value2 => $conceptos)
                        <tr>
                            <td colspan="3"><h3 class="text-start">{{$value2 + 1}}. {{$conceptos->descripcion}}</h3></td>
                        </tr>
                        @if ($conceptos->detalle->count() > 0)
                            @foreach ($conceptos->detalle as $value3 => $detalle)
                                <tr>
                                    <td colspan="3" class="detalle"><h4>{{$value2 + 1}}.{{$value3 + 1}} {{$detalle->descripcion}}</h4></td>
                                </tr>
                            @endforeach
                        @endif
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3"><h3 class="text-start">En el momento de obtener este documento: {{date('d-m-Y')}} no hay conceptos para esta competencia</h3></td>
                        </tr>
                    @endif
                    <tr>
                        <td class="color text-center" colspan="3"><h2>{{$value+1}}.7 SABERES DE PROCESOS</h2></td>
                    </tr>
                    @if ($competencia->saberes->count() > 0)
                        @foreach ($competencia->saberes as $value2 => $saberes)
                        <tr>
                            <td colspan="3"><h3 class="text-start">{{$value2 + 1}}. {{$saberes->descripcion}}</h3></td>
                        </tr>
                        @if ($saberes->detalle->count() > 0)
                            @foreach ($saberes->detalle as $value3 => $detalle)
                                <tr>
                                    <td colspan="3" class="detalle"><h4>{{$value2 + 1}}.{{$value3 + 1}} {{$detalle->descripcion}}</h4></td>
                                </tr>
                            @endforeach
                        @endif
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3"><h3 class="text-start">En el momento de obtener este documento: {{date('d-m-Y')}} no hay saberes para esta competencia</h3></td>
                        </tr>
                    @endif
                </tbody>
            </table><br>
        @endforeach
    @endif

    <h2> Esta informacion a sido soicitada el dia {{date('d')}} del mes {{date('m')}} en el año {{date('Y')}}</h2>
</body>
</html>