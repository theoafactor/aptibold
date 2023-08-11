<?php

	// Import connections file
	require '../sql_connections.php';

    // Get SNo
    $sno = (int)$_POST["sno"];

    // Establish database connectoon
	$conn = getConn();

    $sql_stmt = "DELETE FROM scores WHERE SNO=:sno";
    $stmt     = $conn->prepare($sql_stmt);
    $stmt->execute([":sno" => $sno]);

    header("Location: index.php");
    die();
?>