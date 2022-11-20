<?php
include("student_navigation.php");
include("db.php"); ?>

<head>
    <link rel='stylesheet' href='http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css'>
    <link href='jquery-bar-rating-master/dist/themes/fontawesome-stars.css' rel='stylesheet' type='text/css'>
    <script src='jquery-bar-rating-master/dist/jquery.barrating.min.js' type='text/javascript'></script>
    <script type='text/javascript'>
        $(function() {
            $('.rating').barrating({
                theme: 'fontawesome-stars',
                onSelect: function(value, text, event) {
                    var el = this;
                    var el_id = el.$elem.data('id');
                    if (typeof(event) !== 'undefined') {
                        var split_id = el_id.split('_');
                        var id_education = split_id[1];
                        $.ajax({
                            url: 'rating_ajax.php',
                            type: 'post',
                            data: {
                                id_education: id_education,
                                rating: value
                            },
                            dataType: 'json',
                            success: function(data) {}
                        });
                    }
                }
            });
        });
    </script>
</head>
<?php
$user_id = $_SESSION['id_student'];
echo "<section class='center'>";
$sql = "SELECT * FROM education INNER JOIN training_program ON education.id_program = training_program.id_program WHERE id_student=$user_id";
$result = mysqli_query($conn, $sql);
echo "<h4 style='margin-top:30px;margin-bottom:30px'>Мои заявки</h4>";
while ($myrow = mysqli_fetch_array($result)) {
    $begining = $myrow['beginning_date'];
    $begining = date("d.m.Y", strtotime($begining));
    $closing = $myrow['closing_date'];
    $closing = date("d.m.Y", strtotime($closing));
    if ($myrow['status'] == 0) {
        $status = 'Рассматривается';
        $rating_visible = 'hidden';
    } else if ($myrow['status'] == 1) {
        //
        $id_education = $myrow['id_education'];
        $id_program = $myrow['id_program'];
        $rating = $myrow['rating'];
        $rating_visible = 'auto';

        //
        if ($myrow['payment'] != '' and $myrow['doc_number'] != '0')
            $status = 'Курс пройден';
        else $status = 'Одобрена';
    } else if ($myrow['status'] == 2) {
        $status = 'Отказ';
        $rating_visible = 'hidden';
    }
    $color = "rgba(170, 113, 245, 0.2)";

    if ($myrow['beginning_date'] == '')
        $time = "Не начат";
    else if ($myrow['closing_date'] == '')
        $time = "Дата начала - $begining";
    else {
        $time = "<i class='fa-regular fa-clock' style='padding-right:8px'></i>$begining-$closing";
        $color = "rgb(236, 239, 255)";
    }
    if ($myrow['doc_number'] != '0' and $myrow['status'] == '1') {
        $doc_number = "<span style='margin-left:20px' data-bs-toggle='tooltip' data-bs-placement='top' title='Номер сертификата'>№" . $myrow['doc_number'] . "</span>";
    } else {
        $doc_number = "";
    }
    if ($myrow['payment'] == '') {
        $payment = "<span style='margin-right:20px' data-bs-toggle='tooltip' data-bs-placement='top' title='Курс не оплачен'><i class='fa-solid fa-triangle-exclamation' style='color:rgb(170, 113, 245)'></i></span>";
    } else $payment = "";
?>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css' rel='stylesheet'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css'>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js'></script>
    <div class='card' style='margin-bottom:30px;width:900px;height:160px;background-color:<?php echo $color; ?>;border:none;border-left:5px solid rgb(170, 113, 245)'>
        </style>
        <div class='card-body'>
            <div class='container'>
                <div class='row'>
                    <div class='col-1'> <i class='<?php echo $myrow['icon']; ?> fa-3x' style='color:rgb(170, 113, 245)'></i> </div>
                    <div class='col-11'>
                        <h5 class='card-title'><?php echo $myrow['name_of_program']; ?></h5>
                        <h6 class='card-subtitle mb-2 text-muted'>
                            <span data-bs-toggle='tooltip' data-bs-placement='top' title='Дата заявки'><?php echo date("d.m.Y", strtotime($myrow['apply_date'])); ?></span>
                        </h6>
                    </div>
                </div>
                <div style='padding-top:40px'></div>
                <div style='display:flex;justify-content:space-between'>
                    <span data-bs-toggle='tooltip' data-bs-placement='top' title='Длительность курса' class='card-text'><?php echo $time; ?></span>
                    <div style='display:flex;justify-content:flex-end'>
                        <!---->
                        <div style='padding-right:20px;visibility:<?php echo $rating_visible ?>' class='post-action'>
                            <select class='rating' id='rating_<?php echo $id_education; ?>' data-id='rating_<?php echo $id_education; ?>'>
                                <option value='1'>1</option>
                                <option value='2'>2</option>
                                <option value='3'>3</option>
                                <option value='4'>4</option>
                                <option value='5'>5</option>
                            </select>
                            <script type='text/javascript'>
                                $(document).ready(function() {
                                    $('#rating_<?php echo $id_education; ?>').barrating('set', <?php echo $rating; ?>);
                                });
                            </script>
                        </div>
                        <!---->
                        <?php echo $payment; ?>
                        <span data-bs-toggle='tooltip' class='card-text' data-bs-placement='top' title='Статус заявки'><?php echo $status; ?></span>
                        <?php echo $doc_number; ?>
                    </div>
                </div></span>
            </div>
        </div>
    </div>
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
<?php
}
?>
</section>
<style>
    .center {
        margin-left: 50px;
    }

    .br-theme-fontawesome-stars .br-widget a::after {
        color: white !important;
    }

    .br-theme-fontawesome-stars .br-widget a.br-active:after {
        color: rgb(170, 113, 245) !important;
    }

    .br-theme-fontawesome-stars .br-widget a.br-selected:after {
        color: rgb(170, 113, 245) !important;
    }
</style>