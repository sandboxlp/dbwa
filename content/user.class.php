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

        $res = $this->db->query("SELECT `id` FROM `users` WHERE `id`='" . $id . "';");

        if( $res->num_rows >= 1 ){return true;}else{return false;}
    }

    public function newUser($username, $password, $name, $mail, $rights) {

        $username = mysqli_real_escape_string($this->db, $username);
        $password = mysqli_real_escape_string($this->db, $password);
        $name = mysqli_real_escape_string($this->db, $name);
        $mail = mysqli_real_escape_string($this->db, $mail);
        $rights = mysqli_real_escape_string($this->db, $rights);

        $password = $this->hashPassword($password);

        $sql = 	"INSERT INTO `user` (username, password, name, mail, rights) VALUES" .
            "('" . $username . "', '" . $password . "', '" . $name . "', '" . $mail . "', '" . $rights . "')";
        if ($this->db->query($sql)) {
            return true;
        }else{
            return false;
        }
    }
}