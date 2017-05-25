<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>
<br>
<div id="reporte" style="font-size: 28pt;">
    <table>
        <tr>
            <td><p><?=Html::img('@backend/web/images/univalle.png')?></td></p>
            <td><p><h6>UNIVERSIDAD DEL VALLE
                   <br>VICERRECTORÍA ADMINISTRATIVA
                   <br>SECCIÓN DE MANTENIMIENTO Y EJECUCIÓN DE OBRAS</h6>
                </p>
            </td>
        </tr>
    </table>
</div>


<center><h3>REPORTE DE SOLICITUDES:</h3></center>
<table class="table table-bordered" style="border-collapse: collapse;
    width: 100%;">

    <tr style="background-color: #f2f2f2">
        <th style="text-align: center; font-size: 75%; padding: 8px; background-color: #A72026; color: white;">Asignacion ID</th>
        <th style="text-align: center; font-size: 75%; padding: 8px; background-color: #A72026; color: white;">Estado</th>
        <th style="text-align: center; font-size: 75%; padding: 8px; background-color: #A72026; color: white;">Trabajador Encargado</th>
        <th style="text-align: center; font-size: 75%; padding: 8px; background-color: #A72026; color: white;">Solicitud</th>
        <th style="text-align: center; font-size: 75%; padding: 8px; background-color: #A72026; color: white;">Equipo Reparado</th>
        <th style="text-align: center; font-size: 75%; padding: 8px; background-color: #A72026; color: white;">Numero Inventario</th>
        <th style="text-align: center; font-size: 75%; padding: 8px; background-color: #A72026; color: white;">Observaciones</th>
        <th style="text-align: center; font-size: 75%; padding: 8px; background-color: #A72026; color: white;">Fecha Hora Inicio</th>
        <th style="text-align: center; font-size: 75%; padding: 8px; background-color: #A72026; color: white;">Fecha Hora Fin</th>       
    </tr>
<?php foreach($model as $row): ?>

    <tr style=":nth-child(even) {background-color: #f2f2f2}">
        <td style="text-align: center; font-size: 70%; padding: 6px;"><?= $row->asignacion_id ?></td>
        <td style="text-align: center; font-size: 70%; padding: 6px;"><?= $row->estado->nombre ?></td>
        <td style="text-align: center; font-size: 70%; padding: 6px;"><?= $row->user->nombre_completo?></td>
        <td style="text-align: center; font-size: 70%; padding: 6px;"><?= $row->solicitud->description ?></td>       
        <td style="text-align: center; font-size: 70%; padding: 6px;"><?= $row->equipo_reparado ?></td>
        <td style="text-align: center; font-size: 70%; padding: 6px;"><?= $row->numero_inventario ?></td>
        <td style="text-align: center; font-size: 70%; padding: 6px;"><?= $row->observaciones ?></td>
        <td style="text-align: center; font-size: 70%; padding: 6px;"><?= $row->fecha_hora_inicio ?></td>
        <td style="text-align: center; font-size: 70%; padding: 6px;"><?= $row->fecha_hora_fin ?></td>        

    <?php endforeach ?>
   
    
</table>