<?php


/**
*
* @author : Felipe Hormazabal
* 16-07-2018
* Última modificación -> Felipe Hormazabal 14-11-2018

Cardionomous + PIT:

- Pruebas con api PIT_CL inicialmente, crear crontab que guarde en la BD la respuesta

Tipo: POST con archivo (multipart/form-data), Variables a enviar: XML, sexo y edad, URL: http://34.238.82.170

Campos de entrada:
"ecgid" -> ID del ECG
"age" -> Edad del paciente
"sex" -> Sexo "m/f"
"file" -> Archivo XML-ITMS
"dest_api" -> Tipo de salida. Siempre usa "json"
"algorithm" -> Algoritmo a usar. Siempre usa " cardionomous.algorithms.machinelearning.MLForAPI.ML1NormalAbnormal"
"input" -> Parámetros extra a ingresar, en formato JSON. Dejar vacío.
	Submit a "http://34.238.82.170/".

SALIDA (JSON):
"Answer"-> Respuesta del algoritmo. Normal(0) y Anormal(1).
"Confidence"-> Confianza de la respuesta (Entre 0 y 1).
Ejemplo: {"Answer": 0, "Confidence": 0.785}

_____________________________
*****************************
- Generar Trigger o Propuesta , peticion no bloqueante de flujo, 30seg no aceptable . 
- respuesta en version del motor FOLIO_ID, Fecha de consulta y respuesta. 
- Respuesta en el WS y aplicacion WEB. 
- Validar calidad de examenes. 
- Ordenar cola de listado ECG. 
- Soportar a medico. 
- Tiempos de respuesta del servicio. 
- Verificar cambio de prioridades del listado en CLoud 2, PIT desarrollos de MM.
- Habilitar despliegue en PIT, Operador, Cardiologo
*/

include_once(getenv("DOCUMENT_ROOT")."/lib/base.inc");
include(getenv("DOCUMENT_ROOT").DIRECTORIO."/include/ecgXml.php");
//instanciacion de claces para conectarse a la base de datos y obtener xml de los examenes creados
$xml = new ecgXML(); 
$db = new Owl_DB("pit_exa"); // consulta obtiene examenes y guarda en cardionomous_temp
$db2 = new Owl_DB("pit_exa"); // insert de cardionomous
$db3 = new Owl_DB("pit_exa"); // transtelefonico
$resultados = [];
//consulta para traerse los datos necesarios para buscar el examen y consumir Api de cardionomos 
$where = " 1=1 ";//firma de FH xd

$sql = "SELECT
		IF(
			PIT_EXAMEN.TIPO_RECEPCION IS NULL,
			'transtelefonico',
			IF ( ( PIT_EXAMEN.TIPO_RECEPCION IN ( 2, 3, 5 ) ), 'mobile', 'N/A' ) 
		) AS TIPO_RECEPCION,
		PIT_INFORME.INFO_FECHARECIBIDO,
		PIT_INFORME.INFO_ID,
		PIT_INFORME.INFO_ESTADOACTUAL,
		PIT_EXAMEN.EXA_ID,
		PIT_EXAMEN.EXA_EDAD,
		IF ( PIT_EXAMEN.EXA_SEXO = 1, 2, 3 ) AS sexo,
		PIT_CARDIONOMOUS.INFO_ID AS INFO_ID_CARDIO
	FROM
	PIT_INFORME
	JOIN PIT_EXAMEN ON PIT_EXAMEN.INFO_ID = PIT_INFORME.INFO_ID
	LEFT JOIN PIT_CARDIONOMOUS_TEMP ON PIT_INFORME.INFO_ID = PIT_CARDIONOMOUS_TEMP.INFO_ID
	LEFT JOIN PIT_CARDIONOMOUS ON PIT_INFORME.INFO_ID = PIT_CARDIONOMOUS.INFO_ID
	WHERE
		PIT_CARDIONOMOUS.INFO_ID IS NULL AND
		PIT_CARDIONOMOUS_TEMP.INFO_ID IS NULL AND
		PIT_INFORME.INFO_ID > 9370175 AND
		(PIT_EXAMEN.TIPO_RECEPCION IN (2, 3, 5) OR
		PIT_EXAMEN.TIPO_RECEPCION IS NULL) AND
		PIT_INFORME.TPOE_ID = 2 AND
		PIT_INFORME.INFO_ESTADOACTUAL IN (0, 1) AND
		TIMESTAMPDIFF( MINUTE, PIT_INFORME.INFO_FECHARECIBIDO, NOW( ) ) < 10


		

	LIMIT 5
