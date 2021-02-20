<?php

   if (!empty($id))  {
    $id = $_GET['id'];
              }
 
    if (!empty($_GET['id']))  {
      $id = $_GET['id'];
    }
 

 if (!isset($typeQuery))  {
      $typeQuery = $_GET['typeQuery'];
 }
  // ПЕРВОЕ МОДАЛЬНОЕ ОКНО ДЛЯ ВВОДА/ИЗМЕНИЯ КОММЕНТАРИЯ
if ($typeQuery == 11) {
  $Our_comment ="";
    for ($i=0; $i<count($arr_name); $i++)
        {
          if (isset($id))
              if  ($arr_name[$i]['id']  == $id) 
                $Our_comment = $arr_name[$i]['Comment'];
        }
      echo "
      <div class=\"dm-overlay\" id=\"win1\">
          <div class=\"dm-table\">
              <div class=\"dm-cell\">
                  <div class=\"dm-modal\">
                      <a href=\"#close\" class=\"close\"></a>
                      <p>Текстовое содержание : ".$Our_comment."</p>
                      
                  <form  action=\"changeDB/update_comment.php?id=";
                  
                        if (isset($id)) echo $id; // добавляем ID  - редактируемой строки
                        echo ("&typeQuery=11");
                        echo "\" method=\"post\">
                            <p>
                              <p>Добавить комментарий : </p>
                                <p>
                                  <textarea name=\"text\" rows=\"10\" cols=\"45\">".$Our_comment.

                                 "</textarea>
                                </p>
                              <p><input type=\"submit\" value=\"Отправить\"></p>
                            </p>
                     </form>
                  </div>
              </div>
          </div>
      </div>";
  }

  // ПЕРВОЕ МОДАЛЬНОЕ ОКНО ДЛЯ ВВОДА/ИЗМЕНИЯ КОНТАКТОВ ЗАКАЗЧИКА
  if ($typeQuery == 6) {
    $Our_comment ="";
      for ($i=0; $i<count($arr_name); $i++)
          {
            if (isset($id))
                if  ($arr_name[$i]['id']  == $id) 
                  $Our_comment = $arr_name[$i]['ContactCustomer'];
          }
        echo "
        <div class=\"dm-overlay\" id=\"win6\">
            <div class=\"dm-table\">
                <div class=\"dm-cell\">
                    <div class=\"dm-modal\">
                        <a href=\"#close\" class=\"close\"></a>
                        <p>Текстовое содержание : ".$Our_comment."</p>
                        
                    <form  action=\"changeDB/update_comment.php?id=";
                    
                          if (isset($id)) echo $id; // добавляем ID  - редактируемой строки
                          echo ("&typeQuery=6");
                          echo "\" method=\"post\">
                              <p>
                                <p>Обновить контакт : </p>
                                  <p>
                                    <textarea name=\"text\" rows=\"10\" cols=\"45\">".$Our_comment.
  
                                   "</textarea>
                                  </p>
                                <p><input type=\"submit\" value=\"Отправить\"></p>
                              </p>
                       </form>
                    </div>
                </div>
            </div>
        </div>";
    }


// ВТОРОЕ МОДАЛЬНОЕ ОКНО ДЛЯ ВВОДА ДАТЫ СЛЕДУЮЩЕГО ЗВОНКА

if ($typeQuery == 12) {
      $nextDate ="";

      for ($i=0; $i<count($arr_name); $i++){
          
      if (isset($id))
            if  ($arr_name[$i]['id']  == $id) 
              $nextDate = $arr_name[$i]['DateNextCall'];
      }

      echo "
      <div class=\"dm-overlay\" id=\"win2\">
          <div class=\"dm-table\">
              <div class=\"dm-cell\">
                  <div class=\"dm-modal\">
                      <a href=\"#close\" class=\"close\"></a>
                      <p>Текущая дата : ".$nextDate."</p>
                      
                  <form  action=\"changeDB/update_comment.php?id=";
                  
                  if (isset($id)) echo $id; // добавляем ID  - редактируемой строки
                  echo ("&typeQuery=12");
                  echo "\" method=\"post\">
                  <p>
                  <label for=\"nextdate\">Следующая дата: </label>
                  <input type=\"date\" id=\"nextdate\" name=\"nextdate\"/>
              </p>
              <p>
                  <button type=\"submit\">Отправить</button>
              </p>   
                  
              </form>
                  </div>
              </div>
          </div>
      </div>";
}


// ТРЕТЬЕ МОДАЛЬНОЕ ОКНО ДЛЯ ВВОДА ИЗМЕНЕНИЯ СОСТОЯНИЯ КП

