<?php

/**
 * Description of Util
 *
 * @author Santiago Benítez <sbenitez@tradesystem.com.ec>
 */
class Util {

    /**
     * Revisa si el usuario tiene acceso dependiendo de las operaciones que se envien
     * @author Santiago Benítez
     * @param array $operations
     * @return boolean resultado
     */
    public static function checkAccess($operations) {
        if (is_array($operations)) {
            foreach ($operations as $operation) {
                if (Yii::app()->user->checkAccess($operation)) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Register a specific js file in the asset's js folder
     * @param string $jsFile
     * @param int $position the position of the JavaScript code.
     * @see CClientScript::registerScriptFile
     */
    public static function tsRegisterAssetJs($jsFile, $position = CClientScript::POS_END) {
        $assetsPath = Yii::getPathOfAlias(YiiBase::app()->getController()->getModule()->getId() . '.assets');
        $assetsUrl = Yii::app()->assetManager->publish($assetsPath, false, -1, true);
        Yii::app()->getClientScript()->registerScriptFile($assetsUrl . "/js/" . YiiBase::app()->getController()->getId() . "/" . $jsFile, $position);
    }

    /**
     * Al buscar cliente/proveedor/distribuidor, me retorn ael id de la columna seleccionada
     * @param type $button
     * @param type $data
     * @return type
     * @author Ivan Naranjo <inaranjo@tradesystem.com.ec>
     */
    public static function getGridViewId($options, $data) {
        foreach ($options as &$option) {
            if (strpos($option, '$data->') !== false) {
                $propiedad = str_replace('$data->', '', $option);
                $option = $data->$propiedad;
            }
        }
        return $options;
    }

    /**
     * // regresa la cadena sin subguiones("_"), y los convierte en espacios, ademas de poner letra capital
     * @param type $nomre
     * @author Ivan Naranjo <inaranjo@tradesystem.com.ec>
     */
    public static function setName($nombre) {
        $nombre = str_replace('_', " ", $nombre);
        return ucwords(strtolower($nombre)); //retorna la primera letra de cada palabra en mayusculas
    }

    /**
     * recive 2 fechas, 1)el tiempo de creacion. 2)El tiempo que toma en resolverse una incidencia y devuelve
     * el tiempo restante para resolverla en horas 
     * @param type $fCreacion
     * @param type $tIncidencia
     * @return type
     * @author Ivan Naranjo <inaranjo@tradesystem.com.ec>
     */
    //TODO: Borrar en caso que ya no se utilice
    public static function semaforoUtil($fCreacion, $tIncidencia) {
        $tiempo = (strtotime($fCreacion . "+ {$tIncidencia} hour") - strtotime(date("Y-m-d H:i:s"))) / 3600;
        $minutos = round(($tiempo - floor($tiempo)) * 60);
        if ($minutos < 10) {//si los minutos son menores a 10, setear con 0 adelante
            $minutos = "0" . $minutos;
        } else if ($minutos == 60) {
            $minutos = "00";
            $tiempo += 1;
        }
        return floor($tiempo) . "h " . $minutos . "m"; //retorna la diferencia de tiempo en horas y minutos
    }

    /**
     * recive 2 fechas, 1)el tiempo de creacion. 2)El tiempo que toma en resolverse una incidencia y devuelve
     * el tiempo restante para resolverla en horas 
     * @param type $fCreacion
     * @param type $tIncidencia
     * @return type
     * @author Ivan Naranjo <inaranjo@tradesystem.com.ec>
     */
    public static function semaforo($fGestion) {
        $tiempoDias = (strtotime($fGestion) - strtotime(date("Y-m-d H:i:s"))) / 86400;
        $dias = floor($tiempoDias);
        $tiempoHoras = ($tiempoDias - $dias) * 24;
        $horas = floor($tiempoHoras);
        $minutos = round(($tiempoHoras - $horas) * 60);
        if ($horas == 24 || ($horas == 23 && $minutos == 60)) {
            $horas = "00";
            $minutos = "00";
            $dias += 1;
            $tiempoDias += 1;
        } else if ($minutos == 60) {
            $minutos = "00";
            $horas += 1;
            $tiempoHoras += 1;
        }
//        echo $dias . ", " .$horas . ", " . $minutos."      ";
        if ($tiempoDias >= 0) {
            return (floor($tiempoDias) != 0 ? ($dias . "d ") : "") . (floor($tiempoHoras) != 0 ? ($horas . "h ") : "") . $minutos . "m"; //retorna la diferencia de tiempo en horas y minutos
        } else {
            return "Vencido";
        }
    }

    /**
     * Retorna los años cercanos al año actual
     * @author Santiago Benítez <sbenitez@tradesystem.com.ec>
     * @param type $yearsMin
     * @param type $yearsMax
     * @return array
     */
    public static function getYears($yearsMin = 10, $yearsMax = 0) {
        $year = intval(date("Y"));
        $years = array();
        for ($i = $year - $yearsMin; $i <= $year + $yearsMax; $i++) {
            $years[$i] = $i;
        }
        return $years;
    }

    /**
     * exporta una tabla a pdf
     * @author Esteban Preciado <epreciado@tradesystem.com.ec>
     * @param type $pag_render
     * @param array $options
     * @param type $boolean
     * @param Controller $controller
     */
    public static function llamarPdf($controller, $titulo, $pag_render, $options, $boolean, $reporte_nombre) {

        //PDF
        # You can easily override default constructor's params
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');

        # Load a stylesheet
        $stylesheet2 = file_get_contents(Yii::getPathOfAlias('webroot.css') . '/bootstrap.css');
        $stylesheet3 = file_get_contents(Yii::getPathOfAlias('webroot.css') . '/screen.css');
        $mPDF1->WriteHTML($stylesheet2, 1);
        $mPDF1->WriteHTML($stylesheet3, 1);

        # Renders image
        $mPDF1->WriteHTML('<div class="row">');
        $mPDF1->WriteHTML("<div class='span9'");
        $mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.images') . '/repsol.gif'));
//                . " GAS(GPL)"
        $mPDF1->WriteHTML("</div>");
        $mPDF1->WriteHTML("<table border='0' class='table span3' style='float: left;'>");
        $mPDF1->WriteHTML("<tbody>");
        $mPDF1->WriteHTML("<tr>");
        $mPDF1->WriteHTML("<td>Guayaquil: Edificio San Borondón Business Center, Torre B, piso B oficina 211 </td>");
        $mPDF1->WriteHTML("</tr>");
        $mPDF1->WriteHTML("<tr>");
        $mPDF1->WriteHTML("<td>Quito: Av. 12 de octubre N24-593 y Francisco Salazar, Edif. Plaza 2000</td>");
        $mPDF1->WriteHTML("</tr>");
        $mPDF1->WriteHTML("<tr>");
        $mPDF1->WriteHTML("<td>Tlf: 1-700-Repsolgas (1-700-737765)</td>");
        $mPDF1->WriteHTML("</tr>");
        $mPDF1->WriteHTML("</tbody>");
        $mPDF1->WriteHTML("</table>");
        $mPDF1->WriteHTML("</div>");
        $mPDF1->WriteHTML('<strong style="font-size: 18px;">' . $titulo);
        $mPDF1->WriteHTML("<br>");
        $mPDF1->WriteHTML("<strong>" . Util::traducirFechaActual() . "</strong>");
        //Tabla de datos
        $mPDF1->WriteHTML("<br><br><br>");
        $mPDF1->WriteHTML("<strong>DATOS DEL CLIENTE</strong>");
        $mPDF1->WriteHTML("<table border='1'>");
        $mPDF1->WriteHTML("<tbody>");
        $mPDF1->WriteHTML("<tr>");
        $mPDF1->WriteHTML("<td><strong>NUMERO DE INSTALACION:</strong>&nbsp;" . $options[0] . "</td>");
        $mPDF1->WriteHTML("<td><strong>RAZON SOCIAL:</strong>&nbsp;" . $options[1] . "</td>");
        $mPDF1->WriteHTML("</tr>");
        $mPDF1->WriteHTML("<tr>");
        $mPDF1->WriteHTML("<td><strong>RUC:</strong>&nbsp;" . $options[2] . "</td>");
        $mPDF1->WriteHTML("<td><strong>CODIGO CLIENTE:</strong>&nbsp;" . $options[3] . "</td>");
        $mPDF1->WriteHTML("</tr>");
        $mPDF1->WriteHTML("</tbody>");
        $mPDF1->WriteHTML("</table>");
        $mPDF1->WriteHTML("<br>");
        $mPDF1->WriteHTML("<strong>DETALLE</strong>");
        $mPDF1->WriteHTML("<table border='1'>");
        $mPDF1->WriteHTML("<tbody>");
        $mPDF1->WriteHTML("<tr>");
        $mPDF1->WriteHTML("<td><strong>TIPIFICACION:</strong>&nbsp;" . $options[4] . "</td>");
        $mPDF1->WriteHTML("<td><strong>MOTIVO:</strong>&nbsp;" . $options[5] . "</td>");
        $mPDF1->WriteHTML("</tr>");
        $mPDF1->WriteHTML("<tr>");
        $mPDF1->WriteHTML("<td><strong>SUBMOTIVO:</strong>&nbsp;" . $options[6] . "</td>");
        $mPDF1->WriteHTML("<td><strong>TIEMPO ESTIMADO DE RESOLUCION:</strong>&nbsp;" . $options[7] . " horas </td>");
        $mPDF1->WriteHTML("</tr>");
        $mPDF1->WriteHTML("</tbody>");
        $mPDF1->WriteHTML("</table>");
        $mPDF1->WriteHTML("<br>");
        $mPDF1->WriteHTML("<table border='1'>");
        $mPDF1->WriteHTML("<tbody>");
        $mPDF1->WriteHTML("<tr>");
        $mPDF1->WriteHTML("<td><strong>OBSERVACIONES:</strong>&nbsp;" . $options[8] . "</td>");
        $mPDF1->WriteHTML("</tr>");
        $mPDF1->WriteHTML("</tbody>");
        $mPDF1->WriteHTML("</table>");
        $mPDF1->WriteHTML("<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>");
        $mPDF1->WriteHTML("<table border='0'>");
        $mPDF1->WriteHTML("<tbody>");
        $mPDF1->WriteHTML("<tr>");
        $mPDF1->WriteHTML("<td>______________________________________ </td>");
        $mPDF1->WriteHTML("<td>______________________________________ </td>");
        $mPDF1->WriteHTML("</tr>");
        $mPDF1->WriteHTML("<tr>");
        $mPDF1->WriteHTML("<td><strong>Cliente</strong></td>");
        $mPDF1->WriteHTML('<td><strong>Responsable</strong></td>');
        $mPDF1->WriteHTML("</tr>");
        $mPDF1->WriteHTML("</tbody>");
        $mPDF1->WriteHTML("</table>");
        # Outputs ready PDF
        $mPDF1->WriteHTML($controller->renderPartial($pag_render, $options, $boolean));
        $mPDF1->Output($reporte_nombre . '.pdf', 'D');
//        die();
    }

    /**
     * Transforma un arreglo de objetos ActiveRecord para que se desplieguen en un select de HTML
     * @author Santiago Benítez
     * @param type $arrayOptions
     * @return String $options
     */
    public static function toSelectOptions($arrayOptions) {
        $options = array("" => " - Seleccione - ") + CHtml::listData($arrayOptions, 'id', TipificacionIncidencia::representingColumn());
        $htmlOptions = "";
        foreach ($options as $key => $option) {
            $htmlOptions .= '<option value="' . $key . '">' . $option . '</option>';
        }
        return $htmlOptions;
    }

    /**
     * Traduce la fecha actual a español
     * @author  Santiago Benítez
     * @return type
     */
    public static function traducirFechaActual() {
        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        return date('d') . " de " . $meses[date('n') - 1] . " del " . date('Y');
    }

    public static function quitarScripts() {
        Yii::app()->clientScript->scriptMap['*.js'] = false;
        Yii::app()->clientScript->scriptMap['*.css'] = false;
    }

    /**Transforma de bytes a kb, Mb y Gb
     * @author Ivan 
     * @param type $bytes
     */
    public static function fileSize($bytes) {
        if (gettype($bytes) !== 'integer') {
            echo '';
        }
        if ($bytes >= 1000000000) {
            echo round($bytes / 1000000000, 2) . ' GB';
        } else if ($bytes >= 1000000) {
            echo round($bytes / 1000000, 2) . ' MB';
        } else {
            echo round($bytes / 1000, 2) . ' KB';
        }
    }

    
}
?>