";
$db->query(trim($sql));

if ($db->num_rows > 0) {
	$sql = "INSERT INTO PIT_CARDIONOMOUS_TEMP (INFO_ID) VALUE ";
	$i = 0;
	while( $db->next_record() ){
		$resultado[$i] = [
			'tipo_recepcion'	=> $db->f('tipo_recepcion'),
			'info_fecharecibido'=> $db->f('info_fecharecibido'),
			'info_id'			=> $db->f('info_id'),
			'info_estadoactual'	=> $db->f('info_estadoactual'),
			'exa_id'			=> $db->f('exa_id'),
			'exa_edad'			=> $db->f('exa_edad'),
			'sexo'				=> $db->f('sexo'),
			'info_id_cardio'	=> $db->f('info_id_cardio')
		];

		$i++;
		$idInforme = $db->f('info_id');
		if($db->num_rows == $i){
			$sql .= "($idInforme)";
		} else {
			$sql .= "($idInforme),";
		}
	}
	$db->free();
	$db->query(trim($sql));

	for ($i=0; $i < count($resultado) ; $i++) {
		
		$tipo_recepcion 	= $resultado[$i]['tipo_recepcion'];
		$info_fecharecibido = $resultado[$i]['info_fecharecibido'];
		$info_id 			= $resultado[$i]['info_id'];
		$info_estadoactual  = $resultado[$i]['info_estadoactual'];
		$exa_id 			= $resultado[$i]['exa_id'];
		$exa_edad  			= $resultado[$i]['exa_edad'];
		$sexo 				= $resultado[$i]['sexo'];
		$info_id_cardio 	= $resultado[$i]['info_id_cardio'];

		echo 'INFO_ID = ' . $info_id.'<br>';
		echo 'EXA_ID = ' . $exa_id.'<br>';
		echo $tipo_recepcion.'<br>';

		$infoId = $info_id;

		$tipo_recepcion = $tipo_recepcion;
		
		$exaId = $exa_id;
		
		if ( $tipo_recepcion == 'mobile' ){

			//obtengo archivo y creo arreglo para consumir Api
			$name = $xml->readFromDatabase($exa_id);
			$der_data = $xml->readXml($name);
			$filepath = HOME."/ecg/temp/xml/".substr($name, 0, strlen($name) - 4);
			$filename = substr($name, 9, - 4);
			if ( $name == "" ){ echo "sin nombre ->" . $info_id ; die(); }
			$file = new CurlFile( $filepath, 'xml', $filename );

		} else {

			// TRANSTELEFONICO
			$cadenaDerivadas = "";
			$sqlPrueba = "SELECT TPOP_ID, VAL1, VAL2, VAL3 FROM PIT_PRUEBA WHERE EXA_ID = " . $exa_id ." order by TPOP_ID ASC ";
			$db3->query(trim($sqlPrueba));
			if ($db3->num_rows > 0) 
			{
				$cadenaDerivadas = "[";
 				while( $db3->next_record() ) {
 					switch ($db3->f('tpop_id')) {
 						case 1: $cadenaDerivadas .= "'".$db3->f('val1')."',\n"; break;
 						case 2: $cadenaDerivadas .= "'".$db3->f('val1')."',\n"; break;
 						case 3: $cadenaDerivadas .= "'".$db3->f('val1')."',\n"; break;
 						case 4: $cadenaDerivadas .= "'".$db3->f('val1')."',\n"; break;
 						case 5: $cadenaDerivadas .= "'".$db3->f('val1')."',\n"; break;
 						case 6: $cadenaDerivadas .= "'".$db3->f('val1')."',\n"; break;
 						case 7: $cadenaDerivadas .= "'".$db3->f('val1')."',\n"; break;
 						case 8: $cadenaDerivadas .= "'".$db3->f('val1')."',\n"; break;
 						case 9: $cadenaDerivadas .= "'".$db3->f('val1')."',\n"; break;
 						case 10: $cadenaDerivadas .= "'".$db3->f('val1')."',\n"; break;
 						case 11: $cadenaDerivadas .= "'".$db3->f('val1')."',\n"; break;
 						case 12: $cadenaDerivadas .= "'".$db3->f('val1')."',\n"; break;
 						case 13: $cadenaDerivadas .= "'".$db3->f('val1').$db3->f('val2').$db3->f('val3')."']"; break;
 					}
				}
				$file = str_replace("'", '"', $cadenaDerivadas);
				// DEBO CREAR ARCHIVO .JSON PARA ENVIAR A CARDIONOMOUS
				$pagename = $infoId;
				$newFileName = './temp/'.$pagename.".json";
				$newFileContent = $file;

				if (file_put_contents($newFileName, $newFileContent) !== false) {
				    echo "File created (" . basename($newFileName) . ")";
				} else {
				    echo "Cannot create file (" . basename($newFileName) . ")";
				}
				$file = new CurlFile($newFileName, 'json');
			}
		}

		$data = array(
			'source_by_file_backup' => $file,
			'source_by_file_algorithm' => 2,
			'source_by_file_sex' => $sexo,
			'source_by_file_age' => $exa_edad
		);
        
		/*
		*curl -L -F "source_by_file_age=79" -F "source_by_file_sex=2" -F "source_by_file_algorithm=2" -F "source_by_file_backup=@/home/szekely/Downloads/EXA_ID_7153711.xml" http://34.197.231.37/main-menu/data-source/by-file/
		*/
		// print_r('http://34.197.231.37/main-menu/data-source/by-file/result/?source_by_file_age='.$db->f("exa_edad").'&source_by_file_sex='.$db->f("sexo").'&source_by_file_backup='.$file);
		//paso parametros a la api de cardionomous usando cURL y el resultado lo guardo en $respuestaCardionomos y lo convierto en objeto
		echo "Inicio<br>";

		//$ch = curl_init('http://34.197.231.37/main-menu/data-source/by-file/');//maquina de qa
		// $ch = curl_init( 'http://52.91.167.245:7778/main-menu/data-source/by-file/');//maquina nueva de qa cardionomous
		// $ch = curl_init('http://35.171.160.82/main-menu/data-source/by-file/'); // -> 28-12-2018 maquina de prod
		$ch = curl_init( 'http://3.210.252.42/main-menu/data-source/by-file/');//maquina nueva de qa cardionomous

		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);		
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		
		$respuestaCardionomos = curl_exec($ch);
		$informacionDelCurl = curl_getinfo($ch);

		echo curl_error($ch);
		curl_close($ch);
		unlink($newFileName);

		$JCardio = json_decode($respuestaCardionomos);

		if ( $respuestaCardionomos && $informacionDelCurl['total_time'] > 0.5 ) {
			//variables separadas para insertar en cardionomous 
			//Version
			foreach ($JCardio as $key => $value) { $key == 'cdn-version' ? $version = $value : ''; }
			//modelos
			$deterministic_normal = ($JCardio->output->deterministic_normal == true ) ? 1 : 0;
			
			$modelNormal = $JCardio->output->model_normal_abnormal->normal;
			$confidenceNormal = $JCardio->output->model_normal_abnormal->confidence;
			$modelStemi = $JCardio->output->model_stemi->stemi;
			$confidenceStemi = $JCardio->output->model_stemi->confidence;
			//puntos
			$puntosCardionomous = addslashes(json_encode($JCardio->output->points));
			$dictionaryCardionomous = addslashes(json_encode($JCardio->output->points->features->dictionary));
			$puntosCardionomous2 = $JCardio->output->points->features;
			//imagenes
			$imagenXY = $JCardio->output->vcg->vcg_plots->xy;
			$imagenXZ = $JCardio->output->vcg->vcg_plots->xz;
			$imagenYZ = $JCardio->output->vcg->vcg_plots->yz;
			//ruido
			$fibrilacion      	   = $JCardio->output->detected_noises->Fibrillation->Status;
			$derivadasFibriladas   = addslashes(json_encode($JCardio->output->detected_noises->Fibrillation->Affected_Lead));
			$lineaPlana  		   = $JCardio->output->detected_noises->Flat_Line->Status;
			$derivadasPlanas	   = addslashes(json_encode($JCardio->output->detected_noises->Flat_Line->Affected_Lead));
			$movimientoEnArtefacto = $JCardio->output->detected_noises->Movement_Artifact->Status;
			$derivadasMovidas	   = addslashes(json_encode($JCardio->output->detected_noises->Movement_Artifact->Affected_Lead));
			$electrodoMalColocado  = $JCardio->output->detected_noises->Misplacement->Status;
			$derivadasElectrodo	   = addslashes(json_encode($JCardio->output->detected_noises->Misplacement->Type));

			$estado = 1;
			$observacion  = "";
			
			/**
			 *	REGLA DE NEGOCIO
			 *  PARA INFORMAR EN UN CLICK MOBILE = ( MODEL_NORMAL = 1; DETERMINISTICO_NORMAL = 1; CONFIDENCE_NORMAL > 80 )
			 *  PARA INFORMAR EN UN CLICK TRANSTELFONICO = ( MODEL_NORMAL = 1; DETERMINISTICO_NORMAL = 1; CONFIDENCE_NORMAL > 80 )
			 */
			if ( ($confidenceNormal == "" || $confidenceStemi == "") && $tipo_recepcion == 'mobile' ){
				$estado = 0;
				$observacion  = "Falta Informacion" . $JCardio->output->model_normal_abnormal->confidence . ' - ' . $confidenceStemi ;
			} else if ( ($confidenceNormal == "" ) && $tipo_recepcion == 'transtelefonico' ){
				$estado = 0;
				$observacion  = "Falta Informacion" . $JCardio->output->model_normal_abnormal->confidence . ' - ' . $confidenceStemi ;
			}
			
			$sql = "
			INSERT INTO PIT_CARDIONOMOUS(
				INFO_ID,
				EXA_ID,
				ALGORIMO,
				VERSION_ARGORITMO,
				MODEL_NORMAL,
				CONFIDENCE_NORMAL,
				MODEL_STEMI,
				CONFIDENCE_STEMI,
				PUNTOS,
				DICCIONARIO,
				IMAGEN_XY,
				IMAGEN_XZ,
				IMAGEN_YZ,
				ESTADO,
				TIEMPO_RESPUESTA, 
				OBSERVACION,
				TIPO_RECEPCION, 
				FECHA_CONSULTA,
				DETERMINISTICO_NORMAL,
				FIBRILACION,
				DERIVADAS_FIBRILADAS,
				LINEA_PLANA,
				DERIVADAS_PLANAS,
				MOVIMIENTO_ARTEFACTO,
				DERIVADAS_MOVIMIENTO,
				ELECTRODO_MAL_COLOCADO,
				DERIVADAS_ELECTRODO
			) VALUES (
				$infoId,
				$exaId,
				2,
				'$version',
				'$modelNormal', 
				'$confidenceNormal', 
				'$modelStemi', 
				'$confidenceStemi',
				'".$puntosCardionomous."',
				'".$dictionaryCardionomous."',
				'$imagenXY',
				'$imagenXZ',
				'$imagenYZ',
				$estado, 
				'".$informacionDelCurl['total_time']."',
				'$observacion', 
				'$tipo_recepcion', 
				now(), 
				$deterministic_normal,
				'$fibrilacion',
				'".$derivadasFibriladas."',
				'$lineaPlana',
				'".$derivadasPlanas."',
				'$movimientoEnArtefacto',
				'".$derivadasMovidas."',
				'$electrodoMalColocado',
				'".$derivadasElectrodo."' 
			)";

			echo "<script type=text/javascript>console.log($respuestaCardionomos);</script>";
			$db2->query($sql); 	
			$sql = "DELETE FROM PIT_CARDIONOMOUS_TEMP WHERE INFO_ID = $infoId";
			$db->free();
			$db->query(trim($sql));

		} else {
			echo "<br>no llego respuesta de cardionomous";
			$sql = "DELETE FROM PIT_CARDIONOMOUS_TEMP WHERE INFO_ID = $infoId";
			$db->free();
			$db->query(trim($sql));
			
			$Moti = "Consulta CARDIONOMUS retorna valores nulos";
			$sql= "INSERT INTO pit_sucesos (suc_desc, info_id,suc_usu) VALUES ('$Moti', $infoId,'".$_SESSION['idUsuario']."')";
			$db->free();
			$db->query(trim($sql));

		}
		echo "<br>OK";
	}
	echo "<br>fin iteracion";
}