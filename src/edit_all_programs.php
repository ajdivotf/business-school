<?php
include("db.php");

$sql = "SELECT * FROM training_program";
$result = mysqli_query($conn, $sql); ?>
<div id='search-div' style='display:flex;justify-content:start'>
	<button id='b-add' class='btn-submit'>Добавить</button>
	<input type='text' style='margin-left:635px;margin-top:35px;' id='search-text' onkeyup='card_search()' placeholder='Поиск' class='form-control select'>
</div>
<section class='center'>
	<div class='wrapper'>

		<?php while ($myrow = mysqli_fetch_array($result)) { ?>
			<div class='visible-item' id='view-"<?php echo $myrow['id_program']; ?>' style='margin: 20px 20px 20px 20px !important'>
				<div class='card'>
					<div class='card-body'>
						<i class='<?php echo $myrow['icon']; ?> fa-4x' style='padding-bottom:30px;color:rgb(170, 113, 245)'></i>
						<h5 class='card-title'><?php echo $myrow['name_of_program']; ?></h5>
						<h6 class='card-subtitle price-title mb-2' style='color:rgb(170, 113, 245)'><?php echo $myrow['price']; ?>₽</h6>
						<div class='container' style='padding: 20px 0 20px 0;'>
							<div class='row'>
								<div class='col-2' style='margin: auto 0 auto 0;'>
									<i class='fa-solid fa-star fa-2x' style='color:rgb(236, 239, 255)'></i>
								</div>
								<div class='col-10'>
									<p class='card-text text-muted' style='font-size:13px;'><?php echo $myrow['description']; ?></p>
								</div>
							</div>
							<div style='padding-top:60px;'>
								<form method='post' action='edit_program.php'>
									<input type='submit' class='btn-submit b-edit' id='button-<?php echo $myrow['id_program']; ?>' name='submit' value='Изменить'>
									<input type='hidden' name='id_program' value='<?php echo $myrow['id_program']; ?>'>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
</section>
<script>
	$(this).attr("disabled", false);

	$(document).on('click', '#b-add', function() {
		window.location.href = 'add_program.php';

	})
	$(document).on('click', '.b-edit', function() {
		window.location.href = 'edit_program.php';
	})

	function card_search() {
		const phrase = document.getElementById('search-text').value;
		const regex = new RegExp(phrase, 'i');
		$('.visible-item').each(function() {
			const cardBody = $(this).children('.card').children('.card-body');
			const cardNameTitle = cardBody.children('.card-title').text();
			const cardPrice = parseInt(cardBody.children('.price-title').text());
			const cardType = cardBody.children('.type-title').text();
			if (regex.test(cardNameTitle) || (Number.isFinite(parseInt(phrase)) && parseInt(cardPrice) <= parseInt(phrase)) || regex.test(cardType)) {
				$(this).show();
			} else $(this).hide();
		});

	}
</script>
<style>
	.btn-submit {
		background-color: #9C32C2;
		padding: 10px;
		color: white;
		border: none;
		border-radius: 10px;
	}

	.btn-submit:hover {
		background-color: #8B39AD;
	}

	.wrapper {
		margin-left: 90px;
		display: flex;
		flex-flow: row wrap;
		width: 1200px;
		justify-content: start;
	}

	.card {
		height: 420px;
	}

	.visible-item {
		width: 300px !important;
		display: inline-block;
	}

	.invisible-item {
		padding: 0;
		width: 0;
		height: 0;
		margin: 0;
		display: none;
		visibility: hidden !important;
	}

	#b-add {
		margin-top: 30px;
		margin-bottom: 20px;
		margin-left: 250px;
	}

	.center {
		margin-left: 140px;
		margin-right: auto !important;
	}

	#search-div .form-control {
		color: grey;
	}

	#search-div .form-control option {
		color: black;
	}

	#search-div .form-control {
		width: 250px;
		border-radius: 10px;
		border: solid 1.5px rgb(236, 239, 255);
		height: 40px;
		margin-left: 20px;
	}

	#search-div .form-control:focus {
		border: solid 1.5px rgb(170, 113, 245);
	}

	#search-div .form-control:active,
	#search-div .form-control:hover,
	#search-div .form-control:focus {
		box-shadow: none !important;
	}
</style>