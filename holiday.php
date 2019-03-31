<?php
/**
 * Created by PhpStorm.
 * User: s1321
 * Date: 2019/03/31
 * Time: 20:55
 */

//$today = date('Y-m-d');
//$is_holiday = is_Holidays($today) ? "yes" : "no";
//print_r( $is_holiday );
/**
 * is_Holidays
 *
 * @access public
 * @param string $day
 * @return bool
 * @see http_get.php
 */
function is_Holidays($day) {
    $url = 'http://www8.cao.go.jp/chosei/shukujitsu/syukujitsu_kyujitsu.csv';
    $data = http_get($url);
    $data_utf8 = mb_convert_encoding($data, 'UTF-8', 'SJIS');
    $data_lf = str_replace(array("\r\n","\r","\n"), "\n", $data_utf8);
    $lines = explode( "\n", $data_lf );
    foreach ($lines as $line) {
        $columns = explode(",", $line);
        $holiday = trim($columns[0]);
        if($holiday == $day) {
            return true;
        }
    }
    return false;
}

/**
 * http_Get
 *
 * @access public
 * @param string $url
 * @return string
 * @see holiday.php ..etc
 */
function http_get($url){
    $option = [
        CURLOPT_RETURNTRANSFER => true,
    ];
    $curl = curl_init( $url );
    curl_setopt_array( $curl, $option );
    $data = curl_exec($curl);
    $info = curl_getinfo($curl);
    if ( $info['http_code'] !== 200 ) {
        $not_found = "404";
        return $not_found;
    } else {
        return $data;
    }
}

/**
 * day_wrapper
 *
 * @access public
 * @param int $day
 * @return string
 * @see holiday.php ..etc
 */
function day_wrapper($day){
    $option = [
        CURLOPT_RETURNTRANSFER => true,
    ];
    $curl = curl_init( $url );
    curl_setopt_array( $curl, $option );
    $data = curl_exec($curl);
    $info = curl_getinfo($curl);
    if ( $info['http_code'] !== 200 ) {
        $not_found = "404";
        return $not_found;
    } else {
        return $data;
    }
}