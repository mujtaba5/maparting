<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */

	public function __construct() {
		
		parent::__construct();	
		$this->load->helper('url');
		// $this->load->library('phpmailer');


	}

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function mapGenerator(){
	
		$this->load->view('googleMap');

	}

	public function convertGpxFileToGeoJson(){
		$allCoordinates = array();

		if ($_FILES['file']['name']) {
			$inputFileName 	= $_FILES['file']['name'];
			$inputFileData 	= $_FILES['file']['tmp_name'];
			$inputFileType 	= $_FILES['file']['type'];
			$inputFileSize 	= $_FILES['file']['size'];
			$geojson = array('type' => 'FeatureCollection', 'features' => array());
			
			// $fileCon=file_get_contents($inputFileData);
			$gpx = simplexml_load_file($inputFileData); 
			// $gpx = simplexml_load_file($inputFileName); 
			$allCoordinates = array();

			// $gpx = simplexml_load_file($inputFileName);
			foreach ($gpx->trk as $trk) {
				foreach($trk->trkseg as $seg){
					foreach($seg->trkpt as $pt){		
						array_push($allCoordinates, [
							trim(str_replace('\r\n','',$pt->attributes()['lon'].PHP_EOL)),
						trim(str_replace('\r\n','',$pt->attributes()['lat'].PHP_EOL))]);
					}
				}
			}

			$data = array(
                'type' => 'Feature',
                'properties'=> [],
                'geometry' =>  array( 'type' => 'LineString',
            			  'coordinates'=>$allCoordinates)
			);
            
			unset($gpx);		
			// echo '</pre>'
		}
		echo json_encode(array('coordinates'=>$allCoordinates)); 

	}
	
	
	public function getPlaceByCoordinates(){
		// $allCoordinates = array();
		
		if($_POST['latitude'] && $_POST['longitude']){
			$longitude =$_POST['longitude'];
			$latitude =$_POST['latitude'];
			$access_token =$_POST['access_token'];
			
			$url              = 'https://api.mapbox.com/geocoding/v5/mapbox.places/'.$longitude.','.$latitude.'.json?'.
			'&access_token='.$access_token;
			// echo $url;
			$data             = json_decode(getUrlContent($url),true); // Calling From Application Helper
	    	$convertedLatLong = $this->convertLatLongToDMS($longitude,$latitude);
			$contextArray	  = [];

			if($data['features']){
				$locationName     = $data['features'][0]['text'];
				$place            = $data['features'][0]['place_name'];
				if($data['features'][0]){
					$contextArray     = $data['features'][0]['context'];
				}
			}
				 
			echo json_encode(array('result'=>$contextArray,
				 						'success'=>true,
										'convertedLatLong' =>$convertedLatLong
									)); 

			// $this->sendEmailTest();


			die();
		}else{
			echo json_encode(array('error'=>true)); 
		}

	}

	public function sendEmailTest(){
		$to      = 'aqsatahir63@yahoo.com';
		$subject = 'the subject';
		$message = 'hello';
		$headers = 'From: aqsa@example.com' . "\r\n" .
			'Reply-To: aqsatahir63@yahoo.com' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();

		$res=mail($to, $subject, $message, $headers);
		print_r($res);
		die();
	}


	public function sendPosterEmail(){
		
		$from    = FROM_EMAIL;
                    $to      = ADMIN_EMAIL;
                    $subject = 'Map Editor Sample';
                    $message = 'Hi you have used map editor on ' 
					. date('Y-m-d H:i:s').' .Your sample poster is shown in the link below. <a href="#">Click here</a>';
                    emailSend($from, $to, $subject, $cc=NULL, $message, $replyto = NULL);
                    echo '<br>'.$message;
                    return true;
	}


	public function convertLatLongToDMS($longitude,$latitude)
	{
		if($longitude && $latitude){
			$latitudeDirection = $latitude < 0 ? 'S': 'N';
			$longitudeDirection = $longitude < 0 ? 'W': 'E';

			$latitudeNotation = $latitude < 0 ? '': '';
			$longitudeNotation = $longitude < 0 ? '': '';

			$_precision = 1;


			$vars = explode(".",$longitude);
			$deg = $vars[0].'<span>&#176;</span>';
			$tempma = "0.".$vars[1];
		
			$tempma = $tempma * 3600;
			$min = floor($tempma / 60);
			$sec = round($tempma - ($min*60),$_precision);
		
			$vars = explode(".",$latitude);
			$deg2 = $vars[0].'<span>&#176;</span>';
			$tempma = "0.".$vars[1];
		
			$tempma = $tempma * 3600;
			$min2 = floor($tempma / 60);
			$sec2 = round($tempma - ($min*60),$_precision);
		

			// $convertedLong = $longitudeDirection.' '.$longitudeNotation.''.$deg.' '.$min."' ".$sec.'"';
			// $convertedLat = $latitudeDirection.' '.$latitudeNotation.''.$deg2.' '.$min2."' ".$sec2.'"';
			$convertedLong = $longitudeNotation.''.$deg.' '.'<span>:</span>'.$min."' ".$sec;
			$convertedLat =  $latitudeNotation.''.$deg2.' '.'<span>:</span>'.$min2."' ".$sec2;
			return array('convertedLat'=>$convertedLat,'convertedLong'=>$convertedLong);
		}else{
			return array('convertedLat'=>'','convertedLong'=>'');
		}
	}

	

	public function mapGenerator1(){
		$data['track'] ='run';
		$this->load->view('doc',$data);

	}
}
