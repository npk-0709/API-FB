<?php
session_start();
$access_token=$_POST['ACCESS_TOKEN'];
$idcmt=$_POST['ID'];
$cookie=$_POST['COOKIE'];
$USERAGENT=$_POST['USERAGENT'];
$msg=$_POST['MSG'];
echo cmt($access_token,$idcmt,$cookie,$msg,$USERAGENT);

function cmt($access_token,$idcmt,$cookie,$msg,$USERAGENT){
  $ch=curl_init();
  curl_setopt($ch, CURLOPT_URL, 'https://graph.facebook.com/'.$idcmt.'/comments');
  $head[] = "Connection: keep-alive";
  $head[] = "Keep-Alive: 300";
  $head[] = "authority: m.facebook.com";
  $head[] = "ccept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
  $head[] = "accept-language: vi-VN,vi;q=0.9,fr-FR;q=0.8,fr;q=0.7,en-US;q=0.6,en;q=0.5";
  $head[] = "cache-control: max-age=0";
  $head[] = "upgrade-insecure-requests: 1";
  $head[] = "accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9";
  $head[] = "sec-fetch-site: none";
  $head[] = "sec-fetch-mode: navigate";
  $head[] = "sec-fetch-user: ?1";
  $head[] = "sec-fetch-dest: document";
  curl_setopt($ch, CURLOPT_USERAGENT, $USERAGENT);
  curl_setopt($ch, CURLOPT_ENCODING, '');
  curl_setopt($ch, CURLOPT_COOKIE, $cookie);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
  curl_setopt($ch, CURLOPT_TIMEOUT, 60);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
  $data = array('message' => $msg,'access_token' => $access_token);
  curl_setopt($ch, CURLOPT_POST,count($data));
  curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
  $access = curl_exec($ch);
  curl_close($ch);
  return json_decode($access);
}
?>
