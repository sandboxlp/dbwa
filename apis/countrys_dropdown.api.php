<?php
require("../content/db.php");
require("../content/user.class.php");
$user = new user($db);

echo '<select name="c_id" id="countryIN">';

foreach ($user->getLands() as $key => $value) {
    foreach ($value as $key2 => $value2) {
        if ($key2 == "c_id")
            echo "<option value=" . $value2 . ">";
        elseif ($key2 == "name_de")
            echo $value2 . "</option>";
    }
}

echo "</select>"

?>