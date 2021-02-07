<?php

$user_agent     =   $_SERVER['HTTP_USER_AGENT'];
// Получаем название ОС
function getOS() { 

    global $user_agent;

    $os_platform  = "Unknown OS Platform";

    $os_array     = array(
                          '/windows nt 10/i'      =>  'Windows 10',
                          '/windows nt 6.3/i'     =>  'Windows 8.1',
                          '/windows nt 6.2/i'     =>  'Windows 8',
                          '/windows nt 6.1/i'     =>  'Windows 7',
                          '/windows nt 6.0/i'     =>  'Windows Vista',
                          '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                          '/windows nt 5.1/i'     =>  'Windows XP',
                          '/windows xp/i'         =>  'Windows XP',
                          '/windows nt 5.0/i'     =>  'Windows 2000',
                          '/windows me/i'         =>  'Windows ME',
                          '/win98/i'              =>  'Windows 98',
                          '/win95/i'              =>  'Windows 95',
                          '/win16/i'              =>  'Windows 3.11',
                          '/macintosh|mac os x/i' =>  'Mac OS X',
                          '/mac_powerpc/i'        =>  'Mac OS 9',
                          '/linux/i'              =>  'Linux',
                          '/ubuntu/i'             =>  'Ubuntu',
                          '/iphone/i'             =>  'iPhone',
                          '/ipod/i'               =>  'iPod',
                          '/ipad/i'               =>  'iPad',
                          '/android/i'            =>  'Android',
                          '/blackberry/i'         =>  'BlackBerry',
                          '/webos/i'              =>  'Mobile'
                    );

    foreach ($os_array as $regex => $value)
        if (preg_match($regex, $user_agent))
            $os_platform = $value;

    return $os_platform;
}

function getBrowser() {

    global $user_agent;

    $browser        = "Unknown Browser";

    $browser_array = array(
                            '/msie/i'      => 'Internet Explorer',
                            '/firefox/i'   => 'Firefox',
                            '/safari/i'    => 'Safari',
                            '/chrome/i'    => 'Chrome',
                            '/edge/i'      => 'Edge',
                            '/opera/i'     => 'Opera',
                            '/netscape/i'  => 'Netscape',
                            '/maxthon/i'   => 'Maxthon',
                            '/konqueror/i' => 'Konqueror',
                            '/mobile/i'    => 'Handheld Browser'
                     );

    foreach ($browser_array as $regex => $value)
        if (preg_match($regex, $user_agent))
            $browser = $value;

    return $browser;
}


$user_os        =   getOS();
$user_browser   =   getBrowser();
$ip1 = $_SERVER['REMOTE_ADDR'];
$ipapi = json_decode(file_get_contents("http://ip-api.com/json/{$ip1}"));


// Получаем ip посетителя
$ip = $_SERVER['REMOTE_ADDR'];
// Получаем инфу откуда перешел
$site_refer = $_SERVER['HTTP_REFERER'];
    if($site_refer == ""){
        $site = "dirrect connection";
    }
    else{
        $site = $site_refer;
    }
  // Hide ownr's IP address
    $absdfs5sd4 = "HIDE THIS IP ADDRESS";//Ваш ip
    $owner_country = "YOUR COUNTRY TAG FOR YOUR IP ↑"; //Это можете не менять
  
    if($ip == $absdfs5sd4){
        $ip = "Owner"; 
        $country = $owner_country;
    }
  //Инфа о стране
    else{
        $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}"));
        $country = $details->country;
    }
    // Отправка данных.
 $token = "1583804831:AAGxLf56tthjYVbzS9tWQHpHDDL49TPJ7o0"; //Токен бота с @BotFather
 $chat_id = "1033324188";// Ваш chat id
 $txt = urlencode("Внимание!\nIP:{$ip}\nПровайдер: $ipapi->isp ($ipapi->org)\nСтрана:{$country}\nРегион:$ipapi->regionName ($ipapi->region)\nГород:$ipapi->city\nОС:{$user_os}\nБраузер:{$user_browser}\nЮсер Агент:{$user_agent}");
 $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$txt}","r");
