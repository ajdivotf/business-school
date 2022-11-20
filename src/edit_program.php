<?php
include("manager_navigation.php");
$id_program = $_POST['id_program'];
include("db.php");
$sql = "SELECT * FROM training_program INNER JOIN subcategory ON training_program.id_subcategory = subcategory.id_subcategory INNER JOIN document ON training_program.id_document=document.id_document INNER JOIN type_of_certification ON training_program.id_certification = type_of_certification.id_certification INNER JOIN form_of_education ON training_program.id_form = form_of_education.id_form WHERE id_program=$id_program;";
$result = mysqli_query($conn, $sql);
$sql1 = "SELECT id_subcategory, name_of_subcategory FROM subcategory;";
$result1 = mysqli_query($conn, $sql1);
$sql2 = "SELECT * FROM document;";
$result2 = mysqli_query($conn, $sql2);
$sql3 = "SELECT * FROM type_of_certification;";
$result3 = mysqli_query($conn, $sql3);
$sql4 = "SELECT * FROM form_of_education;";
$result4 = mysqli_query($conn, $sql4);

?>
<script src="selector.js"></script>
<link rel="stylesheet/less" href="big_selector.less" />
<link rel="stylesheet" type="text/css" href="styles7.css">
<script src="https://cdn.jsdelivr.net/npm/less@4.1.1"></script>
<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js'></script>
<div class="container">

	<?php while ($myrow = mysqli_fetch_array($result)) {	?>
		<h3 style='padding-top:20px;'>Редактирование курса</h3>
		<p class="grey-text" style="margin-bottom:-6px">Все поля должны быть заполнены</p>
		<form action='manager_profile.php' method='POST' class='form-group'>
			<div class="row">
				<div class="col">
					<p class="bold-text">Название курса</p>
					<input type='text' id='input-name' name='program_name' class='form-control' value='<?php echo $myrow['name_of_program']; ?>'>
					<p class="grey-text">Не более 20 символов</p>
					<p class="bold-text" style="margin-top:-20px">Форма обучения</p>
					<div id="id_education_form">
						<?php while ($row4 = mysqli_fetch_array($result4)) {
							if (strcasecmp($row4['name_of_form'], $myrow['name_of_form']) == 0) {
						?>
								<label><input type="radio" name="education_form" value="<?php echo $row4['id_form']; ?>" checked><span><?php echo $row4['name_of_form']; ?></span></label>
							<?php } else {
							?>
								<label><input type="radio" name="education_form" value="<?php echo $row4['id_form']; ?>"><span><?php echo $row4['name_of_form']; ?></span></label>
							<?php } ?>
						<?php } ?>
					</div>
					<style>
						#id_education_form {
							padding-top: 10px;
						}

						#id_education_form input[type="radio"] {
							display: none;
						}

						#id_education_form span {
							display: inline-block;
							padding: 3px 8px;
							border: 1.5px solid rgb(236, 239, 255);
							background-color: white;
							border-radius: 10px;
							color: rgb(170, 113, 245);
						}

						#id_education_form input[type="radio"]:checked+span,
						#id_education_form input[type="radio"]:hover+span {
							background-color: rgb(170, 113, 245);
							border: 1.5px solid rgb(170, 113, 245);
							color: white;
						}
					</style>
					<p class="bold-text">Категория курса</p>
					<select id="normal-select-1" name='program_category' placeholder-text="<?php echo $myrow['name_of_subcategory']; ?>" value='<?php echo $myrow['name_of_subcategory']; ?>'>
						<nobr>
							<?php while ($row1 = mysqli_fetch_array($result1)) {
								if (strcasecmp($row1['name_of_subcategory'], $myrow['name_of_subcategory']) == 0) {
							?>
									<option value="<?php echo $row1['id_subcategory']; ?>" class="select-dropdown__list-item" selected><?php echo $row1['name_of_subcategory']; ?></option>
								<?php } else {
								?>
									<option value="<?php echo $row1['id_subcategory']; ?>" class="select-dropdown__list-item"><?php echo $row1['name_of_subcategory']; ?></option>
								<?php } ?>
							<?php } ?>
					</select>
					<div id="course-data">
						<p class="bold-text" style="padding-bottom:15px">Данные о курсе</p>
						<nobr id="btn-course-data">
							<span>Тип курса, тип документа, вид сертификации</span><span id="course-data-status">По умолчанию</span><i style="padding-left:20px" class="fa-solid fa-angle-down"></i>
						</nobr>
						<div id="selectors" style="display:none">
							<p class="bold-text">Тип курса</p>
							<select id="normal-select-2" name='program_type' placeholder-text="<?php echo $myrow['type_of_program']; ?>" value="<?php echo $myrow['type_of_program']; ?>">
								<?php
								if (strcasecmp("Повышение квалификации", $myrow['type_of_program']) == 0) {
								?>
									<option value="Повышение квалификации" class="select-dropdown__list-item" selected>Повышение квалификации</option>
									<option value="Переобучение" class="select-dropdown__list-item">Переобучение</option>
								<?php } else {
								?>
									<option value="Повышение квалификации" class="select-dropdown__list-item">Повышение квалификации</option>
									<option value="Переобучение" class="select-dropdown__list-item" selected>Переобучение</option>
								<?php } ?>
							</select>
							<p class="bold-text">Тип документа<span data-bs-toggle='tooltip' data-bs-placement='top' title='Какой документ будет получен по окончании курса'>
									<i style="color:rgb(170, 113, 245)" class="fa-solid fa-circle-question"></i>
								</span></p>
							<select id="normal-select-3" name='program_doc' placeholder-text="<?php echo $myrow['name_of_document']; ?>" value='<?php echo $myrow['name_of_document']; ?>'>
								<nobr>
									<?php while ($row2 = mysqli_fetch_array($result2)) {
										if (strcasecmp($row2['name_of_document'], $myrow['name_of_document']) == 0) {
									?>
											<option value="<?php echo $row2['id_document']; ?>" class="select-dropdown__list-item" selected><?php echo $row2['name_of_document']; ?></option>
										<?php } else {
										?>
											<option value="<?php echo $row2['id_document']; ?>" class="select-dropdown__list-item"><?php echo $row2['name_of_document']; ?></option>
										<?php } ?>
									<?php } ?>
							</select>
							<p class="bold-text">Вид сертификации</p>
							<select id="normal-select-4" name='certification_type' placeholder-text="<?php echo $myrow['name_of_certification']; ?>" value="<?php echo $myrow['id_certification']; ?>">
								<?php while ($row3 = mysqli_fetch_array($result3)) {
									if (strcasecmp($row3['name_of_certification'], $myrow['name_of_certification']) == 0) {
								?>
										<option value="<?php echo $row3['id_certification']; ?>" class="select-dropdown__list-item" selected><?php echo $row3['name_of_certification']; ?></option>
									<?php } else {
									?>
										<option value="<?php echo $row3['id_certification']; ?>" class="select-dropdown__list-item"><?php echo $row3['name_of_certification']; ?></option>
									<?php } ?>
								<?php } ?>
							</select>
						</div>
					</div>
					<p class="bold-text">Описание<span data-bs-toggle='tooltip' data-bs-placement='top' title='Краткое описание курса'>
							<i style="color:rgb(170, 113, 245)" class="fa-solid fa-circle-question"></i>
						</span></p>
					<textarea type='text' style="resize: none;height:100px;" id='input-description' name='description' class='form-control'><?php echo $myrow['description']; ?></textarea>
					<p class="grey-text">Не более 100 символов</p>
				</div>
				<div class="col">
					<p class="bold-text">Иконка<span data-bs-toggle='tooltip' data-bs-placement='top' title='Введите название класса font-awesome'>
							<i style="color:rgb(170, 113, 245)" class="fa-solid fa-circle-question"></i>
						</span></p>
					<div id="preview-icon" style="display: none;">
						<input type="text" id="input-icon" name="icon" class="form-control" value="<?php echo $myrow['icon']; ?>">
						<p id="new-icon" class="btn-submit">Применить</p>
					</div>
					<i class="<?php echo $myrow['icon']; ?> fa-8x" id="change-icon" style="color:rgb(170, 113, 245);background-color:white;padding:15px;border-radius:3px;"></i>
					<p class="grey-text" style="padding-top:10px;width:480px">Иконка должна быть только одна, причём она должна
						отвечать требованиям создателя курса.
						Нельзя изменять размер иконки. Изменить вид иконки можно по нажатию на неё.</p>
					<div class="row">
						<div class="col">
							<p class="bold-text">Цена</p>
							<input type='number' id='input-price' name='price' class='form-control' value='<?php echo $myrow['price']; ?>'>
						</div>
						<div class="col">
							<p class="bold-text">Количество часов</p>
							<input type='number' id='input-hours' name='hours' class='form-control' value='<?php echo $myrow['number_of_hours']; ?>'>
						</div>
					</div>
					<div class="btn-div" style="padding-top:90px">
						<input type='hidden' name='id_program' value='<?php echo $id_program; ?>'>
						<button class="btn-submit" type="submit" name="submit-data">Сохранить</button>
						<button id="b-cancel" class="btn-submit">Отменить</button>
					</div>
				</div>
			</div>
		</form>
	<?php } ?>

