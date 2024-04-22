<?php
session_start();
/*include "include/validation.php";*/
if(!isset($_SESSION['email']) && !isset($_SESSION['id'])) {
    header("Location: login.php");
} elseif (empty($_SESSION['email']) || empty($_SESSION['id'])) {
    header("Location: login.php");
}
?>


<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>USERS</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Toastr style -->
    <!--  <link rel="stylesheet" href="css/screen.css">
      <link rel="stylesheet" href="css/style.css">-->

    <link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <!-- dataTable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css">

   <!-- --><?php
/*    include "include/header.php";
    */?>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    <style>
        .swal2-popup {
            font-size: 1.6rem;
        }
    </style>
</head>

<body class="pace-done">

<div id="wrapper">

    <!-- Navbar -->
    <?php
    include 'include/sidebar.php';
    ?>

    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">

            <?php
            include 'include/topmenu.php';
            ?>

        </div>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>Dashboard</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="home.php">Home</a>
                    </li>
                    <li class="active">
                        <strong>Users</strong>
                    </li>
                </ol>
            </div>
            <div class="col-lg-2">

            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <?php if ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'manager') : ?>
                <button type="button"  id="addButton" name="addButton" class="btn btn-primary" data-toggle="modal" data-target="#modalForm">
                    + Add New User
                </button>
            <?php endif; ?>
<br> <br>
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">

                        <div class="modal inmodal" id="modalId" name="modalId" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content animated flipInY">
                                    <div class="modal-header">
                                        <button type="button" class="close" id="close" name="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h4 class="modal-title">Add New Details</h4>
                                        <small class="font-bold"></small>
                                    </div>
                                    <form action="backend/addUser.php" id="modal-form" method="post" enctype="multipart/form-data" autocomplete="off">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="name">Firstname</label>
                                                <input type="text" name="name" id="name" class="form-control" autocomplete="given-name" value="" />
