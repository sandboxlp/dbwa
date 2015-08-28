<?php
class webwirth
{
    public function int3($int)
    {
        if($int < 0 || $int >= 100)
            return "".$int;
        elseif($int < 10)
            return "00".$int;
        else
            return "0".$int;
    }
    public function priceFormat($price) {
        if(strpos($price, ".") == false)
            return $price.".00";
        else {
            if(strlen(explode(".", $price)[1]) == 1)
                return $price."0";
            else
                return $price;
        }

    }

    public function timestampFormat($timestamp) {
        $timestamp_arr = explode(" ", $timestamp);
        $dates_arr = explode("-", $timestamp_arr[0]);
        $time_arr = explode(":", $timestamp_arr[1]);
        return $dates_arr[2].". ".$dates_arr[1].". ".$dates_arr[0]." &nbsp; ".$time_arr[0].":".$time_arr[1];
    }
}
?>