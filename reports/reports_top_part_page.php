<?php 
if (isset($_GET['FinishContract'])) {
    $FinishContract = $_GET['FinishContract'];
} else {
    $FinishContract=0;
}

echo <<<HTML
<div class="container-fluid">
    <div class="row">
        <div class ="col-12 up_form" >
        <form>
            <div class ="up_form">
                    <!-- <div class="mobile_web"> -->
                        <label for="date_start">Дата начала : </label>
                        <input class="date_input" type="date" id="date_start" name="date_start">
                    <!-- </div> -->
                    <!-- <div class="mobile_web"> -->
                        <label for="date_end">Дата окончания : </label>
                        <input type="date" id="date_end" name="date_end"/>
                   <!-- </div> -->
                    <!-- <div class="mobile_web"> -->
                            <button  class="btn btn-secondary btn-sm ms-5"  type="submit">ОБНОВИТЬ</button>
                    <!-- </div> -->
            </div>
        </form>


  </div>
        <!-- <div class ="col-1 up-button">
            <button onclick="window.location='logout.php'">Выйти</button>
        </div> -->
</div>


HTML;
?>