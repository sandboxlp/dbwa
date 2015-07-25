<?php require("bars.inc.php") ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Dashboard</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-user fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">XXX</div>
                            <div>Neue Benutzer</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-shopping-cart fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">XXX</div>
                            <div>Neue Bestellungen</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-support fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">XXX</div>
                            <div>Bezahlen bitte</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Neue Benutzer
                </div>
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="users">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Vorname</th>
                                <th>Nachname</th>
                                <th>Benutzername</th>
                                <th>Postleitzahl</th>
                                <th>Wohnort</th>
                                <th>Straße</th>
                                <th>Land</th>
                                <th>Geburtsdatum</th>
                                <th>Status</th>
                                <th>Aktionen</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="odd">
                                <td>1</td>
                                <td>Tobias</td>
                                <td>Maschek</td>
                                <td>Jemx</td>
                                <td>01445</td>
                                <td>Radebeul</td>
                                <td>An der Jägermühle 23</td>
                                <td>Deutschland</td>
                                <td>31.07.XXXX</td>
                                <td>noch nicht bestätigt</td>
                                <td>
                                    <button class="btn-primary btn-sm">Bestätigen</button>
                                    <button class="btn-warning btn-sm">Ablehenen</button>
                                    <button class="btn-danger btn-sm">Sperren</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Neue Bestellungen
                    </div>

                    <div class="panel-body">
                        <div class="dataTable_wrapper">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Benutzername</th>
                                    <th>Tisch</th>
                                    <th>Speisen/Gertränke</th>
                                    <th>Status</th>
                                    <th>Aktionen</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="odd">
                                    <td>1</td>
                                    <td>Jemx</td>
                                    <td>x+1</td>
                                    <td>Sandbox ohne Käse :P</td>
                                    <td>noch nicht bestätigt</td>
                                    <td>
                                        <button class="btn-success btn-sm">Bestätigen</button>
                                        <button class="btn-danger btn-sm">Ablehenen</button>
                                        <button class="btn-primary btn-sm">Serviert</button>
                                        <button class="btn-info btn-sm">Bezahlt</button>
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
