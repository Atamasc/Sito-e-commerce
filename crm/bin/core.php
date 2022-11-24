<?php 
	//Codice recupero pagina corrente
	function getCurrentPage() {
		$current_url = $_SERVER['PHP_SELF']; 
		$current_url_elements = explode("/", $current_url);
		$result_element_number = count($current_url_elements);
		$last_element_position = $result_element_number - 1;
		$current_page = $current_url_elements[$last_element_position];
		
		$getCurrentPage = $current_page;
		return $getCurrentPage;
	};	
	
	//Codice recupero pagina referer
	function getRefererPage() {
		$referer_url = $_SERVER['HTTP_REFERER']; 
		$referer_url = parse_url($referer_url, PHP_URL_HOST);
		$referer_url_elements = explode("/", $referer_url);
		$result_element_number = count($referer_url_elements);
		$last_element_position = $result_element_number - 1;
		$referer_page = $referer_url_elements[$last_element_position];
		
		$getRefererPage = $referer_page;
		return $getRefererPage;
	};	
	
	//Recupero giorno dalla data formato gg/mm/aaaa
	function getGiornoFromDate($dateFormat){
		if ((strlen($dateFormat)) > 1) {
			$dateFormat = explode("/",$dateFormat);
			$getGiornoFromDate = $dateFormat[0];
		} else {
			$getGiornoFromDate = 0;
		}
	
		return $getGiornoFromDate;
	}
	//Recupero mese dalla data formato gg/mm/aaaa
	function getMeseFromDate($dateFormat){
		if ((strlen($dateFormat)) > 1) {
			$dateFormat = explode("/",$dateFormat);
			$getMeseFromDate = $dateFormat[1];
		} else {
			$getMeseFromDate = 0;
		}
	
		return $getMeseFromDate;
	}
	//Recupero anno dalla data formato gg/mm/aaaa
	function getAnnoFromDate($dateFormat){
		if ((strlen($dateFormat)) > 1) {
			$dateFormat = explode("/",$dateFormat);
			$getAnnoFromDate = $dateFormat[2];
		} else {
			$getAnnoFromDate = 0;
		}
	
		return $getAnnoFromDate;
	}
	
	//Recupero ora da orario formato hh/mm/ss
	function getOraFromOrario($timeFormat){
		if ((strlen($timeFormat)) > 1) {
			$timeFormat = explode(":",$timeFormat);
			$getOraFromOrario = $timeFormat[0];
		} else {
			$getOraFromOrario = 0;
		}
	
		return $getOraFromOrario;
	}
	
	//Recupero minuto da orario formato hh/mm/ss
	function getMinutoFromOrario($timeFormat){
		if ((strlen($timeFormat)) > 1) {
			$timeFormat = explode(":",$timeFormat);
			$getMinutoFromOrario = $timeFormat[1];
		} else {
			$getMinutoFromOrario = 0;
		}
	
		return $getMinutoFromOrario;
	}
	
	//Recupero secondo da orario formato hh/mm/ss
	function getSecondoFromOrario($timeFormat){
		if ((strlen($timeFormat)) > 1) {
			$timeFormat = explode(":",$timeFormat);
			$getSecondoFromOrario = $timeFormat[2];
		} else {
			$getSecondoFromOrario = 0;
		}
	
		return $getSecondoFromOrario;
	}
	
	//Codice gestione utenti on-line
	function getUserOnLine($dbConn) {
		$timeoutseconds = 600; 
		$timestamp = time();  
		$timeout = $timestamp-$timeoutseconds;
		$ip = $_SERVER['REMOTE_ADDR'];
		
		//Cancellazione utenti dopo il tempo stabilito
		$querySql = "DELETE FROM counter_stats WHERE timestamp < ".$timeout."";
		$result = $dbConn->query($querySql);
		$rows_delete = $dbConn->affected_rows;
		
		//Controllo esistenza ip nel database utenti
		$querySql = "SELECT * FROM counter_stats WHERE ip = '".$ip."'";
		$result = $dbConn->query($querySql);
		$check_ip_row = $dbConn->affected_rows;
		
		if ($check_ip_row == 0) {
			//Aggiunta utente al database
			$querySql = "INSERT INTO counter_stats (timestamp, ip) VALUES ('".$timestamp."','".$ip."')";
			$result = $dbConn->query($querySql);
			$rows_insert = $dbConn->affected_rows;
		};
		
		//Recupero numero utenti on-line
		$querySql = "SELECT DISTINCT ip FROM counter_stats";
		$result = $dbConn->query($querySql);
		$userOnLine = $dbConn->affected_rows;
											
		$result->close(); 
		
		$getUserOnLine = $userOnLine;
		return $getUserOnLine;
	};
	
	//Funzione per generare un seriale univoco per identificare file o immagini
	function generateUniqueSerialByDateTime() {
		$year = date("Y");
		$month = date("m");
		$day = date("d");
		$hour = date("H");
		$minutes = date("i");
		$seconds = date("s");
		
		$generateUniqueSerialByDateTime = $year.$month.$day.$hour.$minutes.$seconds;
		return $generateUniqueSerialByDateTime;
	};

	function getTimestampByDate($data)
	{
        if (strlen($data) > 0 ) {
            $data_giorno = getGiornoFromDate($data);
            $data_mese = getMeseFromDate($data);
            $data_anno = getAnnoFromDate($data);
            $timestamp = mktime(0, 0, 0, $data_mese, $data_giorno, $data_anno);
        } else {
            $timestamp = 0;
        }
        return $timestamp;
	}
?>
