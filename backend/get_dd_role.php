<?php
session_start();
error_reporting(0);
include('../config/cfg.php');

if (isset($_GET['security']) && $_GET['security'] === '123465') {

    // make sure dept_id exists + force integer
    $dept_id = isset($_GET['dept_id']) ? (int)$_GET['dept_id'] : 0;

    // if no dept selected, return just the placeholder
    if ($dept_id <= 0) {
        echo "<option disabled selected>Select Role</option>";
        exit;
    }

    $sql = "SELECT role_id, role_name
            FROM mgmt_roles
            WHERE department_id = $dept_id
            ORDER BY role_name ASC";

    $select = "<option disabled selected>Select Role</option>";

    if ($result = $conn->query($sql)) {
        while ($row = $result->fetch_assoc()) {
            $rid   = (int)$row['role_id'];
            $rname = htmlspecialchars($row['role_name'] ?? '', ENT_QUOTES, 'UTF-8');
            $select .= "<option value=\"$rid\">$rname</option>";
        }
        $result->free();
    }

    echo $select;
    exit;
}
echo "";
