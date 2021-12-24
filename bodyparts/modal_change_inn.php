<?php
require_once ("connect_db.php");
if ($typeQuery == 200) {

  if (isset($_GET['id'])) {
    $id = $_GET['id'];
  
echo <<<HTML
  <div class="dm-overlay" id="win8">
      <div class="dm-table">
          <div class="dm-cell">
              <div class="dm-modal">
                  <a href="#close" class="close"></a>
      <form  action="changedb/update_inn_company.php?id=$id&typeQuery=200" method="post">
 <table class="modal_tabel" width="100%" cellspacing="0" cellpadding="5">

HTML;

 for ($i=0; $i<count($arr_name); $i++){

  foreach ($arr_inn as $key => $value) {
   foreach ($value as $key1 => $value1) 
     {
       if ($key1 == 'inn')          { $inn = $value1;}
       if ($key1 == 'name')         { $name = $value1;}
       if ($key1 == 'fullName')     { $fullName = $value1;}
       if ($key1 == 'telefon')      { $telefon = $value1;}
       if ($key1 == 'email')        { $email = $value1;}
       if ($key1 == 'adress')       { $adress = $value1;}
       if ($key1 == 'contactFace')  { $contactFace = $value1;}
       if ($key1 == 'comment')      { $comment = $value1;}
       
     }
  }

  echo <<<HTML
       <tr> 
          <td width="200" valign="top">ИНН КОМПАНИИ</td>
          <td valign="top">$inn</td>
          <td> 
              <select size="1" name="inn">
              <option value ="$inn">$inn</option>
              

        </td>
      </tr>
      <tr> 
          <td> 
              <input type="hidden" name="id" value="$id"></p>
        </td>
      </tr>
      <tr> 
          <td width="200" valign="top">КРАТКОЕ Наименование КОМПАНИИ</td>
          <td valign="top">$name</td>
      </tr>
      <tr> 
          <td width="200" valign="top">Полное Наименование КОМПАНИИ</td>
          <td valign="top">$fullName</td>
      </tr>
      <tr> 
          <td width="200" valign="top">Телефоны</td>
          <td valign="top">$telefon</td>
          <!-- <td>   
              <p>    
                <textarea name="telefon" rows="3" cols="50">$telefon</textarea>
              </p>
         </td> -->
      </tr>
      <tr> 
          <td width="200" valign="top">Емайл</td>
          <td valign="top">$email</td>
          <!-- <td>   
              <p>    
                <textarea name="email" rows="3" cols="50">$email</textarea>
              </p>
         </td> -->
      </tr>
      <tr> 
          <td width="200" valign="top">Контактное Лицо</td>
         <td valign="top">$contactFace</td>
         <td>   
              <p>    
                <textarea name="contactFace" rows="3" cols="50">$contactFace</textarea>
              </p>
         </td>
        </tr>
        <tr> 
          <td width="200" valign="top">Юрид. Адрес</td>
          <td valign="top">$adress</td>
      </tr>
      <tr> 
          <td width="200" valign="top">Коментарий</td>
          <td valign="top">$comment</td>
          <td>   
              <p>    
                <textarea name="comment" rows="3" cols="50">$comment</textarea>
              </p>
         </td>
      </tr>
HTML;

                           
 };
                  echo "
                  </table>
                                    
       <p><input type=\"submit\" value=\"Отправить\"></p>
      </form>
     </div>
    </div>
   </div>
  </div>";
   }
 }
 //***********************************// корректировка телефона /////////
 if ($typeQuery == 300) {

  if (isset($_GET['id'])) {
    $id = $_GET['id'];
  }
    if (isset($_GET['id_phone'])) {
      $id_phone_cor = $_GET['id_phone'];
      $sql = "SELECT * FROM `telephone` WHERE id='$id_phone_cor'";
      $query = $mysqli->query($sql);
      $phone_cor = MakeArrayFromObjTelephone($query); // массив с данными по телефону


      $phone_real = $phone_cor[0]['telephone'];
      $commentPhone = $phone_cor[0]["comment"];
      $whatsapp = $phone_cor[0]["whatsapp"];
    ($whatsapp == 1)?$whatsapp_="есть":$whatsapp_="нет";  

     $viber = $phone_cor[0]["viber"];
     ($viber == 1)?$viber_="есть":$viber_="нет";

      $contactName = $phone_cor[0]["name"];
      $old_phonу = $phone_cor[0]["old_phone"];
      $date_write = $phone_cor[0]["date_write"];
      $actual_phone = $phone_cor[0]["actual"];
      
    }
    for ($i=0; $i<count($arr_name); $i++){

echo <<<HTML
  <div class="dm-overlay" id="win300">
      <div class="dm-table">
          <div class="dm-cell">
              <div class="dm-modal">
                  <a href="#close" class="close"></a>
      
      <div class ="center">ИЗМЕНЕНИЕ ДАННЫХ ТЕЛЕФОННОГО НОМЕРА<br><br></div>
                  <form  action="changedb/update_telephone.php?id=$id" method="post">
 <table class="modal_tabel" width="100%" cellspacing="0" cellpadding="5">
 <caption>Наименование КОМПАНИИ: $name</caption>
 
 <caption><b>Телефон: $phone_real</b></caption>

       <!-- <tr> 
          <td width="100" valign="top">id_phone_cor</td>
          <td valign="top">$id_phone_cor</td>
          <td> 
              <select size="1" name="id_phone_cor">
              <option value ="$id_phone_cor">$id_phone_cor</option>
        </td>
      </tr> -->
      <tr> 
        <td> 
             <input type="hidden" name="id_phone_cor" value="$id_phone_cor">
        </td>
        <td> 
          <!-- передаем id  чтобы знать куда вернуться -->
             <input type="hidden" name="id" value="$id">   
        </td>
      </tr>
      
      <!-- <tr> 
          <td valign="top">Телефон</td>
          <td valign="top">$phone_real</td>
          <td>   
                  
                <textarea name="telefon" rows="1" cols="30">$phone_real</textarea>
              
         </td>
      </tr> -->
      <tr>           
        <td valign="top">WhatsApp</td>
        <td valign="top">$whatsapp_</td>
        <td> 
                  <select size="1" name="whatsapp">
                      <option selected value = "$whatsapp">$whatsapp_</option>
                      <option value="1">есть</option>
                      <option value="0">нет</option>
                  </select>
            
          </td>
    </tr>
    <tr>           
        <td valign="top">Viber</td>
        <td valign="top">$viber_</td>
        <td> 
                  <select size="1" name="viber">
                      <option selected value = "$viber">$viber</option>
                      <option value="1">есть</option>
                      <option value="0">нет</option>
                  </select>
            
          </td>
    </tr>

      <tr>           
        <td valign="top">Актуальность номера</td>
        <td valign="top">$actual_phone</td>
         <td> 
            
                  <select id="js-phone-num" size="1" name="actual_phone">
                      <option id="js-new-modal-" selected value = "$actual_phone">$actual_phone</option>
                      <option value="Актуальный">Актуальный</option>
                      <option value="Неактуальный">Неактуальный</option>
                      <option value="Не звонить">Не звонить</option>
                      <option value="Новый">Новый</option>
                      <option value=""></option>
                </select>
            
          </td>
    </tr>


      <tr> 
          <td width="200" valign="top">Контактное Лицо</td>
         <td valign="top">$contactName</td>
         <td>   
                  
                <textarea name="contactName" rows="1" cols="30">$contactName</textarea>
             
         </td>
        </tr>
      <tr> 
          <td width="200" valign="top">Коментарий</td>
          <td valign="top">$commentPhone</td>
          <td>   
              <p>    
                <textarea name="commentPhone" rows="3" cols="30">$commentPhone</textarea>
              </p>
         </td>
      </tr>


                           
 
           </table>
                                    
       <p><input type="submit" value="Отправить"></p>
      </form>
     </div>
    </div>
   </div>
  </div>";
HTML;
}
 }


 //***********************************// Добавление НОВОГО НОМЕРА телефона /////////
 if ($typeQuery == 309) {

  if (isset($_GET['id']))  {$id = $_GET['id'];}
  if (isset($_GET['inn'])) { $inn = $_GET['inn'];}

  

echo <<<HTML
  <div class="dm-overlay" id="win309">
      <div class="dm-table-phone">
          <div class="dm-cell-phone">
              <div class="dm-modal-phone">
                  <a href="#close" class="close"></a>
      
      <div class ="center">ДОБАВЛЕНИЕ НОВОГО ТЕЛЕФОННОГО НОМЕРА<br><br></div>
                  <form  action="changedb/insert_telephone.php?id=$id&inn=$inn" method="post">
 <table class="modal_tabel" width="100%" cellspacing="0" cellpadding="5">
 <caption>Наименование КОМПАНИИ: $name</caption>

       <tr> 
          <td width="100" valign="top">ИНН</td>
           <td> 
              <select size="1" name="inn">
              <option value ="$inn">$inn</option>
          </td>
      </tr>
      <tr> 
        <td> 
          <!-- передаем id  чтобы знать куда вернуться -->
             <input type="hidden" name="id" value="$id">   
        </td>
      </tr>
      
      <tr> 
          <td valign="top">Телефон</td>
           <td>   
         <input type="text" class="form-control" id="phone2" name="telefon" placeholder="+7 (999) 999-99-99" autocomplete="off">
	   
          </td>
      </tr>
      <tr>           
        <td valign="top">WhatsApp</td>
           <td> 
                <select size="1" name="whatsapp">
                      <option value="1">есть</option>
                      <option selected value="0">нет</option>
                 </select>
            
          </td>
    </tr>
    <tr>           
        <td valign="top">Viber</td>
           <td> 
                <select size="1" name="viber">
                      <option value="1">есть</option>
                      <option selected value="0">нет</option>
                 </select>
            
          </td>
    </tr>

      <tr>           
        <td valign="top">Актуальность номера</td>
              <td> 
            
                  <select id="js-phone-num" size="1" name="actual_phone">
                      <option selected value="Актуальный">Актуальный</option>
                      <option value="Неактуальный">Неактуальный</option>
                      <option value="Не звонить">Не звонить</option>
                      <option value="Новый">Новый</option>
                      <option value=""></option>
                </select>
            
          </td>
    </tr>
      <tr> 
          <td width="200" valign="top">Контактное Лицо</td>
         <td>   
            <textarea name="contactName" rows="1" cols="30"></textarea>
         </td>
        </tr>
      <tr> 
          <td width="200" valign="top">Коментарий</td>
          <td>   
                 <textarea name="commentPhone" rows="3" cols="30"></textarea>
          </td>
      </tr>
           </table>
                              
       <p><input type="submit" value="Отправить"></p>
      </form>
     </div>
    </div>
   </div>
  </div>
HTML;
}


 //***********************************// корректировка EMAIL /////////************************* */
 if ($typeQuery == 400) {

  if (isset($_GET['id'])) {
    $id = $_GET['id'];
  }
    if (isset($_GET['id_email'])) {
      $id_email_cor = $_GET['id_email'];
      $sql = "SELECT * FROM `email` WHERE id='$id_email_cor'";
      $query = $mysqli->query($sql);
      $email_cor = MakeArrayFromObjEmail($query); // массив с данными по телефону


      $email_real = $email_cor[0]['email'];
      $commentEmail = $email_cor[0]["comment"];
      $date_write = $email_cor[0]["date_write"];
      $actual_email = $email_cor[0]["actual"];
      
    }
    for ($i=0; $i<count($arr_name); $i++){

echo <<<HTML
  <div class="dm-overlay" id="win400">
      <div class="dm-table">
          <div class="dm-cell">
              <div class="dm-modal">
                  <a href="#close" class="close"></a>
      
      <div class ="center">ИЗМЕНЕНИЕ ДАННЫХ EMAIL<br><br></div>
                  <form  action="changedb/update_email.php?id=$id" method="post">
 <table class="modal_tabel" width="100%" cellspacing="0" cellpadding="5">
 <caption>Наименование КОМПАНИИ: $name</caption>
 
 <caption><b>Email: $email_real</b></caption>

      <tr> 
        <td> 
             <input type="hidden" name="id_email_cor" value="$id_email_cor">
        </td>
        <td> 
          <!-- передаем id  чтобы знать куда вернуться -->
             <input type="hidden" name="id" value="$id">   
        </td>
      </tr>
      <tr>           
      </tr>

      <tr>           
        <td valign="top">Актуальность email</td>
        <td valign="top">$actual_email</td>
         <td> 
            
                  <select id="js-actual_email" size="1" name="actual_email">
                      <option id="js-new-modal-" selected value = "$actual_email">$actual_email</option>
                      <option value="Актуальная">Актуальная</option>
                      <option value="Неактуальная">Неактуальная</option>
                      <option value=""></option>
                </select>
            
          </td>
    </tr>

      <tr> 
          <td width="200" valign="top">Коментарий</td>
          <td valign="top">$commentEmail</td>
          <td>   
              <p>    
                <textarea name="commentEmail" rows="3" cols="30">$commentEmail</textarea>
              </p>
         </td>
      </tr>


                           
 
           </table>
                                    
       <p><input type="submit" value="Отправить"></p>
      </form>
     </div>
    </div>
   </div>
  </div>
HTML;
}
}


