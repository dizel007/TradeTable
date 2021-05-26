<?php

function PrintAboutCompany ($arr_inn, $id) {
      
      $inn= $arr_inn[0]['inn'];
      $name = $arr_inn[0]['name'];
      $fullName = $arr_inn[0]['fullName'];
      $telefon = $arr_inn[0]['telefon'];
      $email = $arr_inn[0]['email'];
      $adress = $arr_inn[0]['adress'];
      $contactFace = $arr_inn[0]['contactFace'];
      $comment = $arr_inn[0]['comment'];
echo <<<HTML

<div class="compInn">

        <div class="zagolovok">Информация о компании : $name</div>
        <div class = "shapka"> 
            <div class = "kolon">
                <div class = "item">ИНН</div>
                <div class = "item_desc inntext">$inn</div>
        </div>
        <div class = "kolon">
                <div class = "item">Наименование</div>
                <div class = "item_desc">$name</div>
        </div>
        <div class = "kolon">
                <div class = "item">Полное наименование</div>
                <div class = "item_desc">$fullName</div>
        </div>
        <div class = "kolon">
                <div class = "item">Телефон</div>
                <div class = "item_desc">$telefon</div>
        </div>
        <div class = "kolon">
                <div class = "item">Емайл</div>
                <div class = "item_desc">$email</div>
        </div>
        <div class = "kolon">
                <div class = "item">Контактное лицо</div>
                <div class = "item_desc">$contactFace</div>
        </div>
        <div class = "kolon">
                <div class = "item">Адрес</div>
                <div class = "item_desc">$adress</div>
        </div>
        <div class = "kolon">
                <div class = "item">Комментарий</div>
                <div class = "item_desc">$comment</div>
        </div>
        <div class = "kolon">
                <div class = "item">Ред</div>
                <div class = "item_desc">
                <a href="?id=$id&typeQuery=200#win8" class="btn"><img style = "opacity: 0.5" width="20" height="20" src="icons/table/rr.jpg" alt="formatZakup"></a>
                </div>
        </div>
        

        </div>

</div>
HTML;



}


?>