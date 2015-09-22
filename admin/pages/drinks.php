<?php require("bars.inc.php") ?>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Getränke Bestellungsübersicht</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Aktuelle Bestellung
                    </div>
                    <div class="panel-body">
                        <div class="dataTable_wrapper">
                            <table class="table table-striped table-bordered table-hover" id="users">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User</th>
                                    <th>Status</th>
                                    <th>Zeitstempel</th>
                                    <th>Aktionen</th>
                                </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $res = $order->getBillsToServe();
                                    while($dsatz = mysqli_fetch_assoc($res)) { ?>
                                    <tr class="odd">
                                        <td><?php echo $dsatz['b_id'];?></td>
                                        <td><?php echo $dsatz['u_id'];?></td>
                                        <td><?php echo $dsatz['status'];?></td>
                                        <td><?php echo $dsatz['timestamp'];?></td>
                                        <td>
                                            <button class="btn-primary btn-sm">Serviert</button>
                                        </td>
                                    </tr>
                                    <tr class="even">
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <table class="table table-striped table-bordered table-hover" id="products">
                                                <thead>
                                                <tr>
                                                    <th>Prudukt</th>
                                                    <th>Anzahl</th>
                                                    <th>Status</th>
                                                    <th>Aktionen</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="odd">
                                                        <?php
                                                        print_r(mysqli_fetch_assoc($order->getProductsToServe($dsatz['b_id'])));
                                                        while($dsatz = mysqli_fetch_assoc($order->getProductsToServe($dsatz['b_id']))) {
                                                        ?>
                                                        <td><?php getprotobynumber($dsatz['p_id']);?></td>
                                                        <td><?php echo $dsatz['count']; ?></td>
                                                        <td><?php echo $dsatz['status']; ?></td>
                                                        <td>Fancy Butoons</td>
                                                            <?php } ?>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <?php
                                    } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Offene Rechnungen
                    </div>

                    <div class="panel-body">
                        <div class="dataTable_wrapper">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Zeitstempel</th>
                                    <th>Name</th>
                                    <th>Summe</th>
                                    <th>Aktionen</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="odd">
                                    <td>1</td>
                                    <td>00:00:00</td>
                                    <td>Name</td>
                                    <td>XXX€</td>
                                    <td>
                                        <button class="btn-success btn-sm">Bestätigen</button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-8 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->
<?php require("footer.inc.php");