<!--                                                <div class="errorMessage">  --><?php /*echo $validationErrors['name']; */?><!--
                                                </div>-->
                                            </div>

                                            <div class="form-group">
                                                <label for="lastname">Lastname</label>
                                                <input type="text" name="lastname" id="lastname" class="form-control" autocomplete="family-name" value="" />
                                               <!-- <div class="errorMessage">  <?php /*echo $validationErrors['lastname']; */?>
                                                </div>-->
                                            </div>

                                            <div class="form-group">
                                                <label for="birthday">Birthday</label>
                                                <input type="date" name="birthday" id="birthday" autocomplete="off" value="" />
                                               <!-- <div class="errorMessage">  <?php /*echo $validationErrors['birthday']; */?>
                                                </div>-->
                                            </div>

                                            <div class="form-group">
                                                <label for="phone">Phone Number</label>
                                                <input type="text" name="phone" id="phone" class="form-control" autocomplete="off" value="" />
                                                <!--<div class="errorMessage"> <?php /*echo $validationErrors['phone']; */?>
                                                </div>-->
                                            </div>

                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" name="email" id="email" class="form-control" autocomplete="off" value="" />
                                                <!--<div class="errorMessage"> <?php /*echo $validationErrors['email']; */?>
                                                </div>-->
                                            </div>

                                            <?php
                                            if($_SESSION['role'] == 'admin'){?>
                                                <div class="form-group">
                                                    <label class="small mb-1" for="role">Role</label>
                                                    <select class="form-control" name="role" id="role">
                                                        <option value="admin">Admin</option>
                                                        <option value="manager">Manager</option>
                                                        <option value="user" >User</option>
                                                    </select>
                                                </div>
                                            <?php }
                                            ?>
                                            <?php
                                            if($_SESSION['role'] == 'manager'){?>
                                                <div class="form-group">
                                                    <label class="small mb-1" for="role">Role</label>
                                                    <input class="form-control" id="role" name = 'role' type="text" value="User" readonly>
                                                </div>
                                            <?php }
                                            ?>

                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="password" name="password" id="password"  class="form-control" autocomplete="off" value="" />
                                                <!--<div class="errorMessage"> <?php /*echo $validationErrors['password']; */?>
                                                </div>-->
                                            </div>
                                            <div class="form-group">
                                                <label for="confirmPassword">Confirm Password</label>
                                                <input type="password" name="confirmPassword" id="confirmPassword" class="form-control" autocomplete="off" value="" />
                                                <!--<div class="errorMessage">  <?php /*echo $validationErrors['confirmPassword']; */?>
                                                </div>-->
                                            </div>

                                        </div>

                                        <div id="success"> </div>
                                        <div class="modal-footer">
                                            <input type="hidden" name="operation" id="operation">
                                            <input type="hidden" name="member_id" id="member_id">
                                            <input type="submit" class="btn btn-primary"  name="action" id="action"  value="Save">
                                            <button type="button" name="close" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example" id="memListTable" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Birthday</th>
                                        <th>Phone</th>
                                        <th>Role</th>
                                        <?php
                                        if($_SESSION['role'] == 'admin'){?>
                                            <th>Action</th>
                                        <?php }
                                        ?>
                                    </tr>
                                    </thead>

                                    <tfoot>
                                    <tr>
                                        <th></th>
                                        <th>ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Birthday</th>
                                        <th>Phone</th>
                                        <th>Role</th>
                                        <?php
                                        if($_SESSION['role'] == 'admin'){?>
                                            <th>Action</th>
                                        <?php }
                                        ?>
                                    </tr>
                                    </tfoot>

                                </table>
                            </div>
                            <input type="hidden" name="page" value="display">

                        </div>
                    </div>
                </div>
            </div>

            <!--<div class="modal inmodal" id="modalId" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content animated bounceInRight">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" id="btn_dismiss"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title">Add a new user</h4>
                        </div>

                        <div class="modal-body">
                            <form method="POST" class="profile-form" id="modal-form" enctype='multipart/form-data'>

                                <div class="modal-body">
                                    <p id="message"></p>
                                    <div class="form-group">
                                        <label class="small mb-1" for="name">First name</label>
                                        <input class="form-control" id="name" name = 'name' type="text" placeholder="Enter your first name" value="" required>
                                    </div>

                                    <div class="form-group">
                                        <label class="small mb-1" for="lastname">Last name</label>
                                        <input class="form-control" id="lastname" name = 'lastname'  type="text" placeholder="Enter your last name" value="" required>
                                    </div>


                                    <div class="form-group">
                                        <label class="small mb-1" for="birthday">Birthday</label>
                                        <input class="form-control" id="birthday" name = 'birthday' type="date" value="" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="phone">Phone Number</label>
                                        <input type="text" name="phone" id="phone" class="form-control" autocomplete="off" value="" />
                                    </div>


                                    <div class="form-group">
                                        <label class="small mb-1" for="email">Email address</label>
                                        <input class="form-control" id="email" name = 'email' type="email" placeholder="Enter your email address" value="" required>
                                        <div class="error">
                                        </div>
                                    </div>

                                    <?php
/*                                    if($_SESSION['role'] == 'admin'){*/?>
                                        <div class="form-group">
                                            <label class="small mb-1" for="role">Role</label>
                                            <select class="form-control" name="role" id="role">
                                                <option value="admin">Admin</option>
                                                <option value="manager">Manager</option>
                                                <option value="user" >User</option>
                                            </select>
                                        </div>
                                    <?php /*}
                                    */?>
                                    <?php
/*                                    if($_SESSION['role'] == 'manager'){*/?>
                                        <div class="form-group">
                                            <label class="small mb-1" for="role">Role</label>
                                            <input class="form-control" id="role" name = 'role' type="text" value="User" readonly>
                                        </div>
                                    <?php /*}
                                    */?>


                                    <div class="form-group">
                                        <label class="small mb-1" for="password">New password</label>
                                        <input class="form-control" id="password" type="password" name="password" placeholder="Enter your new password" value="" required>
                                    </div>
                                    <input type="hidden" name="page" value="display">

                                    <div class="form-group">
                                        <label class="small mb-1" for="confirmPassword">Confirm new password</label>
                                        <input class="form-control" id="confirmPassword" type="password" name="confirmPassword" placeholder="Enter your new password" value="" required>
                                    </div>
                                    <input type="hidden" name="page" value="display">
                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" name="member_id" id="member_id" />
                                    <input type="hidden" name="operation" id="operation" />
                                    <button type="button" class="btn btn-white" data-dismiss="modal" id="btn_close">Close</button>
                                    <input type="submit" name="insertdata" id="insertdata" class="btn btn-primary" value="Save" />
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
-->

        </div>

        <?php
        include 'include/footer.php';
        ?>

    </div>
</div>


