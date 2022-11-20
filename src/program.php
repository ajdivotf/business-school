<?php
include("student_navigation.php");
include("db.php");

$sql = "SELECT *, training_program.id_program, IF(id_education > 0 AND status=1, COUNT(training_program.id_program), 0) AS listeners FROM training_program LEFT JOIN education ON training_program.id_program = education.id_program INNER JOIN form_of_education ON training_program.id_form = form_of_education.id_form GROUP BY training_program.id_program;";
$result = mysqli_query($conn, $sql);
$sql1 = "SELECT id_subcategory, name_of_subcategory FROM subcategory;";
$result1 = mysqli_query($conn, $sql1);
$sql2 = "SELECT * FROM form_of_education;";
$result2 = mysqli_query($conn, $sql2);

?>

<head>
  <link rel="stylesheet/less" type="text/css" href="program.less" />
  <script src="https://cdn.jsdelivr.net/npm/less@4.1.1"></script>
  <script src="selector.js"></script>

</head>
<section class='center'>
  <h4>Выбор программы обучения</h4>
  <form method='post' action='' id='form' style='left:5%;top:0%;width:1wh;'>
    <input type='text' style='margin-right:20px' id='search-text' onkeyup='card_search()' name='searchName' placeholder='Название программы' class='form-control select'>
    <!--<input type='text' id='search-type' onkeyup='card_search()' name='searchType' placeholder='Вид' class='form-control select'>-->
    <div id="search-form" onclick='card_search()' style="margin-right:20px">
      <select id="normal-select-1" name='program_form' placeholder-text="Форма обучения">
        <option value="0" class="select-dropdown__list-item" disabled selected>Все курсы</option>
        <?php while ($row2 = mysqli_fetch_array($result2)) {
        ?>
          <option value="<?php echo $row2['id_form']; ?>" class="select-dropdown__list-item"><?php echo $row2['name_of_form']; ?></option>
        <?php } ?>
      </select>
    </div>
    <div id="search-category" onclick='card_search()'>
      <select id="normal-select-2" name='program_type' placeholder-text="Категория курса">
        <option value="0" class="select-dropdown__list-item" disabled selected>Все курсы</option>
        <?php while ($row1 = mysqli_fetch_array($result1)) { ?>
          <option value="<?php echo $row1['id_subcategory']; ?>" class="select-dropdown__list-item"><?php echo $row1['name_of_subcategory']; ?></option>
        <?php } ?>
      </select>
    </div>

    <input type='number' id='search-price' onkeyup='card_search()' onclick='card_search()' name='searchPrice' placeholder='1000' class='form-control'>
  </form>
  <div class='wrapper'>
    <?php while ($myrow = mysqli_fetch_array($result)) {
      $average = $myrow['average_rate'];
      $aver_percent = $average / 5 * 100;
      $stars_visibility = 'auto';
      $average = number_format($average, 2, ',', ' ');
    ?>
      <div class='item'>
        <div class='card'>
          <div class='card-body' style='height:470px'>
            <i class='<?php echo $myrow['icon']; ?> fa-4x' style='padding-bottom:30px;color:rgb(170, 113, 245)'></i>
            <h5 class='card-title'><?php echo $myrow['name_of_program']; ?></h5>
            <h6 class='card-subtitle mb-1'>
              <!---->
              <div class='row' style="padding:5px 0 10px 0">
                <div class='col-7'>
                  <!---->
                  <div class="star-ratings">
                    <div class="fill-ratings" style="width: <?php echo $aver_percent; ?>%;">
                      <span>
                        <nobr>
                          <i class="fa-solid fa-star"></i>
                          <i class="fa-solid fa-star"></i>
                          <i class="fa-solid fa-star"></i>
                          <i class="fa-solid fa-star"></i>
                          <i class="fa-solid fa-star"></i>
                        </nobr>
                      </span>
                    </div>
                    <div class="empty-ratings">
                      <span>
                        <nobr>
                          <i class="fa-solid fa-star"></i>
                          <i class="fa-solid fa-star"></i>
                          <i class="fa-solid fa-star"></i>
                          <i class="fa-solid fa-star"></i>
                          <i class="fa-solid fa-star"></i>
                        </nobr>
                      </span>
                    </div>
                  </div>
                  <!---->
                </div>
                <!---->
                <div class='col-5 text-muted' style='margin: auto 0 auto 0;'>
                  <span><?php echo $average; ?><i style='padding-left:15px' class="fa-solid 
                <?php
                if ($myrow['id_form'] === "2") {
                  echo "fa-headphones";
                } else if ($myrow['id_form'] === "1") echo "fa-school";
                ?>"></i> <?php echo $myrow['listeners']; ?></span>
                </div>
              </div>
              <!---->
            </h6>
            <h6 class='card-subtitle form-title mb-2' hidden><?php echo $myrow['id_form']; ?></h6>
            <h6 class='card-subtitle type-title mb-2 text-muted'><?php echo $myrow['type_of_program']; ?></h6>
            <h6 class='card-subtitle category-title mb-2' hidden><?php echo $myrow['id_subcategory']; ?></h6>
            <h6 class='card-subtitle price-title mb-2' style='color:rgb(170, 113, 245)'><?php echo $myrow['price']; ?>₽</h6>
            <div class='container' style='padding: 20px 0 20px 0;'>
              <p class='card-text text-muted' style='font-size:13px;'><?php echo $myrow['description']; ?></p>
              <div style='padding-top:40px;'>
                <form method='post'>
                  <button class='btn-submit' type='submit' formaction='submit_orders.php'>Записаться</button>
                  <input hidden name='id_program' value='<?php echo $myrow['id_program']; ?>'>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
  <button class='btn-submit show-more'>Показать ещё</button>
</section>
<style>
  ::placeholder {
    color: grey !important;
  }

  .center {
    margin-left: 200px;
  }

  h4 {
    padding: 20px 110px 20px 110px;
  }

  /* */
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
    display: flex;
    flex-flow: row wrap;
    width: 1200px;
    margin-left: 85px;
    justify-content: start;
  }

  .item {
    margin: 20px 20px;
    width: 300px;
  }

  .show-more {
    margin: 20px 530px;
  }

  /* */
  .select {
    width: 250px !important;
  }

  option[default] {
    display: none;
  }

  .form-control {
    color: grey;
  }

  .form-control option {
    color: black;
  }

  #form {
    display: flex;
    justify-content: left;
    padding-bottom: 20px;
    padding-left: 90px;
  }

  .form-control {
    width: 150px;
    border-radius: 10px;
    border: solid 1.5px rgb(236, 239, 255);
    height: 40px;
    margin-left: 20px;
  }

  .form-control:focus {
    border: solid 1.5px rgb(170, 113, 245);
  }

  .btn-primary {
    background-color: #9C32C2;
    padding: 10px;
    color: white;
    border: none;
    border-radius: 10px;
    margin-left: 40px;
  }

  .btn-primary:hover {
    background-color: #8B39AD;
  }

  .btn-primary:active,
  .btn-primary:hover,
  .btn-primary:focus {
    box-shadow: none !important;
  }

  .form-control:active,
  .form-control:hover,
  .form-control:focus {
    box-shadow: none !important;
  }
