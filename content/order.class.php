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
}