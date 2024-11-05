<?php

   header("Content-type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename= Analisis de encuesta.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
   
    include('../../conexion.php');
    $conection->set_charset('utf8');

    $year=date("Y");

    $messel=$_REQUEST['id'];

//$nosemana=$_REQUEST['semana'];

$query_productos = mysqli_query($conection,"SELECT MONTH(fecha) as mes, cliente, nombre_area, medio, tiempo_forma, tiempo_respuesta, disponibilidad, calidad, asesoria_tecnica, limpieza_condicion, servicio_operador, conduce_adecuado, atencion_calidad, servicio_facturacion, nuestros_precios, comentarios from encuesta_clientes WHERE YEAR(fecha) = $year and MONTH(fecha)=$messel GROUP by cliente, MONTH(fecha) ");
      $result = mysqli_num_rows($query_productos);
     $entrada = mysqli_fetch_assoc($query_productos);
     $mes         = $entrada['mes'];

     if ($mes == 1) {
       $names = "ENERO";
     }else {
      if ($mes == 2) {
        $names = "FEBRERO";
      }else {
        if ($mes == 3) {
          $names = "MARZO";
        }else {
          if ($mes == 4) {
            $names = "ABRIL";
          }else {
            if ($mes == 5) {
              $names = "MAYO"; 
            }else {
              if ($mes == 6) {
                $names = "JUNIO";
              }else {
                if ($mes == 7) {
                  $names = "JULIO";
                }else {
                  if ($mes == 8) {
                    $names = "AGOSTO";
                  }else {
                    if ($mes == 9) {
                      $names = "SEPTIEMBRE";
                    }else {
                      if ($mes == 10) {
                        $names = "OCTUBRE";
                      }else {
                        if ($mes == 11) {
                          $names = "NOVIEMBRE";
                        }else {
                          if ($mes == 12) {
                            $names = "DICIEMBRE";
                          }
                        }
                      }
                    }
                  }
                }
              }
            }
          }
        }
      }
     }
     
  
?>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
<?php echo '<h3>ENCUESTA DE SATISFACCIÓN DEL CLIENTE</h3> '; ?>
<?php
$clientes = "";
$contactos = "";
$medios = "";
$notas = "";
$un_salto="<br>";
$resp1  = 0;
$resp2  = 0;
$resp3  = 0;
$resp4  = 0;
$resp5  = 0;
$resp6  = 0;
$resp7  = 0;
$resp8  = 0;
$resp9  = 0;
$resp10 = 0;
$resp11 = 0;
$num = 0;
$prom1  = 0;
$prom2  = 0;
$prom3  = 0;
$prom4  = 0;
$prom5  = 0;
$prom6  = 0;
$prom7  = 0;
$prom8  = 0;
$prom9  = 0;
$prom10 = 0;
$prom11 = 0;
$promgral = 0;
$query = mysqli_query($conection,"SELECT MONTH(fecha) as mes, cliente, nombre_area, medio, tiempo_forma, tiempo_respuesta, disponibilidad, calidad, asesoria_tecnica, limpieza_condicion, servicio_operador, conduce_adecuado, atencion_calidad, servicio_facturacion, nuestros_precios, comentarios from encuesta_clientes WHERE YEAR(fecha) = $year and MONTH(fecha) = $messel GROUP by cliente, MONTH(fecha) ");
      $result_detalle = mysqli_num_rows($query);
       mysqli_close($conection); 
   while ($row=mysqli_fetch_assoc($query)) { 
   $num = $num + 1;
   $clientes = $clientes . $un_salto .$row['cliente'];
   $contactos = $contactos . $un_salto .$row['nombre_area'];
   $medios = $medios . $un_salto .$row['medio'];
   $resp1 = $resp1 + $row['tiempo_forma'];
   $prom1 = $resp1 / $num;
   $resp2 = $resp2 + $row['tiempo_respuesta'];
   $prom2 = $resp2 / $num;
   $resp3 = $resp3 + $row['disponibilidad'];
   $prom3 = $resp3 / $num;
   $resp4 = $resp4 + $row['calidad'];
   $prom4 = $resp4 / $num;
   $resp5 = $resp5 + $row['asesoria_tecnica'];
   $prom5 = $resp5 / $num;
   $resp6 = $resp6 + $row['limpieza_condicion'];
   $prom6 = $resp6 / $num;
   $resp7 = $resp7 + $row['servicio_operador'];
   $prom7 = $resp7 / $num;
   $resp8 = $resp8 + $row['conduce_adecuado'];
   $prom8 = $resp8 / $num;
   $resp9 = $resp9 + $row['atencion_calidad'];
   $prom9 = $resp9 / $num;
   $resp10 = $resp10 + $row['servicio_facturacion'];
   $prom10 = $resp10 / $num;
   $resp11 = $resp11 + $row['nuestros_precios'];
   $prom11 = $resp11 / $num;
   $promgral = ($prom1 + $prom2 + $prom3 + $prom4 + $prom5 + $prom6 + $prom7 + $prom8 + $prom9 + $prom10 + $prom11) / 11;
   $notas = $notas . $un_salto .$row['comentarios'];

   }  


include('../../conexion.php');
$messel2 = $messel + 1;
if ($messel2 == 1) {
       $names2 = "ENERO";
     }else {
      if ($messel2 == 2) {
        $names2 = "FEBRERO";
      }else {
        if ($messel2 == 3) {
          $names2 = "MARZO";
        }else {
          if ($messel2 == 4) {
            $names2 = "ABRIL";
          }else {
            if ($messel2 == 5) {
              $names2 = "MAYO"; 
            }else {
              if ($messel2 == 6) {
                $names2 = "JUNIO";
              }else {
                if ($messel2 == 7) {
                  $names2 = "JULIO";
                }else {
                  if ($messel2 == 8) {
                    $names2 = "AGOSTO";
                  }else {
                    if ($messel2 == 9) {
                      $names2 = "SEPTIEMBRE";
                    }else {
                      if ($messel2 == 10) {
                        $names2 = "OCTUBRE";
                      }else {
                        if ($messel2 == 11) {
                          $names2 = "NOVIEMBRE";
                        }else {
                          if ($messel2 == 12) {
                            $names2 = "DICIEMBRE";
                          }
                        }
                      }
                    }
                  }
                }
              }
            }
          }
        }
      }
     }
$clientes2 = "";
$contactos2 = "";
$medios2 = "";
$notas2 = "";
$un_salto="<br>";
$resp12  = 0;
$resp22  = 0;
$resp32  = 0;
$resp42  = 0;
$resp52 = 0;
$resp62  = 0;
$resp72  = 0;
$resp82  = 0;
$resp92  = 0;
$resp102 = 0;
$resp112 = 0;
$num2 = 0;
$prom12  = 0;
$prom22  = 0;
$prom32  = 0;
$prom42  = 0;
$prom52  = 0;
$prom62  = 0;
$prom72  = 0;
$prom82  = 0;
$prom92  = 0;
$prom102 = 0;
$prom112 = 0;
$promgral2 = 0;
$query2 = mysqli_query($conection,"SELECT MONTH(fecha) as mes, cliente, nombre_area, medio, tiempo_forma, tiempo_respuesta, disponibilidad, calidad, asesoria_tecnica, limpieza_condicion, servicio_operador, conduce_adecuado, atencion_calidad, servicio_facturacion, nuestros_precios, comentarios from encuesta_clientes WHERE YEAR(fecha) = $year and MONTH(fecha) = $messel2 GROUP by cliente, MONTH(fecha) ");
      $result_detalle2 = mysqli_num_rows($query2);
       mysqli_close($conection); 
   while ($row2=mysqli_fetch_assoc($query2)) { 
   $num2 = $num2 + 1;
   $clientes2 = $clientes2 . $un_salto .$row2['cliente'];
   $contactos2 = $contactos2 . $un_salto .$row2['nombre_area'];
   $medios2 = $medios2 . $un_salto .$row2['medio'];
   $resp12 = $resp12 + $row2['tiempo_forma'];
   $prom12 = $resp12 / $num2;
   $resp22 = $resp22 + $row2['tiempo_respuesta'];
   $prom22 = $resp22 / $num2;
   $resp32 = $resp32 + $row2['disponibilidad'];
   $prom32 = $resp32 / $num2;
   $resp42 = $resp42 + $row2['calidad'];
   $prom42 = $resp42 / $num2;
   $resp52 = $resp52 + $row2['asesoria_tecnica'];
   $prom52 = $resp52 / $num2;
   $resp62 = $resp62 + $row2['limpieza_condicion'];
   $prom62 = $resp62 / $num2;
   $resp72 = $resp72 + $row2['servicio_operador'];
   $prom72 = $resp72 / $num2;
   $resp82 = $resp82 + $row2['conduce_adecuado'];
   $prom82 = $resp82 / $num2;
   $resp92 = $resp92 + $row2['atencion_calidad'];
   $prom92 = $resp92 / $num2;
   $resp102 = $resp102 + $row2['servicio_facturacion'];
   $prom102 = $resp102 / $num2;
   $resp112 = $resp112 + $row2['nuestros_precios'];
   $prom112 = $resp112 / $num2;
   $promgral2 = ($prom12 + $prom22 + $prom32 + $prom42 + $prom52 + $prom62 + $prom72 + $prom82 + $prom92 + $prom102 + $prom112) / 11;
   $notas2 = $notas2 . $un_salto .$row2['comentarios'];

   } 

include('../../conexion.php');
$messel3 = $messel + 2;
if ($messel3 == 1) {
       $names3 = "ENERO";
     }else {
      if ($messel3 == 2) {
        $names3 = "FEBRERO";
      }else {
        if ($messel3 == 3) {
          $names3 = "MARZO";
        }else {
          if ($messel3 == 4) {
            $names3 = "ABRIL";
          }else {
            if ($messel3 == 5) {
              $names3 = "MAYO"; 
            }else {
              if ($messel3 == 6) {
                $names3 = "JUNIO";
              }else {
                if ($messel3 == 7) {
                  $names3 = "JULIO";
                }else {
                  if ($messel3 == 8) {
                    $names3 = "AGOSTO";
                  }else {
                    if ($messel3 == 9) {
                      $names3 = "SEPTIEMBRE";
                    }else {
                      if ($messel3 == 10) {
                        $names3 = "OCTUBRE";
                      }else {
                        if ($messel3 == 11) {
                          $names3 = "NOVIEMBRE";
                        }else {
                          if ($messel3 == 12) {
                            $names3 = "DICIEMBRE";
                          }
                        }
                      }
                    }
                  }
                }
              }
            }
          }
        }
      }
     }
$clientes3 = "";
$contactos3 = "";
$medios3 = "";
$notas3 = "";
$un_salto="<br>";
$resp13  = 0;
$resp23  = 0;
$resp33  = 0;
$resp43  = 0;
$resp53 = 0;
$resp63  = 0;
$resp73  = 0;
$resp83  = 0;
$resp93  = 0;
$resp103 = 0;
$resp113 = 0;
$num = 0;
$prom13  = 0;
$prom23  = 0;
$prom33  = 0;
$prom43  = 0;
$prom53  = 0;
$prom63  = 0;
$prom73  = 0;
$prom83  = 0;
$prom93  = 0;
$prom103 = 0;
$prom113 = 0;
$promgral3 = 0;
$query3 = mysqli_query($conection,"SELECT MONTH(fecha) as mes, cliente, nombre_area, medio, tiempo_forma, tiempo_respuesta, disponibilidad, calidad, asesoria_tecnica, limpieza_condicion, servicio_operador, conduce_adecuado, atencion_calidad, servicio_facturacion, nuestros_precios, comentarios from encuesta_clientes WHERE YEAR(fecha) = $year and MONTH(fecha) = $messel3 GROUP by cliente, MONTH(fecha) ");
      $result_detalle3 = mysqli_num_rows($query3);
       mysqli_close($conection); 
   while ($row3=mysqli_fetch_assoc($query3)) { 
   $num3 = $num3 + 1;
   $clientes3 = $clientes3 . $un_salto .$row3['cliente'];
   $contactos3 = $contactos3 . $un_salto .$row3['nombre_area'];
   $medios3 = $medios3 . $un_salto .$row3['medio'];
   $resp13 = $resp13 + $row3['tiempo_forma'];
   $prom13 = $resp13 / $num3;
   $resp23 = $resp23 + $row3['tiempo_respuesta'];
   $prom23 = $resp23 / $num3;
   $resp33 = $resp33 + $row3['disponibilidad'];
   $prom33 = $resp33 / $num3;
   $resp43 = $resp43 + $row3['calidad'];
   $prom43 = $resp43 / $num3;
   $resp53 = $resp53 + $row3['asesoria_tecnica'];
   $prom53 = $resp53 / $num3;
   $resp63 = $resp63 + $row3['limpieza_condicion'];
   $prom63 = $resp63 / $num3;
   $resp73 = $resp73 + $row3['servicio_operador'];
   $prom73 = $resp73 / $num3;
   $resp83 = $resp83 + $row3['conduce_adecuado'];
   $prom83 = $resp83 / $num3;
   $resp93 = $resp93 + $row3['atencion_calidad'];
   $prom93 = $resp93 / $num3;
   $resp103 = $resp103 + $row3['servicio_facturacion'];
   $prom103 = $resp103 / $num3;
   $resp113 = $resp113 + $row3['nuestros_precios'];
   $prom113 = $resp113 / $num3;
   $promgral3 = ($prom13 + $prom23 + $prom33 + $prom43 + $prom53 + $prom63 + $prom73 + $prom83 + $prom93 + $prom103 + $prom113) / 11;
   $notas3 = $notas3 . $un_salto .$row3['comentarios'];
}



?>



<table  align="center" border=1 cellspacing=1 cellpadding=1>
<tr>
    <td><table  align="center" border=1 cellspacing=1 cellpadding=1>
<tr><td><table  align="center" border=1 cellspacing=1 cellpadding=1>
<tr>
    <td><table  align="center" border=1 cellspacing=1 cellpadding=1>
<tr><td><table>
  <tr><th align="left">1. Mes</th>
    <td style='font-weight: bold; font-size: 15px; '><?php echo $names; ?></td></tr>
  <tr><th></th></tr>
  <tr><th align="left">2. Nombre de la Empresa</th>
    <td style='font-weight: bold; font-size: 15px;'><?php echo $clientes; ?></td> </tr>
  <tr><th align="left">3. Nombre y área responsable</th>
    <td><?php echo $contactos; ?></td> </tr>
  <tr><th align="left">4. Medio o contacto por cual nos conocio</th>
    <td><?php echo $medios; ?></td> </tr>
  <tr><th align="left">5. Atencion en general</th>
    <td align="center"><?php echo number_format($prom1,1); ?></td> </tr>
  <tr><th align="left">6. Tirmpo de respuesta</th>
    <td align="center"><?php echo number_format($prom2,1); ?></td> </tr>
  <tr><th align="left">7. Disponibilidad del servicio</th>
    <td align="center"><?php echo number_format($prom3,1); ?></td> </tr> 
  <tr><th align="left">8. Calidad de nuestros servicios</th>
    <td align="center"><?php echo number_format($prom4,1); ?></td> </tr> 
  <tr><th align="left">9. Asesoria técnica(Tipo de unidades, modelos, capacidad de pasajeros)</th>
    <td align="center"><?php echo number_format($prom5,1); ?></td> </tr> 
  <tr><th align="left">10. Asesoria técnica(Tipo de unidades, modelos, capacidad de pasajeros)</th>
    <td align="center"><?php echo number_format($prom6,1); ?></td> </tr>
  <tr><th align="left">11. Atención, servicio, limpieza y presentación del Operador</th>
    <td align="center"><?php echo number_format($prom7,1); ?></td> </tr>
  <tr><th align="left">12. El operador conduce la unidad adecuadamente</th>
    <td align="center"><?php echo number_format($prom8,1); ?></td> </tr>
  <tr><th align="left">13. Atencion y Servicio del Área de calidad</th>
    <td align="center"><?php echo number_format($prom9,1); ?></td> </tr>
  <tr><th align="left">14. Como considera el sericio de facturación</th>
    <td align="center"><?php echo number_format($prom10,1); ?></td> </tr>
  <tr><th align="left">15. Nuestros precios</th>
    <td align="center"><?php echo number_format($prom11,1); ?></td> </tr>
  <tr><th align="left"></th>
    <td align="center" style='font-weight: bold; font-size: 15px; '><?php echo number_format($promgral,1); ?></td> </tr>
  <tr><th align="left">Comentarios ó sugerencias</th>
    <td align="center"><?php echo $notas; ?></td> </tr>  
      
</table></td></tr></table></td>
    <td><table  align="center" border=1  cellspacing=1 cellpadding=1>
<tr><td><table>
  <tr>
    <td style='font-weight: bold; font-size: 15px; '><?php echo $names2; ?></td></tr>
  <tr><th></th></tr>
  <tr>
    <td style='font-weight: bold; font-size: 15px;'><?php echo $clientes2; ?></td> </tr>
  <tr>
    <td><?php echo $contactos2; ?></td> </tr>
  <tr>
    <td><?php echo $medios2; ?></td> </tr>
  <tr>
    <td align="center"><?php echo number_format($prom12,1); ?></td> </tr>
  <tr>
    <td align="center"><?php echo number_format($prom22,1); ?></td> </tr>
  <tr>
    <td align="center"><?php echo number_format($prom32,1); ?></td> </tr> 
  <tr>
    <td align="center"><?php echo number_format($prom42,1); ?></td> </tr> 
  <tr>
    <td align="center"><?php echo number_format($prom52,1); ?></td> </tr> 
  <tr>
    <td align="center"><?php echo number_format($prom62,1); ?></td> </tr>
  <tr>
    <td align="center"><?php echo number_format($prom72,1); ?></td> </tr>
  <tr>
    <td align="center"><?php echo number_format($prom82,1); ?></td> </tr>
  <tr>
    <td align="center"><?php echo number_format($prom92,1); ?></td> </tr>
  <tr>
    <td align="center"><?php echo number_format($prom102,1); ?></td> </tr>
  <tr>
    <td align="center"><?php echo number_format($prom112,1); ?></td> </tr>
  <tr>
    <td align="center" style='font-weight: bold; font-size: 15px; '><?php echo number_format($promgral2,1); ?></td> </tr>
  <tr>
    <td align="center"><?php echo $notas2; ?></td> </tr>  
      
</table></td></tr></table></td>
    <td><table  align="center" border=1  cellspacing=1 cellpadding=1>
<tr><td> <table>
  <tr>
    <td style='font-weight: bold; font-size: 15px; '><?php echo $names3; ?></td></tr>
  <tr><th></th></tr>
  <tr>
    <td style='font-weight: bold; font-size: 15px;'><?php echo $clientes3; ?></td> </tr>
  <tr>
    <td><?php echo $contactos3; ?></td> </tr>
  <tr>
    <td><?php echo $medios3; ?></td> </tr>
  <tr>
    <td align="center"><?php echo number_format($prom13,1); ?></td> </tr>
  <tr>
    <td align="center"><?php echo number_format($prom23,1); ?></td> </tr>
  <tr>
    <td align="center"><?php echo number_format($prom33,1); ?></td> </tr> 
  <tr>
    <td align="center"><?php echo number_format($prom43,1); ?></td> </tr> 
  <tr>
    <td align="center"><?php echo number_format($prom53,1); ?></td> </tr> 
  <tr>
    <td align="center"><?php echo number_format($prom63,1); ?></td> </tr>
  <tr>
    <td align="center"><?php echo number_format($prom73,1); ?></td> </tr>
  <tr>
    <td align="center"><?php echo number_format($prom83,1); ?></td> </tr>
  <tr>
    <td align="center"><?php echo number_format($prom93,1); ?></td> </tr>
  <tr>
    <td align="center"><?php echo number_format($prom103,1); ?></td> </tr>
  <tr>
    <td align="center"><?php echo number_format($prom113,1); ?></td> </tr>
  <tr>
    <td align="center" style='font-weight: bold; font-size: 15px; '><?php echo number_format($promgral3,1); ?></td> </tr>
  <tr>
    <td align="center"><?php echo $notas3; ?></td> </tr>  
      
</table></td></tr></table></td>
    
    
</tr>
</table> 
    
  


