<?php
include("manager_navigation.php");
include("db.php");
$count_programs = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(1) FROM education INNER JOIN training_program ON training_program.id_program = education.id_program;"))[0];
$total_sum = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(training_program.price) FROM education INNER JOIN training_program ON training_program.id_program = education.id_program;"))[0];
$sql = "SELECT training_program.name_of_program, training_program.type_of_program, type_of_program, training_program.price, COUNT(education.id_education) AS count, SUM(training_program.price) AS total_sum FROM education INNER JOIN training_program ON training_program.id_program = education.id_program GROUP BY training_program.name_of_program, training_program.type_of_program, training_program.price ORDER BY COUNT(education.id_education) DESC, training_program.price DESC;";
$sql2 = "SELECT username, CONCAT(lastname, ' ', firstname) AS fio, COUNT(education.id_education) AS count, SUM(price) AS total_sum FROM student INNER JOIN education ON student.id_student = education.id_student INNER JOIN training_program ON education.id_program = training_program.id_program GROUP BY CONCAT(lastname, ' ', firstname) ORDER BY SUM(price) DESC;";
$result1 = mysqli_query($conn, $sql);
$result2 = mysqli_query($conn, $sql);
$result3 = mysqli_query($conn, $sql2);
$result4 = mysqli_query($conn, $sql2);
$result5 = mysqli_query($conn, $sql);
$result6 = mysqli_query($conn, $sql2);
echo "
<head>
	<script src='pie_func.js'></script>
	<script src='download_report.js'></script>
	<script src='https://d3js.org/d3.v4.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js'></script>
    <link rel='stylesheet' type='text/css' href='styles5.css'>
</head>";
echo "<body>";
echo "<div class='card' style='width:1465px;margin-top:30px;margin-left:25px;'>
			<div class='card-body'>
				<div>
					<h4 class='card-title'>Общая сумма выручки</h4>
					<p class='card-subtitle' style='color:rgb(170, 113, 245);'>$total_sum ₽</p>
				</div>
				<div class='params'>
					<button class='btn-choose choose-programs'>Программы</button>
					<button class='btn-choose choose-students'>Студенты</button>
					<button class='btn-choose choose-all active'>Все отчёты</button>
				</div>
				<style>
					.btn-choose, .btn-download{
						position: relative;
						border-radius: 10px;
						border: none;
						margin-top: 5px;
						margin-left: 10px;
						background-color: rgb(236, 239, 255);
						padding: 2px 6px;
					}
					.btn-choose:hover, .active{
						background-color: rgb(170, 113, 245);
						color: white;
					}
				</style>
			</div>
		</div>";
echo "
<div id='program-text'>
	<h4 style='padding-left:30px;padding-top:30px;margin-bottom:-10px;';>Рейтинг программ обучения</h4>
	<i style='margin-bottom:25px;margin-top:-20px;margin-left:25px;'class='fa-solid fa-file-export btn-download' id='report-programs'></i>
</div>
<div class='rate-container programs-container visible-container' style='margin-bottom:20px'>";
echo "<div class='card-table'>";
$count = 0;
// первая таблица
while ($myrow1 = mysqli_fetch_array($result1)) {
	if ($count <= 2) {
		$star = "<i class='fa-solid fa-star'></i>";
	} else $star = "";
	$count++;
	echo "<div class='card'>
			<div class='card-body'>
				<div>
					<h4 class='card-title'>" . $myrow1['name_of_program'] . "$star</h4>
					<p class='card-subtitle'>" . $myrow1['type_of_program'] . "</p>
				</div>
				<div class='params'>
					<strong style='padding-left:15px;'>" . $myrow1['price'] . "₽</strong><br>
					<p>за единицу</p>
				</div>
				<div class='params' style='margin-left:120px;'>
					<strong style='padding-left:30px;'>" . $myrow1['count'] . "</strong><br>
					<p>слушателя</p>
				</div>
				<div class='params' style='margin-left:240px;'>
					<strong style='padding-left:10px;'>" . $myrow1['total_sum'] . "₽</strong><br>
					<p>в общем</p>
				</div>
		
			</div>
		</div>";
}
echo "</div>";
// первый график
echo "<div class='rating' style='height: 330px;'>
		<div id='course-chart'></div>
	</div>";
echo "</div>";
echo "
<div id='student-text'>
	<h4 style='padding-left:30px;padding-top:30px;margin-bottom:-10px;';>Рейтинг студентов</h4>
	<i style='margin-bottom:25px;margin-top:-20px;margin-left:25px;'class='fa-solid fa-file-export btn-download' id='report-students'></i>
