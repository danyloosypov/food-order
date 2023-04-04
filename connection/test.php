<?php
	$myPDO = new PDO('sqlite:test.db');

	if($myPDO) {
		 echo "scsdc";
	}

	$sql = "Select * from cart";

	foreach ($myPDO->query($sql) as $row) {
    print $row['qty'] . "\t";
    print $row['size'] . "\t";
    print $row['p_id'] . "\n";
}
?>