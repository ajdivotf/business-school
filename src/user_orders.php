<?php
include("manager_navigation.php");
include("db.php");

$sql_rejected = "SELECT education.id_education, education.status, education.apply_date, training_program.name_of_program, CONCAT(lastname, ' ', firstname) AS FIO FROM education INNER JOIN training_program ON training_program.id_program = education.id_program INNER JOIN student ON education.id_student = student.id_student WHERE education.status = 2;";
$sql_unhandle = "SELECT education.id_education, education.status, education.apply_date, training_program.name_of_program, CONCAT(lastname, ' ', firstname) AS FIO FROM education INNER JOIN training_program ON training_program.id_program = education.id_program INNER JOIN student ON education.id_student = student.id_student WHERE education.status = 0;";
$sql_handle = "SELECT education.id_education, education.status, education.apply_date, training_program.name_of_program, CONCAT(lastname, ' ', firstname) AS FIO FROM education INNER JOIN training_program ON training_program.id_program = education.id_program INNER JOIN student ON education.id_student = student.id_student WHERE education.status = 1;";
$sql = "SELECT education.id_education, education.status, education.apply_date, training_program.name_of_program, CONCAT(lastname, ' ', firstname) AS FIO FROM education INNER JOIN training_program ON training_program.id_program = education.id_program INNER JOIN student ON education.id_student = student.id_student;";

$count_rejected = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(1) FROM education  WHERE education.status = 2;"))[0];
$count_unhandle = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(1) FROM education  WHERE education.status = 0;"))[0];
$count_handle = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(1) FROM education  WHERE education.status = 1;"))[0];
$count = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(1) FROM education;"))[0];
echo "<section class='center'>
<ul id='tabs' class='nav nav-tabs' role='tablist'>
		<li class='nav-item'>
			<a class='nav-link' data-bs-toggle='tab' href='#all'><i class='fa-solid fa-list'></i><span style='padding-left:8px' class='tabs-text'>Все заявки</span><span class='round'>$count</span></a>
		</li>
		<li class='nav-item'>
			<a class='nav-link active' data-bs-toggle='tab' href='#unhandle'><i class='fa-solid fa-circle-question'></i><span style='padding-left:8px' class='tabs-text'>Необработанные</span><span class='round'>$count_unhandle</span></a>
		</li>
		<li class='nav-item'>
			<a class='nav-link' data-bs-toggle='tab' href='#accepted'><i class='fa-solid fa-square-check'></i><span style='padding-left:8px' class='tabs-text'>Принятые</span><span class='round'>$count_handle</span></a>
		</li>
		<li class='nav-item'>
			<a class='nav-link' data-bs-toggle='tab' href='#unaccepted'><i class='fa-solid fa-square-xmark'></i><span style='padding-left:8px' class='tabs-text'>Отклонённые</span><span class='round'>$count_rejected</span></a>
		</li>
	</ul>
	
	<!-- Tab panes -->
	<div class='tab-content'>
		<div id='unhandle' class='container tab-pane active'><br>";
// неразобранные заявки
echo "
<table id='unhandleOrders' class='table table-hover'>
  <tr class='t-head'>
  	<td><input style='width:16px;height:16px' type='checkbox' disabled></td>
    <td>№ заявки</td>
    <td>ФИО студента</td>
    <td>Название программы</td>
    <td>Дата заявки</td>
    <td>Статус</td>
  </tr>
";
$result_unhandle = mysqli_query($conn, $sql_unhandle);
$_monthsList = array(
	".01." => "января", ".02." => "февраля",
	".03." => "марта", ".04." => "апреля", ".05." => "мая", ".06." => "июня",
	".07." => "июля", ".08." => "августа", ".09." => "сентября",
	".10." => "октября", ".11." => "ноября", ".12." => "декабря"
);
while ($myrow = mysqli_fetch_array($result_unhandle)) {
	if ($myrow['status'] == 0) {
		$status = 'Рассматривается';
	}
	$apply_date = $myrow['apply_date'];
	$apply_date = date("d.m.Y", strtotime($apply_date));
	$_mD = date(".m.", strtotime($apply_date));
	$apply_date = str_replace($_mD, " " . $_monthsList[$_mD] . " ", $apply_date);
	echo "<tr>
	<td><input style='accent-color:rgb(170, 113, 245);width:16px;height:16px' type='checkbox' name='check' onclick='onlyOne(this)' data-order='" . $myrow['id_education'] . "'  data-fio='" . $myrow['FIO'] . "' data-name='" . $myrow['name_of_program'] . "' 
></td>
    <td>" . $myrow['id_education'] . "</td>
    <td>" . $myrow['FIO'] . "</td>
    <td>" . $myrow['name_of_program'] . "</td>
    <td>$apply_date</td>
    <td><span class='status'>$status</span></td>
  </tr>";
}
echo "</table></div>";

// все заявки

