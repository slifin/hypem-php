<?php
require 'lib/base.php';
require 'simple_html_dom.php';
error_reporting(0);

$url = 'http://hypem.com/popular/1?ax=1&ts='.urlencode(time());
$result = Web::instance()->request($url);
$cookie = $result['headers'][6];
$cookie = explode('Set-Cookie:', $cookie);

$html = file_get_html($url);
$elem =$html->find('#displayList-data')[0];

$json = json_decode($elem->innertext);
$tracks = $json->tracks;

foreach($tracks as $key=>$track){
	$cookie[1]; #AUTH=03%3Abe97c64a93b915df6d686acf3d04798b%3A1378228606%3A1467159916%3AH9-GB; expires=Thu, 30-Aug-2029 17:16:46 GMT; path=/; domain=hypem.com
	$jsonURL = 'http://hypem.com/serve/source/'.$track->id.'/'.$track->key;
	echo $jsonURL;
	die;
	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_URL=> $jsonURL,
		CURLOPT_COOKIE=>$cookie[1],
		CURLOPT_HTTPHEADER=>array('Content-type: application/json'),
		CURLOPT_USERAGENT=> 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.62 Safari/537.36'
		));
	$result = curl_exec($curl);
	 echo $result;
	die;
	$opts=array(
		'header'  => array('Content-type:application/json','Cookie: '.urlencode($cookie[1]))
		);
	$result = Web::instance()->request($jsonURL,$opts);
	var_dump($result);
	die;
}
?>