</div>
<style>

</style>
<script>
	$(document).on('click', '#btn-course-data', function() {
		if ($(this).children("i").hasClass("fa-angle-down")) {
			$(this).children("i").removeClass("fa-angle-down").addClass("fa-angle-up");
			$("#selectors").css("display", "");
			//если изменяются данные, то $("#course-data-status").css("background-color", "rgb(170, 113, 245)");

		} else {
			$(this).children("i").removeClass("fa-angle-up").addClass("fa-angle-down");
			$("#selectors").css("display", "none");
			//$("#course-data-status").css("background-color", "rgb(236, 239, 255)");
			//если изменяются данные, то $("#course-data-status").text("Изменено");
		}
	})
	$(document).on('click', '#selectors', function() {
		$("#btn-course-data").children("i").css("padding-left", "47px");

		$("#course-data-status").css("background-color", "rgb(170, 113, 245)");
		$("#course-data-status").css("background-color", "rgb(170, 113, 245)");
		$("#course-data-status").text("Изменено");
	})
	$(document).on('click', '#change-icon', function() {
		$(this).hide();
		$("#preview-icon").show();
	})
	$(document).on('click', '#new-icon', function() {
		$("#preview-icon").hide();
		$("#change-icon").show();
		$("#change-icon").removeClass();
		if ($("#input-icon").val() !== "") {
			$("#change-icon").addClass($("#input-icon").val() + " fa-8x");

		} else {
			$("#change-icon").addClass("fa-solid fa-circle-question fa-8x");
		}
	})
	$(document).on('click', '#b-cancel', function() {
		window.location.href = 'manager_profile.php';
	})
	var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
	var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
		return new bootstrap.Tooltip(tooltipTriggerEl)
	})
</script>