echo "<div id='all' class='container tab-pane fade'><br>";
echo "
<table id='allOrders' class='table table-hover'>
  <tr class='t-head'>
  	<td><input style='width:16px;height:16px' type='checkbox' disabled></td>
    <td>№ заявки</td>
    <td>ФИО студента</td>
    <td>Название программы</td>
    <td>Дата заявки</td>
    <td>Статус</td>
  </tr>
";
$result = mysqli_query($conn, $sql);
$_monthsList = array(
	".01." => "января", ".02." => "февраля",
	".03." => "марта", ".04." => "апреля", ".05." => "мая", ".06." => "июня",
	".07." => "июля", ".08." => "августа", ".09." => "сентября",
	".10." => "октября", ".11." => "ноября", ".12." => "декабря"
);
while ($myrow = mysqli_fetch_array($result)) {
	if ($myrow['status'] == 0) {
		$status = 'Рассматривается';
	} else if ($myrow['status'] == 1) {
		$status = 'Одобрена';
	} else if ($myrow['status'] == 2) {
		$status = 'Отказ';
	}
	$apply_date = $myrow['apply_date'];
	$apply_date = date("d.m.Y", strtotime($apply_date));
	$_mD = date(".m.", strtotime($apply_date));
	$apply_date = str_replace($_mD, " " . $_monthsList[$_mD] . " ", $apply_date);
	echo "<tr>
	<td><input style='accent-color:rgb(170, 113, 245);width:16px;height:16px' type='checkbox' name='check' onclick='onlyOne(this)' data-order='" . $myrow['id_education'] . "'  data-fio='" . $myrow['FIO'] . "' data-name='" . $myrow['name_of_program'] . "' 
></td>
    <td>" . $myrow['id_education'] . "</td>
    <td>" . $myrow['FIO'] . "</td>
    <td>" . $myrow['name_of_program'] . "</td>
    <td>$apply_date</td>
    <td><span class='status'>$status</span></td>
  </tr>";
}
echo "</table>";
echo "</div>";

// принятые заявки

echo "<div id='accepted' class='container tab-pane fade'><br>";
echo "
<table id='acceptedOrders' class='table table-hover'>
  <tr class='t-head'>
  	<td><input style='width:16px;height:16px' type='checkbox' disabled></td>
    <td>№ заявки</td>
    <td>ФИО студента</td>
    <td>Название программы</td>
    <td>Дата заявки</td>
    <td>Статус</td>
  </tr>
";
$result_handle = mysqli_query($conn, $sql_handle);
$_monthsList = array(
	".01." => "января", ".02." => "февраля",
	".03." => "марта", ".04." => "апреля", ".05." => "мая", ".06." => "июня",
	".07." => "июля", ".08." => "августа", ".09." => "сентября",
	".10." => "октября", ".11." => "ноября", ".12." => "декабря"
);
while ($myrow = mysqli_fetch_array($result_handle)) {
	if ($myrow['status'] == 1) {
		$status = 'Одобрена';
	}
	$apply_date = $myrow['apply_date'];
	$apply_date = date("d.m.Y", strtotime($apply_date));
	$_mD = date(".m.", strtotime($apply_date));
	$apply_date = str_replace($_mD, " " . $_monthsList[$_mD] . " ", $apply_date);
	echo "<tr>
	<td><input style='accent-color:rgb(170, 113, 245);width:16px;height:16px' type='checkbox' name='check' checked onclick='onlyOne(this)' data-order='" . $myrow['id_education'] . "'  data-fio='" . $myrow['FIO'] . "' data-name='" . $myrow['name_of_program'] . "' 
></td>
    <td>" . $myrow['id_education'] . "</td>
    <td>" . $myrow['FIO'] . "</td>
    <td>" . $myrow['name_of_program'] . "</td>
    <td>$apply_date</td>
    <td><span class='status'>$status</span></td>
  </tr>";
}
echo "</table>";
echo "</div>";

// отклоненные заявки
echo "<div id='unaccepted' class='container tab-pane fade'><br>";
echo "
<table id='unacceptedOrders' class='table table-hover'>
  <tr class='t-head'>
  	<td><input style='width:16px;height:16px' type='checkbox' disabled></td>
    <td>№ заявки</td>
    <td>ФИО студента</td>
    <td>Название программы</td>
    <td>Дата заявки</td>
    <td>Статус</td>
  </tr>
";
$result_rejected = mysqli_query($conn, $sql_rejected);
$_monthsList = array(
	".01." => "января", ".02." => "февраля",
	".03." => "марта", ".04." => "апреля", ".05." => "мая", ".06." => "июня",
	".07." => "июля", ".08." => "августа", ".09." => "сентября",
	".10." => "октября", ".11." => "ноября", ".12." => "декабря"
);
while ($myrow = mysqli_fetch_array($result_rejected)) {
	if ($myrow['status'] == 2) {
		$status = 'Отказ';
	}
	$apply_date = $myrow['apply_date'];
	$apply_date = date("d.m.Y", strtotime($apply_date));
	$_mD = date(".m.", strtotime($apply_date));
	$apply_date = str_replace($_mD, " " . $_monthsList[$_mD] . " ", $apply_date);
	echo "<tr>
	<td><input style='accent-color:rgb(170, 113, 245);width:16px;height:16px' type='checkbox' name='check' onclick='onlyOne(this)' data-order='" . $myrow['id_education'] . "'  data-fio='" . $myrow['FIO'] . "' data-name='" . $myrow['name_of_program'] . "' 
></td>
    <td>" . $myrow['id_education'] . "</td>
    <td>" . $myrow['FIO'] . "</td>
    <td>" . $myrow['name_of_program'] . "</td>
    <td>$apply_date</td>
    <td><span class='status'>$status</span></td>
  </tr>";
}
echo "</table>";
echo "</div>";

