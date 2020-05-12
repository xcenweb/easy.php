<?php 
/**
 * easy.php
 * @version:1.0
 * @datetime:2020/05/09 08:12
 * @website:http://www.xcen.xyz/easyphp/
 */

       function siftdata($input,$start,$end){
           /**
            * 过滤函数
            * @version:1.0
            */
	    $subster = substr($input,strlen($start)+strpos($input, $start),(strlen($input)-strpos($input,      $end))*(-1));
	    echo $subster;
       }
       
       function get_ip(){
           /**
            * 获取ip函数
            * @version:1.0
            */
           if(!empty($_SERVER['HTTP_X_FORWARD_FOR'])){
               return $_SERVER['HTTP_X_FORWARD_FOR'];
           }
               return $_SERVER['REMOTE_ADDR'];
       }
       
       function ep_getimg_info($imgfile,$act){
            /**
            * 获取图片信息
            * @version:1.0
            */
            $img_info = getimagesize($imgfile);
            list($width, $height, $type, $bits,$mime) = $imginfo;
            if($act == "array"){
                return $img_info;
            }
            if($act == "width"){
                return  $width;
            }
            if($act == "height"){
                return  $height;
            }
       }
       
       function getip_city($ip){
           /**
            * 根据ip获取位置
            * @version:1.0
            */
           $url = 'http://whois.pconline.com.cn/ipJson.jsp?json=true&ip=';
           $city = curl_get($url . $ip);
	       $city = mb_convert_encoding($city, "UTF-8", "GB2312");
           $city = json_decode($city, true);
           if ($city['city']) {
               $location = $city['pro'].$city['city'];
           } else {
               $location = $city['pro'];
           }
	       if($location){
		       return $location;
	       }else{
		       return false;
	       }
       }
       
       function ep_getline($file, $line, $length = 4096){
           /**
            * 获取文件指定行
            * @version:1.0
            */
           $returnTxt = null; // 初始化返回
           $i = 1; // 行数
           $handle = @fopen($file, "r");
           if ($handle) {
               while (!feof($handle)) {
               $buffer = fgets($handle, $length);
               if($line == $i) $returnTxt = $buffer;
               $i++;
               }
           fclose($handle);
           }
           return $returnTxt;
       }
       
       function random_data($file){
           /**
            * 文件内容随机输出
            * @version:2.1
            */
           if(is_file($file)){
               return false;
           }
           $data = file_get_contents($file);
           $data = explode(PHP_EOL, $data);
           $result = $data[array_rand($data)];
           $result = str_replace(array("\r","\n","\r\n"), '', $result);
           return $result;
       }
       
       function ep_ifhave_str($data,$needfind){
           /**
            * 是否包含某字符
            * @version:2.0
            */
           if(strpos($data,$needfind) !== false){ 
               return true;
           }else{
               return false;
           }
       }
       
       function ep_ifis_language($data,$act){
           /**
            * 是否包含某种东西 小问号?
            * @version:3.0
            */
           if($act == "chinese?"){
               if(preg_match("/[\x7f-\xff]/", $data)) {  //判断字符串中是否有中文
                   return false;
               }else{
                   return true;
               }
           }
           if($act == "allchinese?"){
               if(preg_match("/^[\x7f-\xff]+$/", $data)){
                   return false;
               }else{
                   return true;
               }
           }
           if($act == "numeric?"){
               if(is_numeric($data)){
                   return false;
               }else{
                   return true;
               }
           }
       }