<?php require("bars.inc.php") ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Essen Bestellungsübersicht</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

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
                                <th>Zeitstempel</th>
                                <th></th>
                                <th>Aktionen</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="odd">
                                <td>1</td>
                                <td>00:00:00</td>
                                <td><b>AUFTRAGGEBER</b></td>
                                <td>
                                    <button class="btn-primary btn-sm">Erledigt</button>
                                </td>
                            </tr>
                            <tr class="even">
                                <td></td>
                                <td></td>
                                <td>Item1</td>
                                <td>
                                    <button class="btn-primary btn-sm">Erledigt</button>
                                </td>
                            </tr>
                            <tr class="even">
                                <td></td>
                                <td></td>
                                <td>Item2</td>
                                <td>
                                    <button class="btn-primary btn-sm">Erledigt</button>
                                </td>
                            </tr>
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
                                    <th>Aktionen</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="odd">
                                    <td>1</td>
                                    <td>00:00:00</td>
                                    <td>Name</td>
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

            <!-- /.col-lg-4 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

<!-- Morris Charts JavaScript -->
<script src="../bower_components/raphael/raphael-min.js"></script>
<script src="../bower_components/morrisjs/morris.min.js"></script>
<script src="../js/morris-data.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
