<?php
/**
 * Created by PhpStorm.
 * User: Tobias
 * Date: 29.06.2015
 * Time: 22:06
 */

class item { //(TO GET) ALL ABOUT ITEMS

    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function categories_by_pos(){
        $this->categories_by_pos_where('', '');
    }

    public function categories_by_pos_where($table, $where) {

        $table = mysqli_real_escape_string($this->db, $table);
        $where = mysqli_real_escape_string($this->db, $where);

        if ($table == '')
            $res = $this->db->query("SELECT * FROM `categories` ORDER BY `pos`;");
        elseif ($where == 'NULL') {
            $res = $this->db->query("SELECT * FROM `categories` WHERE `".$table."` IS NULL ORDER BY `pos`;");
        }
        else {
            $stmt = $this->db->prepare("SELECT * FROM `categories` WHERE `".$table."` = ? ORDER BY `pos`;");
            $stmt->bind_param("s", $where);
            $stmt->execute();
            $res = $stmt->get_result();
        }

        $result_array = array();
        while($dsatz = mysqli_fetch_assoc($res))
            array_push($result_array, $dsatz);

        return $result_array;
    }

    public function news_by_nid() {

        $res = $this->db->query("SELECT * FROM `news` ORDER BY `n_id`;");

        $result_array = array();
        while($dsatz = mysqli_fetch_assoc($res))
            array_push($result_array, $dsatz);

        return $result_array;
    }

    public function events_by_eid()
    {
        $res = $this->db->query("SELECT * FROM `events` ORDER BY `e_id`;");

        $result_array = array();
        while($dsatz = mysqli_fetch_assoc($res))
            array_push($result_array, $dsatz);

        return $result_array;
    }

    public function albums_by_date()
    {
        $res = $this->db->query("SELECT * FROM `albums` ORDER BY `date`;");

        $result_array = array();
        while($dsatz = mysqli_fetch_assoc($res))
            array_push($result_array, $dsatz);

        return $result_array;
    }

    public function album_by_aid($aid)
    {
        $aid = mysqli_real_escape_string($this->db, $aid);

        $stmt = $this->db->prepare("SELECT * FROM `albums` WHERE `a_id` = ?;");
        $stmt->bind_param("i", $aid);
        $stmt->execute();
        $res = $stmt->get_result();

        $result_array = array();

        while($dsatz = mysqli_fetch_assoc($res))
            array_push($result_array, $dsatz);

        return $result_array[0];
    }

    public function links_by_lid()
    {
        $res = $this->db->query("SELECT * FROM `links` ORDER BY `l_id`");

        $result_array = array();
        while($dsatz = mysqli_fetch_assoc($res))
            array_push($result_array, $dsatz);

        return $result_array;
    }

    public function menu_categories_where_mid($mid)
    {
        $mid = mysqli_real_escape_string($this->db, $mid);

        $stmt = $this->db->prepare("SELECT * FROM `menu_categories` WHERE `m_id` = ?;");
        $stmt->bind_param("i", $mid);
        $stmt->execute();
        $res = $stmt->get_result();

        $result_array = array();

        while($dsatz = mysqli_fetch_assoc($res))
            array_push($result_array, $dsatz);

        return $result_array[0];
    }

    public function menu_categories_where_upper($mid)
    {
        $mid = mysqli_real_escape_string($this->db, $mid);

        $stmt = $this->db->prepare("SELECT * FROM `menu_categories` WHERE `upper` = ?;");
        $stmt->bind_param("i", $mid);
        $stmt->execute();
        $res = $stmt->get_result();

        $result_array = array();

        while($dsatz = mysqli_fetch_assoc($res))
            array_push($result_array, $dsatz);

        return $result_array;
    }

    public function products_where_mid_by_pos($mid)
    {
        $mid = mysqli_real_escape_string($this->db, $mid);

        $stmt = $this->db->prepare("SELECT * FROM `products` WHERE `m_id` = ? ORDER BY `pos`;");
        $stmt->bind_param("i", $mid);
        $stmt->execute();
        $res = $stmt->get_result();

        $result_array = array();

        while($dsatz = mysqli_fetch_assoc($res))
            array_push($result_array, $dsatz);

        return $result_array;
    }

    public function products_page()
    {
        $res = $this->db->query("SELECT * FROM `menu_categories` mc WHERE `m_id` IN (SELECT `m_id` FROM `products`) ORDER BY (SELECT `pos` FROM `menu_categories` WHERE `m_id` = mc.`upper`), `pos`;");

        $result_array = array();

        while($dsatz = mysqli_fetch_assoc($res))
            array_push($result_array, $dsatz);

        return $result_array;
    }

    public function products_nextpage($mid)
    {
        $result_array = $this->products_page();

        $mypos = 0;

        while($result_array[$mypos]["m_id"] != $mid && $mypos < count($result_array)) {
            $mypos++;
        }

        if($mypos + 1 < count($result_array))
            return $result_array[$mypos + 1]["m_id"];
        else
            return $result_array[0]["m_id"];
    }

    public function products_lastpage($mid)
    {
        $result_array = $this->products_page();

        $mypos = 0;

        while($result_array[$mypos]["m_id"] != $mid && $mypos < count($result_array)){
            $mypos++;
        }

        if($mypos > 0)
            return $result_array[$mypos - 1]["m_id"];
        else
            return $result_array[count($result_array) - 1]["m_id"];
    }

    public function pizzaIngredients() {
        $res = $this->db->query("SELECT * FROM `pizza_ingredients`;");
        if(mysqli_num_rows($res) > 0)
            return $res;
        else
            return "Test";
    }
}