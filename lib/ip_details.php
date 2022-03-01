<?php
//Getting Country, City, Region, Map Location and Internet Service Provider
$ip = $_SERVER['REMOTE_ADDR'];

$url = 'https://extreme-ip-lookup.com/json/'. $ip .'?key=NpMC143Xd1xfbBTMMCOv';

$ch  = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
curl_setopt($ch, CURLOPT_REFERER, "https://google.com");
$ipcontent = curl_exec($ch);
curl_close($ch);

$ip_data = json_decode($ipcontent);

if ($ip_data && $ip_data->{'status'} == 'success') 
{
    $country      = $ip_data->{'country'};
    $country_code = $ip_data->{'countryCode'};
    $region       = $ip_data->{'region'};
    $city         = $ip_data->{'city'};
    $latitude     = $ip_data->{'lat'};
    $longitude    = $ip_data->{'lon'};
    $isp          = $ip_data->{'isp'};
} else 
{
    echo "ELSE IS WORKING";
    $country      = "Unknown";
    $country_code = "XX";
    $region       = "Unknown";
    $city         = "Unknown";
    $latitude     = "0";
    $longitude    = "0";
    $isp          = "Unknown";
}

$user_agent     =   $_SERVER['HTTP_USER_AGENT'];

function getOS() { 

global $user_agent;

$os_platform    =   "Unknown OS Platform";

$os_array       =   array(
    '/windows nt 10.0/i'    =>  'Windows 10',
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

foreach ($os_array as $regex => $value) { 

if (preg_match($regex, $user_agent)) {
$os_platform    =   $value;
}

}   

return $os_platform;

}

function getBrowser() {

global $user_agent;

$browser        =   "Unknown Browser";

$browser_array  =   array(
    '/msie/i'       =>  'Internet Explorer',
    '/firefox/i'    =>  'Firefox',
    '/safari/i'     =>  'Safari',
    '/chrome/i'     =>  'Chrome',
    '/opera/i'      =>  'Opera',
    '/netscape/i'   =>  'Netscape',
    '/maxthon/i'    =>  'Maxthon',
    '/konqueror/i'  =>  'Konqueror',
    '/mobile/i'     =>  'Handheld Browser'
);

foreach ($browser_array as $regex => $value) { 

if (preg_match($regex, $user_agent)) {
$browser    =   $value;
}

}

return $browser;

}


$user_os        =   getOS();
$user_browser   =   getBrowser();


?>