<?php
/*include "include/scripts.php";
*/?>
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

<!--<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>-->
<script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="js/plugins/slimscroll/jquery.slimscroll.js"></script>

<script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>

<!-- jQuery UI -->
<script src="js/plugins/jquery-ui/jquery-ui.min.js"></script>

<!-- Toastr -->
<script src="js/plugins/toastr/toastr.min.js"></script>
<!-- Custom and plugin javascript -->
<script src="js/inspinia.js"></script>
<script src="js/plugins/pace/pace.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"></script>
<style>
    td.details-control {
        background: url('https://cdn0.iconfinder.com/data/icons/it-internet-and-connection/189/coursor-click-512.png') no-repeat center center;
        background-size: 20px 20px;
        cursor: pointer;
    }
    tr.shown td.details-control {
        background: url('https://cdn3.iconfinder.com/data/icons/web-icons-22/512/right-click-512.png') no-repeat center center;
        background-size: 20px 20px;
    }

    td.detail-control {
        background: url('https://cdn3.iconfinder.com/data/icons/font-awesome-regular-1/512/calendar-plus-512.png') no-repeat center center;
        background-size: 20px 20px;
        cursor: pointer;
    }
    tr.shown td.detail-control {
        background: url('https://cdn3.iconfinder.com/data/icons/font-awesome-regular-1/512/calendar-minus-512.png') no-repeat center center;
        background-size: 20px 20px;
    }

    td.det-control {
        background: url('https://cdn4.iconfinder.com/data/icons/liny/24/clock-plus-line-512.png') no-repeat center center;
        background-size: 20px 20px;
        cursor: pointer;
    }
    tr.shown td.det-control {
        background: url('https://cdn0.iconfinder.com/data/icons/iconoteka-stroke/24/iconoteka_alarm_on_b_s-512.png') no-repeat center center;
        background-size: 20px 20px;
    }

/*  https://cdn4.iconfinder.com/data/icons/liny/24/clock-plus-line-512.png*/
    /*.tabela {
        font-size: 12px;
        width: 90%;
        max-width: 900px;
        margin: 0 auto;
        border-collapse: collapse;
        border: 1px solid black;
    }

    .tabela th,
    .tabela td {
        border: 1px solid black;
        padding: 8px;
    }

    .tables {
        font-size: 11px;
        width: 80%;
        max-width: 800px;
        margin: 0 auto;
        border: 1px solid #ffffff;
    }

    .tables th,
    .tables td {
        border: 1px solid #4b4141;
        padding: 8px;
    }
    .tabel {
        font-size: 11px;
        width: 70%;
        max-width: 700px;
        margin: 0 auto;
        border: 1px solid #ffffff;
    }

    .tabel th,
    .tabel td {
        border: 1px solid #4b4141;
        padding: 8px;
    }

    .tabelaLast {
        font-size: 11px;
        width: 60%;
        max-width: 600px;
        margin: 0 auto;
        border: 1px solid #ffffff;
    }

    .tabelaLast th,
    .tabelaLast td {
        border: 1px solid #4b4141;
        padding: 8px;
    }*/
