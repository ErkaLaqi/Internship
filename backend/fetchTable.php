<?php
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

$sql = "SELECT * FROM users";
$query = mysqli_query($db_conn, $sql);

$totalData = mysqli_num_rows($query);

$totalFilter = $totalData;
// search
$sql = "SELECT * FROM users WHERE 1=1";

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
    $subdata[] = '<button type="button" id="'.$row[0].'" name="update" class="btn btn-primary btn-sm update" data-toggle="modal" data-target="#modalForm" data-id="' . $row[0] . '"> <i class="glyphicon glyphicon-pencil">&nbsp;</i>Edit</button>';
    $subdata[] = '<button type="button" id="'.$row[0].'" name="delete" class="btn btn-danger btn-sm delete" onclick="deleteUser(' . $row[0] . ')"><i class="glyphicon glyphicon-trash">&nbsp;</i>Delete</button>';

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


