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

        if(mysqli_num_rows($res)) {
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

            $res = $this->db->query("SELECT `b_id` FROM `bills` WHERE `u_id` = " . $uid . " AND `status` = 1;");

            if (mysqli_num_rows($res)) {
                $dsatz = mysqli_fetch_assoc($res);
                $bid = $dsatz["b_id"];

                $res = $this->db->query("SELECT `bp_id` FROM `bills_products` WHERE `b_id` = ".$bid." AND `p_id` = ".$pid." AND `served` = 0;");
                if($res->num_rows) {
                    $dsatz = mysqli_fetch_assoc($res);
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

                $res = $this->db->query("INSERT INTO `bills`(`u_id`) VALUES(" . $uid . ");");

                if (!$res) {
                    return "0";
                    die();
                }

                $res = $this->db->query("SELECT `b_id` FROM `bills` ORDER BY `b_id` DESC;");
                $dsatz = mysqli_fetch_assoc($res);
                $bid = $dsatz["b_id"];
                $res = $this->db->query("INSERT INTO `bills_products`(`b_id`, `p_id`, `count`) VALUES(" . $bid . ", " . $pid . ", " . $count . ");");

                if ($res)
                    return "1";
                else
                    return "0";
            }
        }
    }

    public function getCurrentBill($uid) {
        $res = $this->db->query("SELECT `b_id` FROM `bills` WHERE `u_id` = ".$uid.";");
        return mysqli_fetch_assoc($res)["b_id"];
    }

    public function getProducts($bid) {
        $res = $this->db->query("SELECT `p_id`, `count`, `served` FROM `bills_products` WHERE `b_id` = ".$bid.";");
        $data = array();
        while($dsatz = mysqli_fetch_assoc($res)) {
            array_push($data, $dsatz);
        }
        return $data;
    }

    public function getProductName($pid) {
        $res = $this->db->query("SELECT `title` FROM `products` WHERE `p_id` = ".$pid.";");
        return mysqli_fetch_assoc($res)["title"];
    }

    public function getProductPrice($pid) {
        $res = $this->db->query("SELECT * FROM `products` WHERE `p_id` = ".$pid.";");
        return mysqli_fetch_assoc($res)["price"];
    }

    public function getProductTax($pid) {
        $res = $this->db->query("SELECT * FROM `products` WHERE `p_id` = ".$pid.";");
        return mysqli_fetch_assoc($res)["tax"];
    }

    public function showOrder($uid) {
        $res = $this->db->query("SELECT * FROM `bills` NATURAL JOIN `bills_products` WHERE `status` IN (0,2) AND `served` = 0 AND `u_id` = ".$uid.";");
        if(mysqli_num_rows($res) > 0)
            return true;
        else
            return false;
    }

    public function getBillStatus($bid) {
        $res = $this->db->query("SELECT `status` FROM `bills` WHERE `b_id` = ".$bid.";");
        return mysqli_fetch_assoc($res)["status"];
    }

    public function get_bpid($bid, $pid) {
        $res = $this->db->query("SELECT `bp_id` FROM `bills_products` WHERE `b_id` = ".$bid." AND `p_id` = ".$pid.";");
        return mysqli_fetch_assoc($res)["bp_id"];
    }

    public function updateBillCount($bpid, $count) {
        $res = $this->db->query("UPDATE `bills_products` SET `count` = ".$count." WHERE `bp_id` = ".$bpid.";");
        if($res)
            return "1";
        else
            return "0";
    }

    public function setBillStatus($bid, $status) {
        $res = $this->db->query("UPDATE `bills` SET `status` = ".$status." WHERE `b_id` = ".$bid.";");
        if($res)
            return "1";
        else
            return "0";
    }

    public function getOldBills($uid) {
        $res = $this->db->query("SELECT * FROM `bills_old` WHERE `u_id` = ".$uid." ORDER BY `paid` DESC;");
        if(mysqli_num_rows($res) > 0)
            return $res;
        else
            return false;
    }

    public function getOldBill($bid) {
        $res = $this->db->query("SELECT * FROM `bills_old` WHERE `b_id` = ".$bid.";");
        if($res->num_rows)
            return mysqli_fetch_assoc($res);
        else
            return false;
    }

    public function getOldBillProducts($bid) {
        $res = $this->db->query("SELECT * FROM `bills_products_old` WHERE `b_id` = ".$bid.";");
        if(mysqli_num_rows($res) > 0)
            return $res;
        else
            return false;
    }

    public function getBillsToServe() {
        $res = $this->db->query("SELECT * FROM `bills` WHERE `status` = 1;");
        if(mysqli_num_rows($res) > 0)
            return $res;
        else
            return false;
    }

    public function getProductsToServe($bid) {
        $res = $this->db->query("SELECT * FROM `bills_products` WHERE `b_id` = ".$bid." AND `served` = 0;");
        if(mysqli_num_rows($res) > 0)
            return $res;
        else
            return false;

    }

    public function getBillstoPay() {
        $res = $this->db->query("SELECT * FROM `bills` WHERE `status` = 3;");
        if(mysqli_num_rows($res) > 0)
            return $res;
        else
            return false;

    }

    public function orderPizza($uid, $size, $takeaway, $cut, $ing) {
        if($this->db->query("INSERT INTO `pizzas`(`size`, `cut`, `takeaway`) VALUES(".$size.",".$cut.",".$takeaway.")")) {
            $res = $this->db->query("SELECT `p_id` FROM `pizzas` ORDER BY `p_id` DESC");
            $pid = mysqli_fetch_assoc($res)["p_id"];
            foreach($ing as $ingr) {
                if(!$this->db->query("INSERT INTO `pizzas_ingredients`(`p_id`, `i_id`) VALUES(".$pid.",".$ingr.")"))
                    return "INSERT INTO `pizzas_ingredients`(`p_id`, `i_id`) VALUES(".$pid.",".$ingr.")";
            }
            return $this->orderProduct($uid, $pid, 1);
        }
        else
            return "0";
    }

    public function getPizzaTitle($pid) {
        $res = $this->db->query("SELECT * FROM `pizzas` WHERE `p_id` = ".$pid.";");
        $pizza = mysqli_fetch_assoc($res);
        $title = "";
        if(!$pizza["cut"])
            $title .= "ungeschnittene ";
        if($pizza["size"] == 1)
            $title .= "kl. ";
        $title.= "Pizza ";
        $res = $this->db->query("SELECT `title` FROM `pizza_ingredients` WHERE `i_id` IN (SELECT `i_id` FROM `pizzas_ingredients` WHERE `p_id` = ".$pid.")");
        if(mysqli_num_rows($res) > 0) {
            $ings = array();
            while($ing = mysqli_fetch_assoc($res)["title"])
                array_push($ings, $ing);
            if(count($ings) > 1) {
                $title.="mit ";
                for ($x = 0; $x + 1 < count($ings); $x++) {
                    if($x == 0)
                        $title .= $ings[$x];
                    else
                        $title .= ", ".$ings[$x];
                }
                $title.=" und " . $ings[count($ings)-1];
            }
            else
                $title.="mit ".$ings[0];
        }
        else
            $title.="Margherita";
        if($pizza["takeaway"])
            $title.=" zum Mitnehmen";

        return $title;
    }

    public function getPizzaPrice($pid) {
        $price = 0.00;
        $res = $this->db->query("SELECT * FROM `pizzas` WHERE `p_id` = " . $pid.";");
        $pizza = mysqli_fetch_assoc($res);
        if($pizza["size"] == 1)
            $price += 3.90;
        elseif($pizza["size"] == 2)
            $price += 4.90;
        $res = $this->db->query("SELECT `title` FROM `pizza_ingredients` WHERE `i_id` IN (SELECT `i_id` FROM `pizzas_ingredients` WHERE `p_id` = ".$pid.")");
        $price += mysqli_num_rows($res)*0.40;

        return $price;



    }


}