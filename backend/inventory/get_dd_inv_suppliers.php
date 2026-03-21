<?php
session_start();
error_reporting(0);
include('../../config/cfg.php');

if (isset($_GET['security']) && $_GET['security'] == '123465') {
    $sql = "SELECT supplier_id, supplier_name FROM inv_suppliers WHERE status = '1' ORDER BY supplier_name ASC";
    $select = "";

    if ($result = $conn->query($sql)) {
        $select .= "<option disabled selected value='0'>Select Supplier</option>";

        while ($row = $result->fetch_assoc()) {
            $supplier_id   = (int)$row['supplier_id'];
            $supplier_name = htmlspecialchars($row['supplier_name'], ENT_QUOTES, 'UTF-8');
            $select .= "<option value='{$supplier_id}'>{$supplier_name}</option>";
        }

        $result->free();
    }

    echo $select;
    exit;
}
?>