</style>
<script>
    let dataTable;
    var validator;
    $(document).ready(function (){
        function format(d) {
            let username = d.username;

            //unique ID
            let tableId = 'table_' + username;

            let tableContent = '<div align="right">' +
                /*' <label for="start-date">Start Date:</label>' +
                '<input type="date" id="start-date">' +
                '<br><label for="end-date">End Date:</label>' +
                '<input type="date" id="end-date">' +
                '<br><button id="filter-btn" class="btn btn-primary">Apply Filter</button></div>'+*/
                '<table id="' + tableId + '" class="table table-bordered table-hover tabela">' +
                '<thead class="thead-dark"><tr><th></th><th>Year</th><th>Hours worked</th><th>Minutes worked</th><th>Seconds worked</th></tr></thead>' +
                '<tbody>';

            $('#filter-btn').on('click', function() {
                // Get start and end dates
                let startDate = $('#start-date').val();
                let endDate = $('#end-date').val();

                // Validate dates
                if (startDate === '' || endDate === '') {
                    alert('Please select both start and end dates.');
                    return;
                }

                // Pass dates to backend for filtering
                let ajaxData = {
                    operation: 'filterByDate',
                    startDate: startDate,
                    endDate: endDate,
                    username: username // Assuming username is accessible here
                };

                // Make AJAX request with date range filter
                $.ajax({
                    url: '../inspina/backend/fetchWorkingDays.php',
                    type: 'POST',
                    data: ajaxData,
                    dataType: 'json',
                    success: function(response) {
                        // Handle filtered data
                        // Update table or perform any other action
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr);
                        console.error(status);
                        console.error(error);
                        alert('Error fetching data.');
                    }
                });
            });

            let ajaxData = {
                operation: 'years',
                username: username
            };

            $.ajax({
                url: '../inspina/backend/fetchWorkingDays.php',
                type: 'POST',
                data: ajaxData,
                dataType: 'json',
                success: function(response) {

                    response.forEach(function(data) {
                        tableContent += '<tr><td></td><td>' + data.year + '</td><td>' + data.hours + '</td><td>' + data.minutes + '</td><td>' + data.seconds + '</td></tr>';
                    });
                    tableContent += '</tbody></table>';
                    // Show the table inside the row
                    $('#' + tableId + '_placeholder').html(tableContent).show(); // Show the content after updating

                    let table = new DataTable('#' + tableId, {
                        "paging": false,
                        "searching": false,
                        "processing": true,

                        columns: [
                            {
                                className: 'details-control',
                                orderable: false,
                                data: null,
                                defaultContent: ''
                            },
                            { data: 'year' },
                            { data: 'hours' },
                            { data: 'minutes' },
                            { data: 'seconds' }
                        ],
                        order: [[1, 'asc']]
                    });

                    $('#' + tableId).on('click', 'td.details-control', function () {
                        var tr = $(this).closest('tr');
                        var row = table.row( tr );

                        if ( row.child.isShown() ) {
                            // This row is already open - close it
                            row.child.hide();
                            tr.removeClass('shown');
                        }
                        else {
                            // Open this row
                            row.child( format(row.data()) ).show();
                            tr.addClass('shown');
                        }
                    });


                    function format(e) {
                        let username = d.username;
                        let year = e.year;

                        //unique ID
                        let tableId = 'table_' + year;

                        let tableContent = '<table id="' + tableId + '" class="table table-bordered table-hover tables">' +
                            '<thead class="thead-dark"><tr><th></th><th>Month</th><th>Hours worked</th><th>Minutes worked</th><th>Seconds worked</th></tr></thead>' +
                            '<tbody>';

                        let ajaxData = {
                            operation: 'Months',
                            year: year,
                            username: username
                        };

                        //bejme nje array me muajt
                        const monthsName = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

                        $.ajax({
                            url: '../inspina/backend/fetchWorkingDays.php',
                            type: 'POST',
                            data: ajaxData,
                            dataType: 'json',
                            success: function(response) {

                                response.forEach(function(data) {
                                    let monthName = monthsName[data.month - 1]
                                    tableContent += '<tr><td></td><td>' + monthName + '</td><td>' + data.hours + '</td><td>' + data.minutes + '</td><td>' + data.seconds + '</td></tr>';
                                });
                                tableContent += '</tbody></table>';
                                // Show the table inside the row
                                $('#' + tableId + '_placeholder').html(tableContent).show(); // Show the content after updating

                                let tableMonth = new DataTable('#' + tableId, {

                                    "paging": false,
                                    "searching": false,
                                    "processing": true,
                                    responsive: {
                                        details: {
                                            type: 'column',
                                            target: 'tr'
                                        }
                                    },
                                    columns: [
                                        {
                                            className: 'detail-control',
                                            orderable: false,
                                            data: null,
                                            defaultContent: ''
                                        },
                                        { data: 'month'},
                                        { data: 'hours' },
                                        { data: 'minutes' },
                                        { data: 'seconds' }
                                    ],

                                    order: {
                                        data: 'month',
                                        dir: 'asc'
                                    }
                                });

                                $('#' + tableId).on('click', 'td.detail-control', function () {
                                    var tr = $(this).closest('tr');
                                    var row = tableMonth.row( tr );

                                    if ( row.child.isShown() ) {
                                        row.child.hide();
                                        tr.removeClass('shown');
                                    }
                                    else {
                                        row.child( format(row.data()) ).show();
                                        tr.addClass('shown');
                                    }
                                });

                                function format(a) {
                                    let username = d.username;
                                    let year = e.year;
                                    let month = a.month;
                                    let date = new Date("2000 " + month + " 1");
                                    let monthNumber = date.getMonth();
                                    monthNumber += 1;

                                    //unique ID
                                    let tableId = 'table_' + month;

                                    let tableContent = '<table id="' + tableId + '" class="table table-bordered table-hover tabel">' +
                                        '<thead class="thead-dark"><tr><th></th><th>Data</th><th>Hours worked</th><th>Minutes worked</th><th>Seconds worked</th></tr></thead>' +
                                        '<tbody>';

                                    let ajaxData = {
                                        operation: 'Days',
                                        month : monthNumber,
                                        year: year,
                                        username: username
                                    };


                                    $.ajax({
                                        url: '../inspina/backend/fetchWorkingDays.php',
                                        type: 'POST',
                                        data: ajaxData,
                                        dataType: 'json',
                                        success: function(response) {

                                            response.forEach(function(data) {
                                                let dateObj = new Date(data.date_hyrje);
                                                let day = dateObj.getDate();
                                                let monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                                                let monthIndex = dateObj.getMonth();
                                                let monthName = monthNames[monthIndex];
                                                let formattedDate = day + ' ' + monthName;
                                                tableContent += '<tr><td></td><td>' + formattedDate + '</td><td>' + data.hours + '</td><td>' + data.minutes + '</td><td>' + data.seconds + '</td></tr>';
                                            });
                                            tableContent += '</tbody></table>';
                                            // Show the table inside the row
                                            $('#' + tableId + '_placeholder').html(tableContent).show(); // Show the content after updating

                                            let tableDays = new DataTable('#' + tableId, {

                                                "paging": false,
                                                "searching": false,
                                                "processing": true,

                                                columns: [
                                                    {
                                                        className: 'det-control',
                                                        orderable: false,
                                                        data: null,
                                                        defaultContent: ''
                                                    },
                                                    { data: 'data'},
                                                    { data: 'hours' },
                                                    { data: 'minutes' },
                                                    { data: 'seconds' }
                                                ],

                                                order: {
                                                    data: 'data',
                                                    dir: 'asc'
                                                }
                                            });

                                            $('#' + tableId).on('click', 'td.det-control', function () {
                                                var tr = $(this).closest('tr');
                                                var row = tableDays.row( tr );

                                                if ( row.child.isShown() ) {
                                                    row.child.hide();
                                                    tr.removeClass('shown');
                                                }
                                                else {
                                                    row.child( format(row.data()) ).show();
                                                    tr.addClass('shown');
                                                }
                                            });

                                            function format(b) {
                                                let username = d.username;
                                                let year = e.year;
                                                let monthName = a.month;
                                                let date = new Date("2000 " + monthName + " 1");
                                                let month = date.getMonth();
                                                month += 1;

                                                let dateStr = b.data;
                                                let parts = dateStr.split(' ');
                                                let day = parts[0];


                                                //unique ID
                                                let tableId = 'table_' + day;

                                                let tableContent = '<table id="' + tableId + '" class="table table-bordered table-hover tabelaLast">' +
                                                    '<thead class="thead-dark"><tr><th>Entered</th><th>Left</th><th>Difference</th></tr></thead>' +
                                                    '<tbody>';

                                                let ajaxData = {
                                                    operation: 'Hours',
                                                    month : month,
                                                    year: year,
                                                    day : day,
                                                    username: username
                                                };


                                                $.ajax({
                                                    url: '../inspina/backend/fetchWorkingDays.php',
                                                    type: 'POST',
                                                    data: ajaxData,
                                                    dataType: 'json',
                                                    success: function(response) {

                                                        response.forEach(function(data) {
                                                            tableContent += '<tr><td>' + data.ora_hyrje + '</td><td>' + data.ora_dalje + '</td><td>' + data.difference + '</td></tr>';
                                                        });
                                                        tableContent += '</tbody></table>';
                                                        // Show the table inside the row
                                                        $('#' + tableId + '_placeholder').html(tableContent).show(); // Show the content after updating

                                                        let tableHours = new DataTable('#' + tableId, {

                                                            "paging": false,
                                                            "searching": false,
                                                            "processing": true,
                                                            "info": false,

                                                            columns: [
                                                                { data: 'entered' },
                                                                { data: 'left' },
                                                                { data: 'difference'}
                                                            ],

                                                            order: {
                                                                data: 'entered',
                                                                dir: 'asc'
                                                            }
                                                        });

                                                    },
                                                    error: function(xhr, status, error) {
                                                        console.error(xhr);
                                                        console.error(status);
                                                        console.error(error);
                                                        $('#' + tableId + '_placeholder').html('Error fetching years.');
                                                    }

                                                });

                                                // Create a placeholder for the table
                                                let placeholderContent = '<div id="' + tableId + '_placeholder">Loading results...</div>';
                                                return placeholderContent;
                                            }


                                        },
                                        error: function(xhr, status, error) {
                                            console.error(xhr);
                                            console.error(status);
                                            console.error(error);
                                            $('#' + tableId + '_placeholder').html('Error fetching years.');
                                        }

                                    });

                                    // Create a placeholder for the table
                                    let placeholderContent = '<div id="' + tableId + '_placeholder">Loading results...</div>';
                                    return placeholderContent;
                                }


                            },
                            error: function(xhr, status, error) {
                                console.error(xhr);
                                console.error(status);
                                console.error(error);
                                $('#' + tableId + '_placeholder').html('Error fetching years.');
                            }

                        });

                        // Create a placeholder for the table
                        let placeholderContent = '<div id="' + tableId + '_placeholder">Loading results...</div>';
                        return placeholderContent;
                    }


                },
                error: function(xhr, status, error) {
                    console.error(xhr);
                    console.error(status);
                    console.error(error);
                    $('#' + tableId + '_placeholder').html('Error fetching years.');
                }

            });

            // Create a placeholder for the table
            let placeholderContent = '<div id="' + tableId + '_placeholder">Loading results...</div>';
            return placeholderContent;
        }


        dataTable = $('#memListTable').DataTable({
            "processing": true,
            "serverSide": true,
            // Make action column unorderable
            "columnDefs": [{
                "orderable": false,
                "targets": -1
            }],

            "ajax": {
                url: '../inspina/backend/fetchWorkingDays.php',
                method: "POST",
                data: function (data) {
                    data['operation'] = 'Insert';
                }
            },
            "columns": [
                {
                    "className": 'dt-control',
                    "orderable": false,
                    "data": null,
                    "defaultContent": ''
                },
                { "data": "id" },
                { "data": "name" },
                { "data": "lastname" },
                { "data": "username" },
                { "data": "email" },
                { "data": "birthday" },
                { "data": "phone" },
                { "data": "role",
                    "orderable": false},
                { "data": "action" },
            ]
        });

        dataTable.on('click', 'td.dt-control', function (e) {
            let tr = e.target.closest('tr');
            let row = dataTable.row(tr);

            if (row.child.isShown()) {
                row.child.hide();
            }
            else {
                row.child(format(row.data())).show();
            }
        });



        jQuery.validator.setDefaults({
            debug: true,
            success: "valid"
        });

        $.validator.addMethod("passwordRule", function (value, element) {
            return /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[.@$!%*?&])[A-Za-z\d.@$!%*?&]{8,}$/.test(value);
        }, 'Password must contain at least one uppercase, one lowercase, one digit, one special character')

        $.validator.addMethod("lettersOnly", function (value, element) {
            return /^[a-zA-Z]+$/.test(value);
        }, 'Only letters allowed!')

        $.validator.addMethod("phoneNum", function (value, element) {
            return /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/.test(value);
        }, 'Phone number is not valid!')

        $.validator.addMethod("over18", function(value) {
            var birthday = new Date(value);

            var today = new Date();
            var age = today.getFullYear() - birthday.getFullYear();
            var monthDiff = today.getMonth() - birthday.getMonth();
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthday.getDate())) {
                age--;
            }
            return age >=18;
        });

        $("#modal-form").validate({
            rules: {
                name: {
                    required: true,
                    lettersOnly: true
                },
                lastname: {
                    required: true,
                    lettersOnly: true
                },
                birthday: {
                    required: true,
                    over18: true
                },
                phone: {
                    required: true,
                    phoneNum: true
                },
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 8,
                    passwordRule: true
                },
                confirmPassword: {
                    required: true,
                    minlength: 8,
                    equalTo: '#password'
                },

            },
            messages: {
                name: {
                    required: "Please enter user firstname!",
                    lettersOnly: "Name should include letters only!"
                },
                lastname: {
                    required: "Please enter user lastname!",
                    lettersOnly: "Lastname should include letters only!"
                },
                birthday: {
                    required: "Please enter user birthday!",
                    over18: "User must be +18 years old!"
                },
                phone: {
                    required: "Please enter user phone number!",
                    phoneNum: "Enter a valid phone number!"
                },
                password: {
                    required: "Please provide a password!",
                    minlength: "Password should be at least 8 characters long",
                    passwordRule: "Password should contain at least 1 uppercase , 1 lowercase, 1 digit , and 1 special character and also be 8 characters long!"
                },
                confirmPassword: {
                    required: "Please confirm password!",
                    minlength: "Password should be at least 8 characters long",
                    equalTo: "Password does not match, please enter the same password as above!"
                }

            }

        })

        $('#modal-form input').on('input click', function() {
            var fieldName = $(this).attr('name');
            var errorElement = $('#' + fieldName + '-error');

            if (validator.element($(this))) {
                errorElement.addClass('hidden');
                $('#' + fieldName + '-error').addClass('hidden');
            } else {
                errorElement.removeClass('hidden');
                $('#' + fieldName + '-error').removeClass('hidden');
            }
        });


        var shown = '<?php
            if(isset($_SESSION['has_shown'])){
                echo $_SESSION['has_shown'];
            }
            else{
                echo 'false';
            }
            ?>';

        if (shown !== 'true') {
            setTimeout(function() {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 4000
                };
                toastr.success('Welcome <?php echo isset($_SESSION['name']) ? $_SESSION['name'] : ''; ?>', 'Intership project');

                // ruajme ne variablen has_shown true ne momentin qe ekzekutohet nje here
                <?php $_SESSION['has_shown'] = 'true'; ?>
            }, 1300);
        }

        $(document).on('click', '.delete', function(){
            var member_id = $(this).attr("id");
            if(confirm("Are you sure you want to delete this user?"))
            {
                $.ajax({
                    url:"../inspina/backend/deleteUser.php",
                    method:"POST",
                    data:{member_id:member_id},
                    success:function(data)
                    {
                        dataTable.ajax.reload();
                    }
                });
            }
            else
            {
                return false;
            }
        });


    });



    $(document).on('submit', '#modal-form', function(event) {
        event.preventDefault();
        if ($(this).valid()) {
            $.ajax({
                url: '../inspina/backend/fetchWorkingDays.php',
                method: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.includes('Email already exists!')) {
                        $('#email').after('<div class="error">' + data + '</div>');
                        $('.modal-backdrop').remove();
                        openModal();
                    } else {
                        closeModal();
                    }
                },
            });
        }
    });

    $(document).on('click', '.update', function(e){
        e.preventDefault();
        var member_id = $(this).attr("id");
        /*        var tr = $(this).closest('tr');
                var data = dataTable.rows(tr).data();
                $('#email').val(data[0][3]);*/

        var rowIndex = dataTable.row($(this).closest('tr')).index();
        var rowData = dataTable.row(rowIndex).data();

        $('#id').val(rowData.id);
        $('#name').val(rowData.name);
        $('#lastname').val(rowData.lastname);
        $('#birthday').val(rowData.birthday);
        $('#phone').val(rowData.phone);
        $('#email').val(rowData.email);
        $('.modal-title').text("Edit Member Details");
        $('#member_id').val(member_id);
        $('#insertdata').val("Update");
        $('#operation').val("Edit");
        $('#password').closest('.form-group').hide();
        $('#confirmPassword').closest('.form-group').hide();
        openModal();
    });

    $(document).on('click', '#addButton' ,function(){
        $('.modal-title').text("Add New Details");
        $('#insertdata').val("Save");
        $('#operation').val("Save");
        openModal();
    })
/*fshirjaaaaa e user*/


    function closeModal(){
        $('#modal-form')[0].reset();
        $('#password').closest('.form-group').show();
        $('#confirmPassword').closest('.form-group').show();
        $('#message').html('');
        $('.error').remove();
        $('#modalId').hide();
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
        $('.modal-title').text("Add New Details");
        $('#insertdata').val("Save");
        $('#operation').val("Save");
        dataTable.ajax.reload();
    }


    function openModal(){
        $('body').addClass('modal-open').append('<div class="modal-backdrop in"></div>');
        $('#modalId').show();
    }

    function resetFormValidation() {
        validator.resetForm();
        $('#modal-form .error').remove();
    }

</script>

</body>

</html>