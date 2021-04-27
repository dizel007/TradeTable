<?php 


echo <<<HTML

<div class ="up_form" >
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
            </select>
        </div>

        
        <div class="mobile_web">
            <label for="FinishContract">Закр. Контр : </label>
            <input type="checkbox" name="FinishContract" value="1">
        </div>

        <button type="submit">ОБНОВИТЬ</button>
   
        </div>
</form>

<!-- <button onclick="window.location='logout.php'" class="get_rigth">Выйти</button> -->

<button onclick="window.location='logout.php'" class="get_rigth">Выйти</button>

</div>

HTML;
?>