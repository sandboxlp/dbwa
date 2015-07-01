<?php
/**
 * Created by PhpStorm.
 * User: Tobias
 * Date: 29.06.2015
 * Time: 22:06
 */

class item {

    private $db;

    /**
     * @param $db
     */

    public function __construct($db){
        $this->db = $db;
    }

    public function categories_by_pos(){
        //$res = mysqli_query($db, "select * from `categories` order by `pos`;");

        $res = $this->db->query("SELECT * from `categories` ORDER BY `pos`;");
        $result_array = array();

        while($dsatz = mysqli_fetch_assoc($res))
            array_push($result_array, $dsatz);

        return $result_array;
    }

    public function news_by_nid() {
        //$res = mysqli_query($db, "select * from `news` order by `n_id`;");

        $res = $this->db->query("select * from `news` order by `n_id`;");
        $result_array = array();

        while($dsatz = mysqli_fetch_assoc($res))
            array_push($result_array, $dsatz);

        return $result_array;
    }
}