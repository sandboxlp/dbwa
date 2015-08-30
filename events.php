<?php require("content/top.php"); ?>

    <style>
        .date {
            width:32%;
            display: inline-block;
            margin-right: 2%;
            font-weight: bold;
            text-align: right;
            float:left;
        }

        .title {
            display: inline-block;
            float:right;
            width: 66%;
        }
    </style>

<?php require("content/top2.php"); ?>

    <main>
        <h1 class="superduperheadline">EVENTS</h1>

        <?php
        foreach($item->events_by_eid() as $dsatz)
        {
            echo "<p>";
            $date_arr = explode("-", $dsatz["date"]);
            $date = $date_arr[2].".".$date_arr[1];
            echo '<span class="date">';
            if(isset($dsatz["prefix"]))
                echo $dsatz["prefix"]. " ";
            echo $date."</span>";
            echo '<span class="title">'.$dsatz["title"].'</span></p>';
        } ?>
        <div style="width: 100%; float:right;"></div>
        <br/><br/>
        <?php include("content/nav_boxes/home.php"); ?>

    </main>

<?php require("content/bottom.php"); ?>