<?php
if (isset($_POST['change-status'])) {
	$id_education = $_POST['id_education'];
	$status = $_POST['radio'];
	echo "UPDATE education SET status=$status WHERE id_education=$id_education";
	//$sql = "UPDATE education SET status=$status WHERE id_education=$id_education";
}
