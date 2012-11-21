<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//source du code = RAPH +  http://www.maxence-blog.fr/2011/04/29/reduire-des-url-a-partir-de-son-site-avec-api-bit-ly/
//voir http://codeigniter.com/user_guide/libraries/config.html


	class Bitly { 

		function shorten($url_tobeshortened=null,$version='v3',$format='json'){
			$CI =& get_instance();

			//methode avec creation d'un fichier bitly séparé dans config (plusieurs items représenté)
			$CI->config->load('bitly',TRUE); 
			$bitly=$CI->config->item('bitly');

			//on definit les parametres
			if(isset ($url_tobeshortened)){ 		//si on part du principe qu'on est déjà sur la page du book et qu'on veut juste copier le lien
				$url_tobeshortened=urlencode($url_tobeshortened);
			}
			
			//on définit l'adresse url avec ses parametres
			$bitly_request="http://api.bitly.com/$version/shorten?login=" . $bitly['bitly_ID'] . '&apiKey=' . $bitly['bitly_username'] . '&longUrl=' . $url_tobeshortened . "&format=" . $format;

			//on recupere une nouvelle adresse à partir des données jason
			$bitly_link = file_get_contents($bitly_request);
            
			if($format == 'json') {
				//Méthode décodage Jason
				$json = json_decode($bitly_link, true);
				$short_url=$json['data']['url'] ;
				return $short_url;
			} else {
				// Méthode XML (facultatif)
				$xml = simplexml_load_string($bitly_link);
				$short_url='http://bit.ly/' . $xml->results->nodeKeyVal->hash;
				return $short_url;
			}


		}


	}