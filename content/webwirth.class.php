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
}
?>