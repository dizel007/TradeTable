<?php 
echo "

<form>
    <div  class = \"up_form\">
        <label for=\"date_start\">Дата начала : </label>
        <input type=\"date\" id=\"date_start\" name=\"date_start\"/>

        <label for=\"date_end\">Дата окончания : </label>
        <input type=\"date\" id=\"date_end\" name=\"date_end\"/>

        <label for=\"param\">Поиск : </label>
        <input type=\"text\" id=\"value\" name=\"value\"/>
        <input type=\"hidden\" id=\"id\" name=\"id\"/>

        <select size=\"1\" name=\"typeQuery\">
          <option disabled>Выберите параметр поиска</option>
          <option selected value=\"2\">Номер КП</option>
          <option value=\"3\">По Дате</option>
          <option value=\"4\">ИНН</option>
          <option value=\"7\">ID КП</option>
          <option value=\"10\">Ответственный</option>
         </select>

        
        <button type=\"submit\">ОБНОВИТЬ</button>
    </div>
   
</form>"
?>