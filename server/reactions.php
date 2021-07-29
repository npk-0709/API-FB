<?php
session_start();
$id=$_POST['ID'];
$type=$_POST['TYPE'];
$cookie=$_POST['COOKIE'];
$USERAGENT=$_POST['USERAGENT'];
print(camxuc($id,$type,$cookie,$USERAGENT));
function camxuc($id,$type,$cookie,$USERAGENT){
  $ch = curl_init();
  if(strpos($id,'_')){
    $uid = explode('_',$id, 2);
    $id2 = 'story.php?story_fbid='.$uid[1].'&id='.$uid[0];
  }else{
    $id2 = $id;
  }
  curl_setopt($ch, CURLOPT_URL, 'https://mbasic.facebook.com/'.$id2);
  $head[] = "Connection: keep-alive";
  $head[] = "Keep-Alive: 300";
  $head[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
  $head[] = "Accept-Language: en-us,en;q=0.5";
  curl_setopt($ch, CURLOPT_USERAGENT,$USERAGENT);
  curl_setopt($ch, CURLOPT_ENCODING, '');
  curl_setopt($ch, CURLOPT_COOKIE, $cookie);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
  curl_setopt($ch, CURLOPT_TIMEOUT, 60);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect
  :'));
  $page = curl_exec($ch);
  if ($id2 != $id && explode('&amp;origin_uri=',explode('amp;ft_id=',$page,2)[1],2)[0]){
    $get = explode('&amp;origin_uri=',explode('amp;ft_id=',$page,2)[1],2)[0];
  }else{
    $get = $id2;
  }
  $link = 'https://mbasic.facebook.com/reactions/picker/?is_permalink=1&ft_id='.$get;
  curl_setopt($ch, CURLOPT_URL, $link);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  $cx = curl_exec($ch);
  $haha = explode('<a href="',$cx);
  if ($type == 'LOVE'){
    $haha2 = explode('" style="display:block"',$haha[2])[0];
  }else if ($type == 'WOW'){
    $haha2 = explode('" style="display:block"',$haha[5])[0];
  }else if ($type == 'HAHA'){
    $haha2 = explode('" style="display:block"',$haha[4])[0];
  }else if ($type == 'SAD'){
    $haha2 = explode('" style="display:block"',$haha[6])[0];
  }else{
    $haha2 = explode('" style="display:block"',$haha[7])[0];
  }
  $link2 = html_entity_decode($haha2);  
  curl_setopt($ch, CURLOPT_URL, 'https://mbasic.facebook.com'.$link2);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_exec($ch);
  curl_close($ch);
}

?>
