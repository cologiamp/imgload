<?php
require("conexion.php");
require("siteinfo.php");

$sql255="SELECT * FROM mmh_user_info;"; 
$r=mysql_query($sql255);
#muestra la cantidad de filas 
$rcount=mysql_num_rows($r);

function actualizarbalance($user_id,$totalearnings){

//function actualizarbalance($user_id,$totalearnings,$referedbynuevo,$nuevagananciadeldiadelref){

echo "funcion";

$sql = "SELECT payedbalance,realbalance FROM mmh_user_info WHERE user_id ='".$user_id."'";

$consulta = mysql_query($sql); 

$fetch = mysql_fetch_array($consulta);

$payedbalance = $fetch['payedbalance'];

$realbalance = $fetch['realbalance'];

$totalunpaidbalance = $totalearnings - $payedbalance;

$gananciastotales = $totalearnings;


if($totalunpaidbalance!=$realbalance){
$sql85 = "UPDATE mmh_user_info SET realbalance='".mysql_real_escape_string($totalunpaidbalance)."' WHERE user_id='".mysql_real_escape_string($user_id)."'";
$consulta85  = mysql_query($sql85);  


}

//REPETIR AHORA PARA EL REF:
/*
$sql = "SELECT payedbalance,realbalance FROM mmh_user_info WHERE user_id ='".$referedbynuevo."'";

$consulta = mysql_query($sql); 

$fetch = mysql_fetch_array($consulta);

$payedbalance = $fetch['payedbalance'];

$realbalance = $fetch['realbalance'];

$totalunpaidbalance = $totalearnings - $payedbalance;

$gananciastotales = $totalearnings;


if($totalunpaidbalance!=$realbalance){
$sql85 = "UPDATE mmh_user_info SET realbalance='".mysql_real_escape_string($totalunpaidbalance)."' WHERE user_id='".mysql_real_escape_string($user_id)."'";
$consulta85  = mysql_query($sql85);  


}
*/
//FIN REPETICION PARA REF.

return;

}