//***********************************// Добавление НОВОГО EMAIL  /////////
if ($typeQuery == 409) {

  if (isset($_GET['id']))  {$id = $_GET['id'];}
  if (isset($_GET['inn'])) { $inn = $_GET['inn'];}

  

echo <<<HTML
  <div class="dm-overlay" id="win409">
      <div class="dm-table-phone">
          <div class="dm-cell-phone">
              <div class="dm-modal-phone">
                  <a href="#close" class="close"></a>
      
      <div class ="center">ДОБАВЛЕНИЕ НОВОЙ ЭЛЕКТРОННОЙ ПОЧТЫ<br><br></div>
                  <form  action="changedb/insert_email.php?id=$id&inn=$inn" method="post">
 <table class="modal_tabel" width="100%" cellspacing="0" cellpadding="5">
 <caption>Наименование КОМПАНИИ: $name</caption>

       <tr> 
          <td width="100" valign="top">ИНН</td>
           <td> 
              <select size="1" name="inn">
              <option value ="$inn">$inn</option>
          </td>
      </tr>
      <tr> 
        <td> 
          <!-- передаем id  чтобы знать куда вернуться -->
             <input type="hidden" name="id" value="$id">   
        </td>
      </tr>
      
      <tr> 
          <td valign="top">email</td>
           <td>   
              <input type="email"  name="new_email" value="">
	         </td>
      </tr>
      <tr>           
        <td valign="top">Актуальность номера</td>
              <td> 
            
                  <select size="1" name="actual_email">
                      <option selected value="Актуальная">Актуальная</option>
                      <option value="Неактуальная">Неактуальная</option>
                       <option value=""></option>
                </select>
            
          </td>
    </tr>
      <tr> 
          <td width="200" valign="top">Коментарий</td>
          <td>   
                 <textarea name="commentEmail" rows="3" cols="30"></textarea>
          </td>
      </tr>
           </table>
                              
       <p><input type="submit" value="Отправить"></p>
      </form>
     </div>
    </div>
   </div>
  </div>
HTML;
}

?>
