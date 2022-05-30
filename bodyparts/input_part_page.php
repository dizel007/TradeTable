<?php 
if (isset($_GET['FinishContract'])) {
    $FinishContract = $_GET['FinishContract'];
} else {
    $FinishContract=0;
}

echo <<<HTML
<div class="container-fluid">
<div class="row">


<div class ="col-11 up_form" >
<form>
   <div class ="up_form">
    
                <div class="mobile_web">
                    <label for="date_start">Дата начала : </label>
                    <input type="date" id="date_start" name="date_start"/>
                </div>
                <div class="mobile_web">
                    <label for="date_end">Дата окончания : </label>
                    <input type="date" id="date_end" name="date_end"/>
                </div>
        

    
        <div class="mobile_web">
            <label for="param">Поиск : </label>
            <input type="text" id="value" name="value"/>
            <input type="hidden" id="id" name="id"/>
        </div>

        <div class="mobile_web">
            <select size="1" name="typeQuery">
            <option disabled>Выберите параметр поиска</option>
            <option selected value="2">Номер КП</option>
            <option value="3">По Дате</option>
            <option value="4">ИНН</option>
            <option value="7">ID КП</option>
            <option value="10">Ответственный</option>
            <option value="8">Наименование Заказчика</option>
            <option value="12">Москва и МО</option>
            </select>
        </div>

        
        <div class="mobile_web">
            <label for="FinishContract">Закр.Перенос Контр : </label>
HTML;
if ($FinishContract == 1) {            
echo "<input type=\"checkbox\" name=\"FinishContract\" value=\"1\" checked>";
} else {
    echo "<input type=\"checkbox\" name=\"FinishContract\" value=\"1\">";
}

echo <<<HTML
        </div>

        <button  type="submit">ОБНОВИТЬ</button>
   
        </div>
</form>


</div>
HTML;
echo <<<HTML
        <div class ="col-1 up-button"> 
            
        <button onclick="window.location='logout.php'">Выйти</button>
        </div>
HTML;
echo <<<HTML
</div>

</div>
HTML;
?>