for($i=$rcount;$i>0;$i--){

$user_id = $i;

//PEDIR SOLO PARA EL PENDING
/*
$no = "no";

$sql88 = "SELECT * FROM payments WHERE username ='".$user_id."' AND pagado = '".$no."'";

$consulta88 = mysql_query($sql88); 

$fetch88 = mysql_fetch_array($consulta88);

$pendiente = $fetch88['pending'];

*/


//pedir strtotimehoy

$fechahoy = date('Y-m-j');
$fechaayer = date('Y-m-j');

//convertir fecha hoy en fecha ayer
$fechaayer = strtotime ( '-1 day' , strtotime ( $fechaayer ) ) ;
$fechaayer = date ( 'Y-m-j' , $fechaayer );


$strtotimehoy = strtotime($fechaayer);


$sql23 = "SELECT * FROM reports WHERE user_id ='".$user_id."' order by id DESC limit 1";


// and strtotime ='".$strtotimehoy."' 

$consulta23 = mysql_query($sql23);
$numero = mysql_num_rows($consulta23);


$fetch23 = mysql_fetch_array($consulta23);

$ultimoreport = $fetch23['strtotime'];

$gananciasdeldia = $fetch23['ganancias'];

$totalearnings = $fetch23['gananciastotales'];

$payedbalance = $fetch23['pagado'];

$fecha1 = $fetch23['fecha'];

/*
pedir datos y almacenar var en:

$ganancias = campo ganancias
$a = campo a
...


*/



if($strtotimehoy==$ultimoreport){

//echo "llamo funcion";
actualizarbalance($user_id, $gananciastotales, $referedbynuevo, $nuevagananciadeldiadelref);

/*
$sql = "SELECT payedbalance,realbalance FROM mmh_user_info WHERE user_id ='".$user_id."'";

$consulta = mysql_query($sql); 

$fetch = mysql_fetch_array($consulta);

$payedbalance = $fetch['payedbalance'];

$realbalance = $fetch['realbalance'];

$totalunpaidbalance = $totalearnings - $payedbalance;

$gananciastotales = $totalearnings;


//COMIENZO REF


$sql278 =  "SELECT * FROM mmh_user_info WHERE referedby = '".$user_id."'";
$consulta278 = mysql_query($sql278);

$gananciastotalesdereferidos = 0;

while($row278 = mysql_fetch_assoc($consulta278))
{
$gananciadelreferido = ($row278['payedbalance'] + $row278['realbalance'])/10;

$gananciastotalesdereferidos = $gananciastotalesdereferidos + $gananciadelreferido;
}

$totalunpaidbalance = $totalunpaidbalance + $gananciastotalesdereferidos;

//FIN REF

if($totalunpaidbalance!=$realbalance){
$sql85 = "UPDATE mmh_user_info SET realbalance='".mysql_real_escape_string($totalunpaidbalance)."' WHERE user_id='".mysql_real_escape_string($user_id)."'";
$consulta85  = mysql_query($sql85);  


}
*/

}else{


$sql99 = "SELECT referedby,payedbalance,realbalance FROM mmh_user_info WHERE user_id ='".$user_id."'";

$consulta99 = mysql_query($sql99); 

$fetch99 = mysql_fetch_array($consulta99);

$payedbalance = $fetch99['payedbalance'];

$realbalance = $fetch99['realbalance'];

$referedbynuevo = $fetch99['referedby'];
//seleccionar el ultimo campo (el del ultimo dia q se pidio) de la tabla reports



/*

$sql23 = "SELECT * FROM reports WHERE user_id ='".$user_id."' order by id DESC limit 1";

$consulta23 = mysql_query($sql23);

$numero = mysql_num_rows($consulta23);

*/

	if($numero!=0){

	/*

	$fetch23 = mysql_fetch_array($consulta23);

	$lastdatetotime = $fetch23['strtotime'];

	*/
	
	$gananciastotales = $totalearnings;

	//obtener la fecha de ese dia

	//$fecha1 = $fetch23['fecha'];

	$fecha1 = strtotime ( '+1 day' , strtotime ( $fecha1 ) ) ;
	$fecha1 = date ( 'Y-m-j' , $fecha1 );
	
	$fecha1totime = strtotime($fecha1); //se obtiene de base de datos


	$fecha2 = $fechahoy; //se obtiene de hoy

	//$fecha1totime = strtotime($fecha1);

	$fecha2totime = strtotime($fecha2);

	
	
	/*
	$fecha1 = $_POST["fecha1"];
	$fecha2 = $_POST["fecha2"];
	*/


	$start    = new DateTime($fecha1);
	$end      = new DateTime($fecha2);
	$interval = new DateInterval('P1D');
	$period   = new DatePeriod($start, $interval, $end);

	foreach ($period as $dt)
	{
		$fecha = $dt->format("Y-m-d");

		echo $dt->format("Y-m-d"). "<br>";
		
		$a = 0;
		$b = 0;
		$c = 0;
		$d = 0;
		
		
		$fechaarray = explode("-", $fecha);
		$dia = $fechaarray[2];    
		$mes = $fechaarray[1];
		$ano = $fechaarray[0];
		
		$fechatotime = strtotime($fecha);
		//echo $fechatotime."<br>";
		
		$sql =  "SELECT * FROM contador WHERE uploadedby = '".$user_id."' AND strtotime = '".$fechatotime."'";
		$consulta = mysql_query($sql);
		while($row = mysql_fetch_assoc($consulta))
		{
		$elpais = $row['pais'];
		if($elpais=="US")
					{
						$a = $a+1;
					}
				else if($elpais=="GB")
					{
						$a = $a+1;
					}
				else if($elpais=="AU")
					{
						$a = $a+1;
					}
				else if($elpais=="NZ")
					{
						$a = $a+1;
					}
				else if($elpais=="UK")
					{
						$a = $a+1;
					}
				else if($elpais=="CA")
					{
						$a = $a+1;
					}
				else if($elpais=="IT")
					{
						$b = $b+1;
					}
				else if($elpais=="NL")
					{
						$b = $b+1;
					}		
					else if($elpais=="IR")
					{
						$b = $b+1;
					}
					else if($elpais=="AT")
					{
						$b = $b+1;
					}		
					else if($elpais=="ES")
					{
						$b = $b+1;
					}
					else if($elpais=="FR")
					{
						$b = $b+1;
					}
					else if($elpais=="FI")
					{
						$b = $b+1;
					}		
					else if($elpais=="BE")
					{
						$b = $b+1;
					}
					else if($elpais=="SZ")
					{
						$b = $b+1;
					}
					else if($elpais=="DE")
					{
						$b = $b+1;
					}
					else if($elpais=="DK")
					{
						$b = $b+1;
					}
					else if($elpais=="GR")
					{
						$b = $b+1;
					}		
					else if($elpais=="LU")
					{
						$b = $b+1;
					}
					else if($elpais=="NO")
					{
						$b = $b+1;
					}
					else if($elpais=="PT")
					{
						$b = $b+1;
					}			
					else if($elpais=="SE")
					{
						$b = $b+1;
					}
				else if($elpais=="CY")
					{
						$c = $c+1;
					}
								else if($elpais=="CZ")
					{
						$c = $c+1;
					}			else if($elpais=="EE")
					{
						$c = $c+1;
					}			else if($elpais=="IL")
					{
						$c = $c+1;
					}			else if($elpais=="HU")
					{
						$c = $c+1;
					}			else if($elpais=="JP")
					{
						$c = $c+1;
					}			else if($elpais=="LV")
					{
						$c = $c+1;
					}			else if($elpais=="LT")
					{
						$c = $c+1;
					}			else if($elpais=="RU")
					{
						$c = $c+1;
					}			else if($elpais=="PL")
					{
						$c = $c+1;
					}			else if($elpais=="SK")
					{
						$c = $c+1;
					}
				else{
						$d = $d+1;
					}
		}
		
	//YA TENEMOS A,B,C,D y ganancias del dia, ganancias por cada tier. * faltaria lo pagado y lo no pagado

	//conseguir los datos: ganancias del dia, ganancias del dia anterior, lo pagado hasta la fecha, lo total no pagado hasta la fecha, ganancias por cada tier
	//insertar esos datos en la tabla reports y continuar con el dia siguiente.


	/*
	Completar la tabla de reports desde contador,

	Recorrer el primer dia, obtener a,b,c,d multiplicar por ganancias e insertar en reports

	Pasar al siguiente dia y repetir el proceso hasta llegar a la fecha de hoy
	*/

	$visitas = $a + $b + $c + $d;
	$gananciasa = $a * 0.001;
	$gananciasb = $b * 0.0005;
	$gananciasc = $c * 0.00025;
	$gananciasd = $d * 0.00010;

	$ganancias = $gananciasa + $gananciasb + $gananciasc + $gananciasd;
	
	$gananciastotales = $gananciastotales + $ganancias;
	
	$pagado = $payedbalance;
	
	$nopagado = $gananciastotales - $pagado;
	
	$totalunpaidbalance = $nopagado;
	
	$fechatotime = $fechatotime;

	$sql18 = "INSERT INTO reports (dia, mes, ano, fecha, visitas, a, b, c, d, gananciasa, gananciasb, gananciasc, gananciasd, ganancias, gananciastotales, pagado, nopagado, user_id, strtotime) VALUES ('".$dia."', '".$mes."','".$ano."','".$fecha."','".$visitas."','".$a."','".$b."','".$c."','".$d."','".$gananciasa."','".$gananciasb."','".$gananciasc."','".$gananciasd."','".$ganancias."','".$gananciastotales."','".$pagado."','".$nopagado."','".$user_id."','".$fechatotime."')";
	$consulta18  = mysql_query($sql18);

	//ACTUALIZAR GANANCIAS PARA EL REFERIDOR:
	/*
	if($referedbynuevo>0){

	$sql2222 = "SELECT gananciasdeldia FROM reports WHERE user_id = '".$referedbynuevo."' AND strtotime = '".$fechatotime."' ";

	$consulta2222 = mysql_query($sql2222); 

	$fetch2222 = mysql_fetch_array($consulta2222);

	$ganaciasdeldiadelref = $fetch2222['gananciasdeldia'];

	$gananciasparaelref = $ganancias/10;

	$gananciaparasumaralref = $gananciaparasumaralref+$gananciasparaelref;

	$nuevagananciadeldiadelref = $ganaciasdeldiadelref + $gananciasparaelref;
	//$gananciasdeldiaderef2 = $gananciastotales;
	$sql1118 = "UPDATE reports SET gananciasdeldiaderef = '".$gananciasparaelref."', gananciastotales = '".$nuevagananciadeldiadelref."' WHERE user_id = '".$referedbynuevo."' AND strtotime = '".$fechatotime."' ";

	//echo $sql1118;
	$consulta1118  = mysql_query($sql1118);	


	//AVERIGUAR BALANCE DEL REFERIDOR DEL ULTIMO DIA
	$sql2222 = "SELECT gananciastotales FROM reports WHERE user_id = '".$referedbynuevo."' AND strtotime = '".$strtotimehoy."' ";

	$consulta2222 = mysql_query($sql2222); 

	$fetch2222 = mysql_fetch_array($consulta2222);

	$nuevasgananciastotalesdelref = $fetch2222['gananciastotales'];

	$nuevasgananciastotalesdelref = $nuevasgananciastotalesdelref + $nuevagananciadeldiadelref;
	//$gananciasdeldiaderef2 = $gananciastotales;
	$sql1118 = "UPDATE reports SET gananciastotales = '".$nuevasgananciastotalesdelref."' WHERE user_id = '".$referedbynuevo."' AND strtotime = '".$fechatotime."' ";

	//echo $sql1118;
	$consulta1118  = mysql_query($sql1118);	
	}
	*/
	//FIN DE ACTUALIZACION DE GANANCIAS PARA EL REFERIDOR

	echo "foreach1";
	echo "<br>";
	echo "Visitas del dia: ".$visitas;
	echo "<br>";
	echo "Referido por: ".$referedbynuevo;
	echo "<br>";

	}

	actualizarbalance($user_id, $gananciastotales);

//	actualizarbalance($user_id, $gananciastotales, $referedbynuevo, $nuevagananciadeldiadelref);

}else{









	$gananciastotales = 0;
	//obtener la fecha de ese dia


	$fecha1 = "2018-06-01"; //se obtiene de base de datos o se completa a partir de 2014

	$fecha1totime = strtotime($fecha1);


	$fecha2 = $fechahoy; //se obtiene de hoy

	//$fecha1totime = strtotime($fecha1);

	$fecha2totime = strtotime($fecha2);


	/*
	$fecha1 = $_POST["fecha1"];
	$fecha2 = $_POST["fecha2"];
	*/

	$start    = new DateTime($fecha1);
	$end      = new DateTime($fecha2);
	$interval = new DateInterval('P1D');
	$period   = new DatePeriod($start, $interval, $end);

	foreach ($period as $dt)
	{
		$fecha = $dt->format("Y-m-d");
		echo $dt->format("Y-m-d"). "<br>";
		
		$a = 0;
		$b = 0;
		$c = 0;
		$d = 0;

		
		$fechaarray = explode("-", $fecha);
		$dia = $fechaarray[2];    
		$mes = $fechaarray[1];
		$ano = $fechaarray[0];
		
		$fechatotime = strtotime($fecha);
		//echo $fechatotime."<br>";
		
		$sql =  "SELECT * FROM contador WHERE uploadedby = '".$user_id."' AND strtotime = '".$fechatotime."'";
		$consulta = mysql_query($sql);
		while($row = mysql_fetch_assoc($consulta))
		{
		$elpais = $row['pais'];
		if($elpais=="US")
					{
						$a = $a+1;
					}
				else if($elpais=="GB")
					{
						$a = $a+1;
					}
				else if($elpais=="AU")
					{
						$a = $a+1;
					}
				else if($elpais=="NZ")
					{
						$a = $a+1;
					}
				else if($elpais=="UK")
					{
						$a = $a+1;
					}
				else if($elpais=="CA")
					{
						$a = $a+1;
					}
				else if($elpais=="IT")
					{
						$b = $b+1;
					}
				else if($elpais=="NL")
					{
						$b = $b+1;
					}		
					else if($elpais=="IR")
					{
						$b = $b+1;
					}
					else if($elpais=="AT")
					{
						$b = $b+1;
					}		
					else if($elpais=="ES")
					{
						$b = $b+1;
					}
					else if($elpais=="FR")
					{
						$b = $b+1;
					}
					else if($elpais=="FI")
					{
						$b = $b+1;
					}		
					else if($elpais=="BE")
					{
						$b = $b+1;
					}
					else if($elpais=="SZ")
					{
						$b = $b+1;
					}
					else if($elpais=="DE")
					{
						$b = $b+1;
					}
					else if($elpais=="DK")
					{
						$b = $b+1;
					}
					else if($elpais=="GR")
					{
						$b = $b+1;
					}		
					else if($elpais=="LU")
					{
						$b = $b+1;
					}
					else if($elpais=="NO")
					{
						$b = $b+1;
					}
					else if($elpais=="PT")
					{
						$b = $b+1;
					}			
					else if($elpais=="SE")
					{
						$b = $b+1;
					}
				else if($elpais=="CY")
					{
						$c = $c+1;
					}
								else if($elpais=="CZ")
					{
						$c = $c+1;
					}			else if($elpais=="EE")
					{
						$c = $c+1;
					}			else if($elpais=="IL")
					{
						$c = $c+1;
					}			else if($elpais=="HU")
					{
						$c = $c+1;
					}			else if($elpais=="JP")
					{
						$c = $c+1;
					}			else if($elpais=="LV")
					{
						$c = $c+1;
					}			else if($elpais=="LT")
					{
						$c = $c+1;
					}			else if($elpais=="RU")
					{
						$c = $c+1;
					}			else if($elpais=="PL")
					{
						$c = $c+1;
					}			else if($elpais=="SK")
					{
						$c = $c+1;
					}
				else{
						$d = $d+1;
					}
		}
		
	//YA TENEMOS A,B,C,D y ganancias del dia, ganancias por cada tier. * faltaria lo pagado y lo no pagado

	//conseguir los datos: ganancias del dia, ganancias del dia anterior, lo pagado hasta la fecha, lo total no pagado hasta la fecha, ganancias por cada tier
	//insertar esos datos en la tabla reports y continuar con el dia siguiente.


	/*
	Completar la tabla de reports desde contador,

	Recorrer el primer dia, obtener a,b,c,d multiplicar por ganancias e insertar en reports

	Pasar al siguiente dia y repetir el proceso hasta llegar a la fecha de hoy
	*/

	$visitas = $a + $b + $c + $d;
	$gananciasa = $a * 0.001;
	$gananciasb = $b * 0.0005;
	$gananciasc = $c * 0.00025;
	$gananciasd = $d * 0.00010;

	$ganancias = $gananciasa + $gananciasb + $gananciasc + $gananciasd;
	
	
	$gananciastotales = $gananciastotales + $ganancias;
	
	$pagado = $payedbalance;
	
	$nopagado = $gananciastotales - $pagado;
	
	
	$totalunpaidbalance = $nopagado;
	
	$fechatotime = $fechatotime;

	$sql18 = "INSERT INTO reports (dia, mes, ano, fecha, visitas, a, b, c, d, gananciasa, gananciasb, gananciasc, gananciasd, ganancias, gananciastotales, pagado, nopagado, user_id, strtotime) VALUES ('".$dia."', '".$mes."','".$ano."','".$fecha."','".$visitas."','".$a."','".$b."','".$c."','".$d."','".$gananciasa."','".$gananciasb."','".$gananciasc."','".$gananciasd."','".$ganancias."','".$gananciastotales."','".$pagado."','".$nopagado."','".$user_id."','".$fechatotime."')";
	$consulta18  = mysql_query($sql18);

	/*
	//ACTUALIZAR GANANCIAS PARA EL REFERIDOR:
	if($referedbynuevo>0){

	$sql2222 = "SELECT gananciasdeldia FROM reports WHERE user_id = '".$referedbynuevo."' AND strtotime = '".$fechatotime."' ";

	$consulta2222 = mysql_query($sql2222); 

	$fetch2222 = mysql_fetch_array($consulta2222);

	$ganaciasdeldiadelref = $fetch2222['gananciasdeldia'];

	$gananciasparaelref = $ganancias/10;

	$gananciaparasumaralref = $gananciaparasumaralref+$gananciasparaelref;

	$nuevagananciadeldiadelref = $ganaciasdeldiadelref + $gananciasparaelref;
	//$gananciasdeldiaderef2 = $gananciastotales;
	$sql1118 = "UPDATE reports SET gananciasdeldiaderef = '".$gananciasparaelref."', gananciastotales = '".$nuevagananciadeldiadelref."' WHERE user_id = '".$referedbynuevo."' AND strtotime = '".$fechatotime."' ";

	//echo $sql1118;
	$consulta1118  = mysql_query($sql1118);	


	//AVERIGUAR BALANCE DEL REFERIDOR DEL ULTIMO DIA
	$sql2222 = "SELECT gananciastotales FROM reports WHERE user_id = '".$referedbynuevo."' AND strtotime = '".$strtotimehoy."' ";

	$consulta2222 = mysql_query($sql2222); 

	$fetch2222 = mysql_fetch_array($consulta2222);

	$nuevasgananciastotalesdelref = $fetch2222['gananciastotales'];

	$nuevasgananciastotalesdelref = $nuevasgananciastotalesdelref + $nuevagananciadeldiadelref;
	//$gananciasdeldiaderef2 = $gananciastotales;
	$sql1118 = "UPDATE reports SET gananciastotales = '".$nuevasgananciastotalesdelref."' WHERE user_id = '".$referedbynuevo."' AND strtotime = '".$fechatotime."' ";

	//echo $sql1118;
	$consulta1118  = mysql_query($sql1118);	
	}
	//FIN DE ACTUALIZACION DE GANANCIAS PARA EL REFERIDOR  
	*/
	echo "foreach2";
	echo "<br>";
	echo "Visitas del dia: ".$visitas;
	echo "<br>";
	echo "Referido por: ".$referedbynuevo;
	echo "<br>";
	
	}

	/*
	echo "<br>".$user_id;
	echo "<br>";
	echo "<br> fin";
	echo $gananciastotales;
	*/
//	actualizarbalance($user_id, $gananciastotales, $referedbynuevo, $nuevagananciadeldiadelref);

	actualizarbalance($user_id, $gananciastotales);

	}}

}


?>