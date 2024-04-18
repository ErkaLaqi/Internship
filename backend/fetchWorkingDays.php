<?php
session_start();
global $db_conn;

include "../include/dbConnection.php";

$request = $_REQUEST;
$col = array(
    0 => 'id',
    1 => 'name',
    2 => 'lastname',
    3 => 'birthday',
    4 => 'phone',
    5 => 'email'
); // create column like table in database

$loggedInUserId = $_SESSION['id'];

$sql = "SELECT * FROM users WHERE id = $loggedInUserId limit 1";

$role = $_SESSION['role'];

// select users based on supervisor_id
if ($role === 'admin') {
    // If supervisor_id is null, fetch all records
    $sql = "SELECT * FROM users";
} else if ($role === 'manager') {
    // If supervisor_id is not null, fetch records where supervisor_id matches the logged-in user's ID
    $sql = "SELECT * FROM users WHERE supervisor_id = $loggedInUserId OR id = $loggedInUserId";


    //when the manager creates a new user , this users supervisor_id should be immediately set to the manager id
    // that created him, so that he will be displayed at manager datatable
} else {
    $sql = "SELECT * FROM users WHERE id = $loggedInUserId ";
}
$query = mysqli_query($db_conn, $sql);

if ($loggedInUserId === null) {
    $sql = "SELECT * FROM users";
}
$totalData = mysqli_num_rows($query);

$totalFilter = $totalData;
// search
/*$sql = "SELECT * FROM users WHERE supervisor_id = $loggedInUserId";*/

if (!empty($request['search']['value'])) {
    $sql .= " AND (id Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR name Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR birthday Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR phone Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR email Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR lastname Like '%" . $request['search']['value'] . "%' )";
}
$query = mysqli_query($db_conn, $sql);
$totalData = mysqli_num_rows($query);

// order
if (isset($request['order'][0]['column']) && isset($request['order'][0]['dir'])) {
    $sql .= " ORDER BY " . $col[$request['order'][0]['column']] . " " . $request['order'][0]['dir'];
}

if (isset($request['start']) && isset($request['length'])) {
    $sql .= " LIMIT " . $request['start'] . ", " . $request['length'];
}

$query = mysqli_query($db_conn, $sql);

$data = array();

while ($row = mysqli_fetch_array($query)) {

    $subdata = array();
    $subdata[] = $row[0]; // id
    $subdata[] = $row[1]; // name
    $subdata[] = $row[2]; // lastname
    $subdata[] = $row[3]; // birthday
    $subdata[] = $row[4]; // phone
    $subdata[] = $row[5]; // email
    $subdata[] = $row[10]; //role
    // create event on click button edit in cell datatable for display modal dialog
    //$row[0] is in table on database


//if role== admin, show update, and delete button, else if role == manager or user show only edit , else if role== user dont show any of the buttons
    if ($role === 'admin') {
        $subdata[] = '<button type="button" name="update" data-id="'. $row[0] .'" class="btn btn-primary btn-sm update"><i class="glyphicon glyphicon-pencil"></i>&nbsp;Edit</button>' .
            '<button type="button" name="delete" data-id="'. $row[0] .'" class="btn btn-danger btn-sm delete"><i class="glyphicon glyphicon-trash"></i>&nbsp;Delete</button>';
    } else if ($role === 'manager' || $role === 'user' ) {
        $subdata[] = '<button type="button" name="update" data-id="'. $row[0] .'" class="btn btn-primary btn-sm update"><i class="glyphicon glyphicon-pencil"></i>&nbsp;Edit</button>';
    }
    $data[] = $subdata;
}

$json_data = array(
    "draw" => isset($request['draw']) ? intval($request['draw']) : 0,
    "recordsTotal" => intval($totalData),
    "recordsFiltered" => intval($totalFilter),
    "data" => $data
);
echo json_encode($json_data);
?>