</style>
<script>
  // звезды рейтинга
  $(document).ready(function() {
    var star_rating_width = $('.fill-ratings span').width();
    $('.star-ratings').width(star_rating_width);
  });
  //
  $(document).ready(
    function pagination() {
      const list = $(".item");
      const numToShow = 6; //сколько показывать элементов
      const button = $(".show-more");
      const numInList = list.length;
      list.hide();
      button.hide();
      if (numInList > numToShow) {
        button.show();
      }
      list.slice(0, numToShow).show();

      button.click(function() {
        const showing = list.filter(':visible').length;
        list.slice(showing - 1, showing + numToShow).fadeIn();
        const nowShowing = list.filter(':visible').length;
        if (nowShowing >= numInList) {
          button.hide();
        }
      });
    });

  function card_search() {
    const name = document.getElementById('search-text');
    const regexName = new RegExp(name.value, 'i');
    const price = document.getElementById('search-price').value;
    const form = document.getElementById('normal-select-1');
    const category = document.getElementById('normal-select-2');
    const regexForm = new RegExp(form.value, 'i');
    const button = $(".show-more");
    const list = $(".item");
    if (name === "" && parseInt(category.value) === 0 && parseInt(form.value) === 0 && price === "" && name.value === "") {
      list.hide();
      list.slice(0, 6).show();
      button.show();
    } else {
      $('.item').each(function() {
        const cardBody = $(this).children('.card').children('.card-body');
        const cardNameTitle = cardBody.children('.card-title').text();
        const cardPrice = parseInt(cardBody.children('.price-title').text());
        const cardForm = cardBody.children('.form-title').text();
        const cardCategory = cardBody.children('.category-title').text();
        if (regexName.test(cardNameTitle) && price === "" && parseInt(form.value) === 0 && parseInt(category.value) === 0) {
          $(this).show();
        } else if (regexName.test(cardNameTitle) && price !== "" && parseInt(form.value) === 0 && parseInt(category.value) === 0) {
          parseInt(cardPrice) <= parseInt(price) ? $(this).show() : $(this).hide();
        } else if (regexName.test(cardNameTitle) && price === "" && parseInt(form.value) !== 0 && parseInt(category.value) === 0) {
          regexForm.test(cardForm) ? $(this).show() : $(this).hide();
        } else if (regexName.test(cardNameTitle) && price !== "" && regexForm.test(cardForm) && parseInt(category.value) === 0) {
          parseInt(cardPrice) <= parseInt(price) ? $(this).show() : $(this).hide();
        } else if (regexName.test(cardNameTitle) && price === "" && parseInt(form.value) === 0 && parseInt(category.value) !== 0) {
          parseInt(cardCategory) === parseInt(category.value) ? $(this).show() : $(this).hide();
        } else if (regexName.test(cardNameTitle) && price !== "" && parseInt(form.value) === 0 && parseInt(category.value) !== 0) {
          if (parseInt(cardPrice) <= parseInt(price) && parseInt(cardCategory) === parseInt(category.value)) {
            $(this).show();
          } else $(this).hide();
        } else if (regexName.test(cardNameTitle) && price === "" && regexForm.test(cardForm) && parseInt(category.value) !== 0) {
          parseInt(cardCategory) === parseInt(category.value) ? $(this).show() : $(this).hide();
        } else if (regexName.test(cardNameTitle) && price !== "" && regexForm.test(cardForm) && parseInt(category.value) !== 0) {
          if (parseInt(cardPrice) <= parseInt(price) && parseInt(cardCategory) === parseInt(category.value)) {
            $(this).show();
          } else $(this).hide();
        } else {
          $(this).hide();
        }
      });
    }
    let count = 0;
    for (let i = 0; i < list.length; i++) {
      if (list[i].style.display == "") {
        count++;
      }
    }
    if (count < 6) {
      button.hide();
    } else button.show();

  }
</script>