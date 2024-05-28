<?php
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=empresas_PB.xls");  //File name extension was wrong
include "../includes/sdk_import.php";
include "../includes/plan-bogota.php";
$pb = new planbogota('es');
$filtered = $pb->allEmpresasActivas();
$fields = ["Título","Body","Email","Empresa destacada","Link de la empresa","Localidad Relacionada","Logo","Nombre de la empresa","Segmento relacionado","Teléfono","¿Operador autorizado Ruta Leyenda el Dorado?"];
$string = '<table style="width:100%">';
$valid_ext = array("pdf","doc","docx","jpg","png","jpeg");
$string .= '<tr>';
for ($i=0; $i < count($fields); $i++) { 
    $string .= '<th>'.$fields[$i].'</th>';
}
    $string .= '</tr>';

    for ($i=0; $i < count($filtered); $i++) { 
        $string .= '<tr>';
            $string .= '<td>'.$filtered[$i]->title.'</td>';  
            $string .= '<td>'.$filtered[$i]->body.'</td>';  
            $string .= '<td>'.$filtered[$i]->field_pb_empresa_email.'</td>';  
            $string .= '<td>'.$filtered[$i]->field_featuredcompany.'</td>';  
            $string .= '<td>'.$filtered[$i]->field_pb_empresa_direccion.'</td>';  
            $string .= '<td>'.$filtered[$i]->field_localidad_relacionada.'</td>';  
            $string .= '<td>'.$filtered[$i]->field_pb_empresa_logo.'</td>';  
            $string .= '<td>'.$filtered[$i]->field_pb_empresa_titulo.'</td>';  
            $string .= '<td>'.$filtered[$i]->field_segment.'</td>';  
            $string .= '<td>'.$filtered[$i]->field_pb_empresa_telefono.'</td>';  
            $string .= '<td>'.$filtered[$i]->field_pb_empresa_pertenece_rld.'</td>';  
            $string .= '</tr>';
        }



$string .= '</thead>';
echo $string;
?>