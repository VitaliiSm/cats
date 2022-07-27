<?php
class Other{


//public static function  currency()
//{
//preg_match_all('#"price":(.+?)"priceCurrency"#is', file_get_contents("https://minfin.com.ua/currency/"), $arr);
//   $bUsd = substr($arr[1][2], 0, -17);
//   $sUsd = substr($arr[1][3], 0, -17);
//   $bEur = substr($arr[1][7], 0, -17);
//   $sEur =  substr($arr[1][8], 0, -17);
//    $bPLN = substr($arr[1][12], 0, -17);
//    $sPLN = substr($arr[1][13], 0, -17);
//    $usd = 'Usd:'.PHP_EOL.'buy'.' -'.$bUsd.PHP_EOL.'sell'.' -'.$sUsd.PHP_EOL;
//   $eur = 'Eur:'.PHP_EOL.'buy'.' -'.$bEur.PHP_EOL.'sell'.' -'.$sEur.PHP_EOL;
//  $pln = 'Pln:'.PHP_EOL.'buy'.' -'.$bPLN.PHP_EOL.'sell'.' -'.$sPLN.PHP_EOL;
////  echo $usd.$eur.$pln;
//}
public static function wether()
{
    preg_match_all('#"temperatureAir":(.+?)"temperatureWater"#is', file_get_contents("https://www.gismeteo.ua/weather-odessa-4982/now/"), $arr);
    preg_match_all('#"temperatureWater":(.+?)"temperatureHeatIndex"#is', file_get_contents("https://www.gismeteo.ua/weather-odessa-4982/now/"), $arr1);
    preg_match_all('#],"description":(.+?),"precipitation":#is', file_get_contents("https://www.gismeteo.ua/weather-odessa-4982/now/"), $arr2);
    $temperatureAir= substr($arr[1][0], 1, -2);
    $temperatureWater =substr($arr1[1][0], 1, -2);
    $description = substr($arr2[1][0], 2, -2);
    echo 'Odessa wether: ' .'temperature air: '.$temperatureAir.'°C'.' '.$description.' temperature water: '.$temperatureWater.'°C';

}
}