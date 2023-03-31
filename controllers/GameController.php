<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use DOMDocument;
 

class GameController extends Controller
{
	
	 /**
     * Displays about page.
     *
     * @return string
     */
    public function actionResults()
    {
        // Note I extracted this url form main site from <iIframe> tag
		$uri = "https://bepick.net/game/default/speedkenoladder";
		
		$general_content_information1= $this->get_general_content($uri);
		$general_content1= $general_content_information1['content'];
		
		$html = new DOMDocument();
		libxml_use_internal_errors(true);
		@$html->loadHTML('<?xml encoding="UTF-8">' . @$general_content1);
		libxml_use_internal_errors(false);
		
		// Get all elements with class 'dt_list_box bd_all'
		$elements = $html->getElementsByTagName('div');
		foreach ($elements as $element) {
		  if ($element->getAttribute('class') == 'dt_list_box bd_all') {
			// Print the HTML code of the element
			 $result = $html->saveHTML($element);
		  }
		}
			// $result will contain the response from the API in JSON format
			// You can then decode it and pass it to the view
		//	$data = json_decode($result, true);
		
			return $this->render('results', ['data' => $result]);
	}
	
	
	public function get_general_content($url){
		$ch = curl_init(); // initialize curl handle
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible;)");
		curl_setopt($ch, CURLOPT_AUTOREFERER, false);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($ch, CURLOPT_REFERER, 'http://'.$url);
		curl_setopt($ch, CURLOPT_URL, $url); // set url to post to
		curl_setopt($ch, CURLOPT_FAILONERROR, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);// allow redirects
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // return into a variable
		curl_setopt($ch, CURLOPT_TIMEOUT, 50); // times out after 50s
		curl_setopt($ch, CURLOPT_POST, 0); // set POST method
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	   // curl_setopt($ch, CURLOPT_COOKIEJAR, "my_cookies.txt");
	   // curl_setopt($ch, CURLOPT_COOKIEFILE, "my_cookies.txt");
		
		$content = curl_exec($ch); // run the whole process
		$curl_info= curl_getinfo($ch);
		curl_close($ch);
		$response['content']=$content;
		$response['curl_info']=$curl_info;
		
		return $response;
	}

	
}
