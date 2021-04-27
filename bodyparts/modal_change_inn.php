<?php

if ($typeQuery == 200) {

  if (isset($_GET['id'])) {
    $id = $_GET['id'];
//  for ($i=0; $i<count($arr_name); $i++)
//   {
      
echo <<<HTML
  <div class="dm-overlay" id="win8">
      <div class="dm-table">
          <div class="dm-cell">
              <div class="dm-modal">
                  <a href="#close" class="close"></a>
      <form  action="changeDB/update_inn_company.php?id=$id&typeQuery=200" method="post">
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
          <!-- <td width="200" valign="top">**********************</td>
          <td valign="top">$id</td> -->
          <td> 
              <!-- <select size="1" name="id">
              <option type="hidden" value ="$id">$id</option> -->
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
          <td>   
              <p>    
                <textarea name="telefon" rows="3" cols="50">$telefon</textarea>
              </p>
         </td>
      </tr>
      <tr> 
          <td width="200" valign="top">Емайл</td>
          <td valign="top">$email</td>
          <td>   
              <p>    
                <textarea name="email" rows="3" cols="50">$email</textarea>
              </p>
         </td>
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
?>
