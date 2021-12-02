<?php

function PrintAboutCompany ($arr_inn, $id, $mysqli) {
      
      $inn= $arr_inn[0]['inn'];
      $name = $arr_inn[0]['name'];
      $fullName = $arr_inn[0]['fullName'];
      $telefon = $arr_inn[0]['telefon'];
      $email = $arr_inn[0]['email'];
      $adress = $arr_inn[0]['adress'];
      $contactFace = $arr_inn[0]['contactFace'];
      $comment = $arr_inn[0]['comment'];


      $sql = ("SELECT * FROM telephone WHERE `inn` = '$inn'");
      $query = $mysqli->query($sql);
      while ($row = $query->fetch_assoc()) {
               $phone[] = $row['telephone'];
       }

echo <<<HTML

<div  class="compInn">

        <div class="zagolovok">Информация о компании : $name</div>
        <div class = "shapka"> 
            <div  class = "kolon">
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
                <div class = "item_desc">
                        
HTML;
for ($i=0; $i < count($phone); $i++)
 {
      echo "<div class = \"item_desc\">".$phone[$i]."</div>";
 }
echo <<<HTML
</div>
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
                <a href="?id=$id&typeQuery=200#win8" class="btn"><img style = "opacity: 0.9" src="icons/table/redakt1.png" alt="formatZakup"></a>
                </div>
        </div>
        

        </div>

</div>
HTML;



}


?>