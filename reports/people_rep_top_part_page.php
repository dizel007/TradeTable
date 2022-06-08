<?php 

/// формируем список актичных мененеждеров
$Responsible="";

if (isset($_GET['FinishContract'])) {
    $FinishContract = $_GET['FinishContract'];
} else {
    $FinishContract=0;
}
$date_start="01.01.2021";
echo <<<HTML
<div class="container-fluid">
    <div class="row">
        <div class ="col-12 up_form" >
        <form>
            <div class ="up_form">
                    <!-- <div class="mobile_web"> -->
                        <label class="date_label" for="date_start">Дата начала : </label>
                        <input class="date_input" type="date" id="date_start" name="date_start">
                    <!-- </div> -->
                    <!-- <div class="mobile_web"> -->
                        <label class="date_label" for="date_end">Дата окончания : </label>
                        <input class="date_input" type="date" id="date_end" name="date_end"/>
                   <!-- </div> -->
                    <!-- <div class="mobile_web"> -->
                          
                    <!-- </div> -->
                    </div>
HTML;


for ($i=0; $i<count($arr_users_active); $i++) {
  $user_name = $arr_users_active[$i]['user_name'];
  echo "<input type=\"checkbox\" name=\"user$i\" value=\"$user_name\">$user_name<br>";
  }
  echo <<<HTML
<button  class="btn btn-secondary btn-sm ms-5"  type="submit">Сформировать</button>
       
            </div>
        </form>


  </div>
 
</div>


HTML;
?>