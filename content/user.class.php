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
        if (!$this->db->query($sql)) {
            return "0";
        }

        // ===============================
        // ===============================
        // ==== SEND EMAIL + SAVE KEY ====
        // ===============================
        // ===============================

        return "1";
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
        //$token = "rzScABcdbudG";

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

        $res = $this->db->query("SELECT `username` FROM `users` WHERE `u_id` = " . $uid . ";");
        $dsatz = mysqli_fetch_assoc($res);
        return $dsatz["username"];
    }

    public function getFirstn($uid) {
        $uid = mysqli_real_escape_string($this->db, $uid);

        $res = $this->db->query("SELECT `firstn` FROM `users` WHERE `u_id` = " . $uid . ";");
        $dsatz = mysqli_fetch_assoc($res);
        return $dsatz["firstn"];
    }

    public function getLastn($uid) {
        $uid = mysqli_real_escape_string($this->db, $uid);

        $res = $this->db->query("SELECT `lastn` FROM `users` WHERE `u_id` = " . $uid . ";");
        $dsatz = mysqli_fetch_assoc($res);
        return $dsatz["lastn"];
    }

    public function getNickn($uid) {
        $uid = mysqli_real_escape_string($this->db, $uid);

        $res = $this->db->query("SELECT `nickn` FROM `users` WHERE `u_id` = " . $uid . ";");
        $dsatz = mysqli_fetch_assoc($res);
        if($dsatz["nickn"] == null)
            return "/";
        else
            return $dsatz["nickn"];
    }

    public function getLoc($uid) {
        $uid = mysqli_real_escape_string($this->db, $uid);

        $res = $this->db->query("SELECT `loc` FROM `users` WHERE `u_id` = " . $uid . ";");
        $dsatz = mysqli_fetch_assoc($res);
        return $dsatz["loc"];
    }

    public function getPcode($uid) {
        $uid = mysqli_real_escape_string($this->db, $uid);

        $res = $this->db->query("SELECT `pcode` FROM `users` WHERE `u_id` = " . $uid . ";");
        $dsatz = mysqli_fetch_assoc($res);
        return $dsatz["pcode"];
    }

    public function getStreet($uid) {
        $uid = mysqli_real_escape_string($this->db, $uid);

        $res = $this->db->query("SELECT `street` FROM `users` WHERE `u_id` = " . $uid . ";");
        $dsatz = mysqli_fetch_assoc($res);
        return $dsatz["street"];
    }

    public function getHouse($uid) {
        $uid = mysqli_real_escape_string($this->db, $uid);

        $res = $this->db->query("SELECT `house` FROM `users` WHERE `u_id` = " . $uid . ";");
        $dsatz = mysqli_fetch_assoc($res);
        return $dsatz["house"];
    }

    public function getCountry($uid) {
        $uid = mysqli_real_escape_string($this->db, $uid);

        $res = $this->db->query("SELECT `name_de` FROM `countries` WHERE `c_id` = (SELECT `c_id` FROM `users` WHERE `u_id` = " . $uid . ");");
        $dsatz = mysqli_fetch_assoc($res);
        return $dsatz["name_de"];
    }

    public function getEmail($uid) {
        $uid = mysqli_real_escape_string($this->db, $uid);

        $res = $this->db->query("SELECT `email` FROM `users` WHERE `u_id` = " . $uid . ";");
        $dsatz = mysqli_fetch_assoc($res);
        return $dsatz["email"];
    }

    public function getBirth($uid){
        $uid = mysqli_real_escape_string($this->db, $uid);

        $res = $this->db->query("SELECT `birth` FROM `users` WHERE `u_id` = " . $uid . ";");
        $dsatz = mysqli_fetch_assoc($res);
        $birth_arr = explode("-", $dsatz["birth"]);
        return $birth_arr[2].". ".$birth_arr[1].". ".$birth_arr[0];
    }

    public function getStatus($uid) {
        $uid = mysqli_real_escape_string($this->db, $uid);

        $res = $this->db->query("SELECT `state` FROM `users` WHERE `u_id` = " . $uid . ";");
        $dsatz = mysqli_fetch_assoc($res);
        return $dsatz["state"];
    }

    //changeUserData($_POST["username"], $_POST["firstn"], $_POST["lastn"], $_POST["nickn"], $_POST["loc"], $_POST["pcode"], $_POST["street"], $_POST["house"], $_POST["country"], $_POST["email"], $_POST["birth"], $_POST["token"]);
    public function changeUserData($uid, $username, $firstn, $lastn, $nickn, $loc, $pcode, $street, $house, $country, $email, $birth, $token){
        if($this->checkToken($uid, $token)) {
            $data = array();
            if(!empty($username) && $username != "undefined")
                array_push($data, array("username","'".$username."'"));
            if(!empty($firstn) && $firstn != "undefined")
                array_push($data, array("firstn", "'".$firstn."'"));
            if(!empty($lastn) && $lastn != "undefined")
                array_push($data, array("lastn", "'".$lastn."'"));
            if(!empty($nickn) && $nickn != "undefined" && $nickn != "/")
                array_push($data, array("nickn", "'".$nickn."'"));
            else
                array_push($data, array("nickn", "null"));
            if(!empty($loc && $loc != "undefined"))
                array_push($data, array("loc", "'".$loc."'"));
            if(!empty($pcode) && $pcode != "undefined")
                array_push($data, array("pcode", $pcode));
            if(!empty($street) && $street != "undefined")
                array_push($data, array("street", "'".$street."'"));
            if(!empty($house) && $house != "undefined")
                array_push($data, array("house", "'".$house."'"));
            if(!empty($country) && $country != "undefined")
                array_push($data, array("c_id", $country));
            if(!empty($email) && $email != "undefined")
                array_push($data, array("email", "'".$email."'"));
            if(!empty($birth) && $birth != "undefined")
                array_push($data, array("birth", "'".$birth."'"));

            $query = "";
            for($x=0; $x<count($data); $x++) {
                if($x != 0) {
                    $query.= ", ";
                }
                $query.="`".$data[$x][0]."`=".$data[$x][1];
            }

            $res = $this->db->query("UPDATE `users` SET ".$query." WHERE `u_id` = ".$uid.";");
            if($res)
                return "true";
            else
                return "false";
        }
        else
            return "false";
    }
}