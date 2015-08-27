<?php
/**
 * Created by PhpStorm.
 * User: Tobias
 * Date: 01.07.2015
 * Time: 20:39
 */

class user {

    private $db;

    /**
     * @param $db
     */

    public function __construct($db){
        $this->db = $db;
    }

    /** CHANGE TO PRIVATE ON RELEASE */
    private function hashPassword($password){

        return hash('sha512', $password);
    }

    public function userExists($id){

        $id = mysqli_real_escape_string($this->db, $id);

        $res = $this->db->query("SELECT `u_id` FROM `users` WHERE `u_id`='" . $id . "';");

        if( $res->num_rows >= 1 ){return true;}else{return false;}
    }

    public function getUserId($username){

        $username = mysqli_real_escape_string($this->db, $username);
        //$password = mysqli_real_escape_string($this->db, $password);
        //$name = mysqli_real_escape_string($this->db, $name);
        //$mail = mysqli_real_escape_string($this->db, $mail);
        //$rights = mysqli_real_escape_string($this->db, $rights);

        $res = $this->db->query("SELECT * FROM `users` WHERE `username`='" . $username . "';");
        if(mysqli_num_rows($res)) {
            $return = $res->fetch_assoc();
            return $return['u_id'];
        }
        else
            return -1;
    }

    public function newUser($firstn, $lastn, $username, $loc, $pcode, $street, $house, $c_id, $email, $birth, $passwd) {

        $firstn = mysqli_real_escape_string($this->db, $firstn);
        $lastn = mysqli_real_escape_string($this->db, $lastn);
        $username = mysqli_real_escape_string($this->db, $username);
        $loc = mysqli_real_escape_string($this->db, $loc);
        $pcode = mysqli_real_escape_string($this->db, $pcode);
        $street = mysqli_real_escape_string($this->db, $street);
        $house = mysqli_real_escape_string($this->db, $house);
        $c_id = mysqli_real_escape_string($this->db, $c_id);
        $email = mysqli_real_escape_string($this->db, $email);
        $birth = mysqli_real_escape_string($this->db, $birth);
        $passwd = mysqli_real_escape_string($this->db, $passwd);

        $passwd = $this->hashPassword($passwd);

        $sql = 	"INSERT INTO `users` (firstn, lastn, username, loc, pcode, street, house, c_id, email, birth, passwd) VALUES" .
            "('" . $firstn . "', '" . $lastn . "', '" . $username . "', '" . $loc . "', '" . $pcode . "', '" . $street . "', '" . $house . "', '" . $c_id . "', '" . $email . "', '" . $birth . "', '" . $passwd . "');";
        if ($this->db->query($sql)) {
            return "1";
        }
        else{
            return "0";
        }
    }

    public function checkLogin($userID, $passwd){

        $userID = mysqli_real_escape_string($this->db, $userID);
        $passwd = mysqli_real_escape_string($this->db, $passwd);

        $passwd = $this->hashPassword($passwd);

        $sql = "SELECT * FROM `users` WHERE `u_id`='" . $userID . "' AND `passwd`='" . $passwd . "';";
        $result = $this->db->query($sql);

        if( $result->num_rows >= 1 ){
            return true;
        }else{
            return false;
        }
    }

    public function getLands() {

        $res = $this->db->query("SELECT `c_id`, `name_de` FROM `countries` ORDER BY `special` ASC ;");

        $result_array = array();
        while($dsatz = mysqli_fetch_assoc($res))
            array_push($result_array, $dsatz);

        return $result_array;
    }

    public function setgetRandomToken($uid) {
        $tokenchars = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
        $token = "";

        for($i = 0; $i < 15; $i++){
            $rand = rand(0, count($tokenchars) - 1);
            if($rand < 26)
                if(rand(0, 1))
                    $token .= strtolower($tokenchars[$rand]);
            else
                $token .= $tokenchars[$rand];
        }

        $uid = mysqli_real_escape_string($this->db, $uid);
        $this->db->query("UPDATE `users` SET `token` = '".$token."' WHERE `u_id` = ".$uid.";");

        return $token;
    }

    public function setCookie($uid) {
        $uid = mysqli_real_escape_string($this->db, $uid);
        return $this->db->query("SELECT `cookies` FROM `users` WHERE `u_id` = ".$uid.";");
    }

    public function checkToken($uid, $token) {
        $uid = mysqli_real_escape_string($this->db, $uid);
        $token = mysqli_real_escape_string($this->db, $token);

        $res = $this->db->query("SELECT * FROM `users` WHERE `u_id` = ".$uid." AND `token` = '".$token."';");

        if($dsatz = mysqli_fetch_assoc($res))
            return "1";
        else
            return "0";

    }

    public function showPayPlease($uid) {
        $uid = mysqli_real_escape_string($this->db, $uid);

        $res = $this->db->query("SELECT `b_id` FROM `bills` WHERE `u_id` = ".$uid." AND `status` = 2 AND `b_id` NOT IN (SELECT `b_id` FROM `bills_products` WHERE `served` = 0);");

        if($dsatz = mysqli_fetch_assoc($res))
            return $dsatz["b_id"];
        else
            return "0";
    }

    public function payPlease($uid) {
        $uid = mysqli_real_escape_string($this->db, $uid);

        $res = $this->db->query("UPDATE `bills` SET `status` = 3 WHERE `b_id` = ".$this->showPayPlease($uid).";");

        if($res)
            return "1";
        else
            return "0";
    }

    public function getUsername($uid) {
        $uid = mysqli_real_escape_string($this->db, $uid);

        $res = $this->db->query("SELECT `username` FROM `users` WHERE `u_id` = ".$uid.";");
        $dsatz = mysqli_fetch_assoc($res);
        return $dsatz["username"];
    }
}