</div>
<div class='rate-container student-container visible-container' style='padding-bottom:30px;'>";
echo "<div class='card-table'>";
// вторая таблица
$count = 0;
while ($myrow1 = mysqli_fetch_array($result3)) {
	if ($count <= 2) {
		$star = "<i class='fa-solid fa-star'></i>";
	} else $star = "";
	if ($count <= 5) {
		echo "<div class='card'>
			<div class='card-body'>
				<div>
					<h4 class='card-title'>" . $myrow1['fio'] . "$star</h4>
					<p class='card-subtitle'>" . $myrow1['username'] . "</p>

				</div>
				<div class='params' style='margin-left:120px;'>
					<strong style='padding-left:30px;'>" . $myrow1['count'] . "</strong><br>
					<p>программы</p>
				</div>
				<div class='params' style='margin-left:240px;'>
					<strong style='padding-left:10px;'>" . $myrow1['total_sum'] . "₽</strong><br>
					<p>в общем</p>
				</div>
		
			</div>
		</div>";
	}
	$count++;
}
echo "</div>";
// второй график
echo "<div class='rating'>
		<div id='student-chart'></div>
	</div>";
echo "</div>";
// данные первого графика
echo "</body>";
echo "<script>
const data=[";
while ($myrow22 = mysqli_fetch_array($result2)) {
	$val = $myrow22['count'] / $count_programs * 100;
	echo "{
			name: '" . $myrow22['name_of_program'] . "',
			value: '$val'
		},";
}
echo "];";
// данные второго графика
echo "const data1=[";
while ($myrow5 = mysqli_fetch_array($result4)) {
	$val = $myrow5['total_sum'] / $total_sum * 100;
	echo "{
			'name': '" . $myrow5['fio'] . "',
			'value': '$val'
		},";
}
echo "];";
echo "$(document).on('click', '#report-programs', function() {";
// по нажатию на кнопку получаем данные для отчета
echo "const data_programs_for_download=[";
echo "['Программа обучения', 'Вид программы', 'Стоимость за ед', 'Кол-во слушателей', 'На сумму'],";
while ($myrow6 = mysqli_fetch_array($result5)) {
	echo "[
		'" . $myrow6['name_of_program'] . "',  
		'" . $myrow6['type_of_program'] . "',  
		'" . $myrow6['price'] . "₽',  
		'" . $myrow6['count'] . "',  
		'" . $myrow6['total_sum'] . "₽'
	],";
}
echo "['', '', 'Итого', '$count_programs', '" . $total_sum . "₽'],";
echo "];";
// другие действия в кликере
echo "
	download(data_programs_for_download);
";
echo "});";
echo "$(document).on('click', '#report-students', function() {";
// по нажатию на кнопку получаем данные для отчета
echo "const data_students_for_download=[";
echo "['ФИО слушателя', 'Количество программ программы', 'На сумму'],";
while ($myrow7 = mysqli_fetch_array($result6)) {
	echo "[
		'" . $myrow7['fio'] . "',  
		'" . $myrow7['count'] . "',  
		'" . $myrow7['total_sum'] . "₽',  
	],";
}
echo "['Итого', '$count_programs', '" . $total_sum . "₽'],";
echo "];";
// другие действия в кликере
echo "
	download(data_students_for_download);
";
echo "});";
// рисуем графики по первым пяти позициях в данных
echo "
	d3_pie(data.slice(0, 5), '#course-chart');
	d3_pie(data1.slice(0, 5), '#student-chart');
</script>";
?>
<script>
	$(document).on('click', '.choose-programs', function() {
		const programs = $('.programs-container');

		programs.removeClass('invisible-container');
		programs.addClass('visible-container');
		const student = $('.student-container');
		student.removeClass('visible-container');
		student.addClass('invisible-container');
		//
		const pr_text = $('#program-text');
		const st_text = $('#student-text');
		pr_text.removeClass('invisible-container');
		pr_text.addClass('visible-container');
		st_text.removeClass('visible-container');
		st_text.addClass('invisible-container');

		//
		$('.btn-choose').removeClass('active');
		$('.choose-programs').addClass('active');

	});
	$(document).on('click', '.choose-students', function() {
		const programs = $('.programs-container');
		programs.addClass('invisible-container');
		programs.removeClass('visible-container');
		const student = $('.student-container');
		student.addClass('visible-container');
		student.removeClass('invisible-container');
		//
		const pr_text = $('#program-text');
		const st_text = $('#student-text');
		pr_text.addClass('invisible-container');
		pr_text.removeClass('visible-container');
		st_text.addClass('visible-container');
		st_text.removeClass('invisible-container');
		//
		$('.btn-choose').removeClass('active');
		$('.choose-students').addClass('active');

	});

	$(document).on('click', '.choose-all', function() {
		const programs = $('.programs-container');
		programs.addClass('visible-container');
		programs.removeClass('invisible-container');
		const student = $('.student-container');
		student.addClass('visible-container');
		student.removeClass('invisible-container');
		//
		const pr_text = $('#program-text');
		const st_text = $('#student-text');
		pr_text.addClass('visible-container');
		pr_text.removeClass('invisible-container');
		st_text.addClass('visible-container');
		st_text.removeClass('invisible-container');
		//
		$('.btn-choose').removeClass('active');
		$('.choose-all').addClass('active');

	});
</script>

<style>
	.invisible-container {
		visibility: hidden !important;
		display: none;
	}
</style>