echo "</div>";
echo "</section>";
?>
<style>
	#order-count {
		font-size: 22px;
		padding-top: 20px;
		padding-left: 30px;
	}

	.center {
		background-color: white;
		margin: 50px auto 0 auto;
		border-radius: 10px;
		height: 600px;
		width: 1300px;
	}

	body {
		background-color: rgb(236, 239, 255) !important;
	}

	.table {
		width: 1200px !important;
		font-size: 14px;
		margin-left: auto;
		margin-right: auto;
	}

	.table-hover tbody tr:hover,
	.table-hover tbody tr:hover td,
	.table-hover tbody tr:hover th {
		background-color: rgb(236, 239, 255) !important;
	}

	td {
		height: 50px;
		vertical-align: middle;
	}

	.t-head {
		font-size: 13px;
	}

	.status {
		background-color: rgb(236, 239, 255);
		padding: 2px 5px;
		border-radius: 5px;
	}

	.button-s {
		background-color: #9C32C2;
		padding: 10px;
		color: white;
		border: none;
		border-radius: 10px;
	}

	input[type="button"] {
		transition: all .3s;
		border: none;
		padding: 8px 16px;
		text-decoration: none;
		border-radius: 5px;
		font-size: 15px;
	}

	input[type="button"]:not(.active-page-btn) {
		background-color: transparent;
	}

	.active-page-btn {
		background-color: rgb(170, 113, 245);
		color: #fff;
	}

	input[type="button"]:hover:not(.active-page-btn) {
		background-color: rgb(236, 239, 255);
	}
</style>
<script src="page_orders_table.js"></script>
<script>
	function onlyOne(checkbox) {
		$('#change_modal').modal('show');
		let checkboxes = document.getElementsByName('check')
		checkboxes.forEach((item) => {
			if (item !== checkbox) item.checked = false
		});
		let id_education = checkbox.dataset.order;
		let fio = checkbox.dataset.fio;
		let name = checkbox.dataset.name;
		const modal = $('#change_modal');
		modal.find('.modal-body #fio').val(fio);
		modal.find('.modal-body #name').val(name);
		modal.find('#id_education').val(id_education);
	}
</script>

<head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<!--для изменения статуса заявки-->
<div class="m-4">
	<div id="change_modal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Изменить статус заявки?</h4>
				</div>
				<form method="post" action="user_orders.php">
					<div class="modal-body">
						<input type="hidden" id="id_education" name="id_education">
						<link rel="stylesheet" type="text/css" href="styles4.css" />

						<div class='container' style="max-width: 500px; margin-left: auto; margin-right: auto;">
							<div class="text-field text-field_floating-2">
								<input class="text-field__input" id="fio" name="fio" readonly>
								<label class="text-field__label" for="fio">Студент</label>
							</div>
						</div>
						<div class='container' style="max-width: 500px; margin-left: auto; margin-right: auto;">
							<div class="text-field text-field_floating-2">
								<input class="text-field__input" id="name" name="name" readonly>
								<label class="text-field__label" for="name">Программа обучения</label>
							</div>
						</div>

						<link rel="stylesheet/less" type="text/css" href="styles3.less" />
						<script src="https://cdn.jsdelivr.net/npm/less@4.1.1"></script>
						<div class="container">
							<div class="radio">
								<input type="radio" value="1" name="radio" id="radio1" class="radio__input" checked>
								<label for="radio1" class="radio__label">Принять заявку</label>
							</div><br>
							<div class="radio">
								<input type="radio" value="2" name="radio" id="radio2" class="radio__input">
								<label for="radio2" class="radio__label">Отклонить заявку</label>
							</div><br>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="button-s" data-bs-dismiss="modal">Закрыть</button>
						<button type="submit" name="change_status" class="button-s"> Изменить статус</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php
if (isset($_POST['change_status']) and $_POST['radio'] != 0) {
	$id_education = $_POST['id_education'];
	$status = $_POST['radio'];
	echo "UPDATE education SET status=$status WHERE id_education=$id_education";
	$sql3 = "UPDATE education SET status=$status WHERE id_education=$id_education";
	$result = mysqli_query($conn, $sql3);
	if ($result == true) {
		echo "Данные успешно сохранены";
		echo "<script> document.location.href = 'user_orders.php'</script>";
	} else {
		echo "Ошибка";
	}
}
?>