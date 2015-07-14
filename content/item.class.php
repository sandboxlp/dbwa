<?php
/**
 * Created by PhpStorm.
 * User: Tobias
 * Date: 29.06.2015
 * Time: 22:06
 */

class item { //(TO GET) ALL ABOUT ITEMS

    private $db;

    /** MECKER VON TOBI:
     *  1. SQL-BEFEHLE WERDEN GROß GESCHRIEBEN!
     *  2. ALLES WAS IN DIE KLASSE REIN KOMMT, WIRD ESCAPED (Du weißt nie wie blöd der User ist)
     *
     *  RÜCKMECKER VON SANDY:
     *  1. WENN ES SINN MACHT, MACH ICHS EH! GIBT MIR ZEIT ZUM LERNEN!
     *  2. WENN ICH GEWUSSTE HABE, WAS DAS IST, HÄTT ICHS GEMACHT!
     *  3. WENN DU WAS FÜR MICH KOMPLETT NEUES EINBRINGT, ERKLÄRS BITTE - DANKE!
     */

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
}