<?php
/**
 * Created by PhpStorm.
 * User: Tobias
 * Date: 29.06.2015
 * Time: 22:04
 */

class order {

    private $db;

    /**
     * @param $db
     */

    public function __construct($db){
        $this->db = $db;
    }

    public function orderProduct($uid, $pid, $count) {
        $uid = mysqli_real_escape_string($this->db, $uid);
        $pid = mysqli_real_escape_string($this->db, $pid);
        $count = mysqli_real_escape_string($this->db, $count);

        $res = $this->db->query("SELECT `b_id` FROM `bills` WHERE `u_id` = ".$uid." AND `status` IN (0,2);");

        if($res->num_rows) {
            $dsatz = mysqli_fetch_assoc($res);
            $bid = $dsatz["b_id"];

            $res = $this->db->query("SELECT `bp_id` FROM `bills_products` WHERE `b_id` = ".$bid." AND `p_id` = ".$pid.";");
            if($dsatz = mysqli_fetch_assoc($res)) {
                $res = $this->db->query("UPDATE `bills_products` SET `count` = `count` + ".$count." WHERE `bp_id` = ".$dsatz["bp_id"].";");
                if($res)
                    return "1";
                else
                    return "0";
            }
            else {
                $res = $this->db->query("INSERT INTO `bills_products`(`b_id`, `p_id`, `count`) VALUES(" . $bid . ", " . $pid . ", " . $count . ");");

                if ($res)
                    return "1";
                else
                    return "0";
            }
        }

        else {
            $res = $this->db->query("INSERT INTO `bills`(`u_id`) VALUES(".$uid.");");

            if(!$res) {
                return "false";
                die();
            }

            $res = $this->db->query("SELECT `b_id` FROM `bills` ORDER BY `b_id` DESC;");
            $dsatz = mysqli_fetch_assoc($res);
            $bid = $dsatz["b_id"];
            $res = $this->db->query("INSERT INTO `bills_products`(`b_id`, `p_id`, `count`) VALUES(".$bid.", ".$pid.", ".$count.");");

            if($res)
                return "1";
            else
                return "0";
        }
    }
}