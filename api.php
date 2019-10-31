
<?php
 header("Access-Control-Allow-Origin: *");

if (isset($_GET) && isset($_GET['ip']) && isset($_GET['port'])) 
{

	/*decodify json*/
	$function = htmlspecialchars($_POST["myData"]);
	$VARIABLE_DE_USO =0;
	if($function == 'getInfo'){
		$VARIABLE_DE_USO =1;
	}
	elseif($function == 'getSearch'){
		$VARIABLE_DE_USO =2;
	}
	elseif($function =='getChange'){
		$VARIABLE_DE_USO = 3;
	}
	else{
		$VARIABLE_DE_USO = 22222;
		
	}

	

	if($VARIABLE_DE_USO==1){
		$url = "http://".$_GET['ip'].":".$_GET['port'].'/info/';
		$data = array('id' => 'FE_BloodWolf', 'url' =>  getHostByName(getHostName()), 'date' => date('Y-m-d\TH:i:s'));
		// use key 'http' even if you send the request to https://...
		 $options = array(
	     'http' => array(
		         'header'  => "Content-type: application/json\r\n",
		        'method'  => 'POST',
		        'content' => json_encode($data)
		    )
		);
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		if ($result === FALSE) { echo "ERROR"; }
		//inser basse de datos
		echo $result;
		
		
	}
	if($VARIABLE_DE_USO==2){
		$url = "http://".$_GET['ip'].":".$_GET['port'].'/search/';
		$data = array('id' => 'FE_BloodWolf',
		 'url' =>  getHostByName(getHostName()),
		  'date' => date('Y-m-d\TH:i:s'),
		'search' => array('id_hardware' => $_POST['hw'],
							'start_date' => $_POST['initial'],
						   'finish_date' => $_POST['final']));
		// use key 'http' even if you send the request to https://...
		 $options = array(
	     'http' => array(
		         'header'  => "Content-type: application/json\r\n",
		        'method'  => 'POST',
		        'content' => json_encode($data)
		    )
		);
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		if ($result === FALSE) { echo "ERROR"; }
		//inser basse de datos
		echo $result;

	}
	if($VARIABLE_DE_USO==3){
		$url = "http://".$_GET['ip'].":".$_GET['port'].'/change/';
		$data = array("id" => "FE_BloodWolf",
		 "url" =>  getHostByName(getHostName()),
		  "date" => date('Y-m-d\TH:i:s'),
		"change" => array($_POST['hw'] => array( "status" => $_POST['stts'],
							"freq" => $_POST['frecuencia'],
						   "text" => $_POST['txt'])));

		$options = array(
	     'http' => array(
		         'header'  => "Content-type: application/json\r\n",
		        'method'  => 'POST',
		        'content' => json_encode($data)
		    )
		);	
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		if ($result === FALSE) { echo "ERROR"; }
		//inser basse de datos
		echo $result;

	}
}


?>