if ($typeQuery == 13) {
  $ChangeCondition ="";

  for ($i=0; $i<count($arr_name); $i++){
      
  if (isset($id))
        if  ($arr_name[$i]['id']  == $id) 
          $ChangeCondition = $arr_name[$i]['KpCondition'];
  }

  echo "
  <div class=\"dm-overlay\" id=\"win3\">
      <div class=\"dm-table\">
          <div class=\"dm-cell\">
              <div class=\"dm-modal\">
                  <a href=\"#close\" class=\"close\"></a>
                  <p>Текущая состояние : ".$ChangeCondition."</p>
                  
              <form  action=\"changeDB/update_comment.php?id=";
                      
                      if (isset($id)) echo $id; // добавляем ID  - редактируемой строки
                      echo ("&typeQuery=13");
                      echo "\" method=\"post\">
                      <p>
                      <label for=\"ChangeCondition\">Новое состояние: </label>
                      <p>
                        <select size=\"1\" name=\"ChangeCondition\">
                          <option disabled>Выберите состояние</option>
                          <option value=\"В работе\">В работе</option>
                          <option value=\"Не требуется\">Не требуется</option>
                          <option value=\"Купили у нас\">Купили у нас</option>
                          <option value=\"Уже купили\">Уже купили</option>
                        </select>
                        </p>
                        
                        <p><input type=\"submit\" value=\"Отправить\"></p>
                  </p>
              
          </form>
              </div>
          </div>
      </div>
  </div>";
}
// МОДАЛЬНОЕ ОКНО "ОТВЕТСТВЕННЫЙ "ДЛЯ ВВОДА ИЗМЕНЕНИЯ СОСТОЯНИЯ КП

if ($typeQuery == 10) {
  $ChangeCondition ="";

  for ($i=0; $i<count($arr_name); $i++){
      
  if (isset($id))
        if  ($arr_name[$i]['id']  == $id) 
          $ChangeCondition = $arr_name[$i]['Responsible'];
  }

  echo "
  <div class=\"dm-overlay\" id=\"win4\">
      <div class=\"dm-table\">
          <div class=\"dm-cell\">
              <div class=\"dm-modal\">
                  <a href=\"#close\" class=\"close\"></a>
                  <p>Текущая состояние : ".$ChangeCondition."</p>
                  
              <form  action=\"changeDB/update_comment.php?id=";
                      
                      if (isset($id)) echo $id; // добавляем ID  - редактируемой строки
                      echo ("&typeQuery=10");
                      echo "\" method=\"post\">
                      <p>
                      <label for=\"ChangeCondition\">Новое состояние: </label>
                      <p>
                        <select size=\"1\" name=\"ChangeCondition\">
                          <option disabled>Выберите ответственного</option>
                          <option value=\"Мандрыкин\">Мандрыкин</option>
                          <option value=\"Гуц\">Гуц</option>
                          <option value=\"Горячев\">Горячев</option>
                          <option value=\"Зелизко\">Зелизко</option>
                        </select>
                        </p>
                        
                        <p><input type=\"submit\" value=\"Отправить\"></p>
                  </p>
              
          </form>
              </div>
          </div>
      </div>
  </div>";
}


////  Изменяет состояние значимости КП
if ($typeQuery == 9) {
  $ChangeCondition ="";

  for ($i=0; $i<count($arr_name); $i++){
      
  if (isset($id))
        if  ($arr_name[$i]['id']  == $id) 
          $ChangeCondition = $arr_name[$i]['KpImportance'];
  }

  echo "
  <div class=\"dm-overlay\" id=\"win5\">
      <div class=\"dm-table\">
          <div class=\"dm-cell\">
              <div class=\"dm-modal\">
                  <a href=\"#close\" class=\"close\"></a>
                  <p>Текущая состояние : ".$ChangeCondition."</p>
                  
              <form  action=\"changeDB/update_comment.php?id=";
                      
                      if (isset($id)) echo $id; // добавляем ID  - редактируемой строки
                      echo ("&typeQuery=9");
                      echo "\" method=\"post\">
                      <p>
                      <label for=\"ChangeCondition\">Новое состояние: </label>
                      <p>
                        <select size=\"1\" name=\"ChangeCondition\">
                          <option disabled>Значимость КП</option>
                          <option value=\"Нейтрально\">Нейтрально</option>
                          <option selected value=\"Важно\">Важно</option>
                          <option value=\"Очень важно\">Очень важно</option>
                          
                        </select>
                        </p>
                        
                        <p><input type=\"submit\" value=\"Отправить\"></p>
                  </p>
              
          </form>
              </div>
          </div>
      </div>
  </div>";
}

// Изменяем открыт зыкрыт контракт
if ($typeQuery == 16) {
  $ChangeCondition ="";

  for ($i=0; $i<count($arr_name); $i++){
      
  if (isset($id))
        if  ($arr_name[$i]['id']  == $id) 
          $ChangeCondition = $arr_name[$i]['KpImportance'];
  }

  echo "
  <div class=\"dm-overlay\" id=\"win6\">
      <div class=\"dm-table\">
          <div class=\"dm-cell\">
              <div class=\"dm-modal\">
                  <a href=\"#close\" class=\"close\"></a>
                  <p>Текущая состояние : ".$ChangeCondition."</p>
                  
              <form  action=\"changeDB/update_comment.php?id=";
                      
                      if (isset($id)) echo $id; // добавляем ID  - редактируемой строки
                      echo ("&typeQuery=16");
                      echo "\" method=\"post\">
                      <p>
                      <label for=\"ChangeCondition\">Новое состояние: </label>
                      <p>
                        <select size=\"1\" name=\"ChangeCondition\">
                          <option disabled>Закрыт контракт</option>
                          <option selected value=\"1\">Контракт закрыт</option>
                          <option value=\"0\">Контракт НЕ закрыт</option>
                          
                          
                        </select>
                        </p>
                        
                        <p><input type=\"submit\" value=\"Отправить\"></p>
                  </p>
              
          </form>
              </div>
          </div>
      </div>
  </div>";
}


?>