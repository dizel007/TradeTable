<?php
 for ($i=0; $i<count($arr_name); $i++){
      
  if (isset($id))
        if  ($arr_name[$i]['id']  == $id) 
          $ChangeCondition = $arr_name[$i]['KpImportance'];
  }

  echo "
  <div class=\"dm-overlay\" id=\"win7\">
      <div class=\"dm-table\">
          <div class=\"dm-cell\">
              <div class=\"dm-modal\">
                  <a href=\"#close\" class=\"close\"></a>


      <form  action=\"changeDB/update_all_zakup.php?id=";
              if (isset($id)) echo $id; // добавляем ID  - редактируемой строки
                  echo ("&typeQuery=100");
                     echo "\" method=\"post\">



                  <table width=\"100%\" cellspacing=\"0\" cellpadding=\"5\">";

                  for ($i=0; $i<count($arr_name); $i++){
                 //  echo $arr_name[$i]['pp'];
                  //  echo $arr_name[$i]['KpNumber'];
                //    echo $arr_name[$i]['KpData'];
                //    echo $arr_name[$i]['InnCustomer'];
                  //  echo $arr_name[$i]['NameCustomer'];
                  //  echo $arr_name[$i]['ContactCustomer'];
                 //   echo $arr_name[$i]['idKp'];
                  //  echo  $arr_name[$i]['StatusKp'];
                  //  echo $arr_name[$i]['KpImportance'] ;
                  //  echo $arr_name[$i]['Responsible'];
                  // echo $arr_name[$i]['Comment'] ;
                 //  echo $arr_name[$i]['DateNextCall'] ;
                  // echo $arr_name[$i]['KpCondition'] ;
                 //  echo $arr_name[$i]['KpSum'] ;
                //   echo $arr_name[$i]['TenderSum'] ;
                 //  echo $arr_name[$i]['FinishContract'] ;
                  // echo $arr_name[$i]['LinkKp'] ;
                 //  echo $arr_name[$i]['Adress'] ;
                  // echo $arr_name[$i]['id'] ;
                    echo "
                        <tr> 
                            <td width=\"200\" valign=\"top\">ID КП в БД</td>
                            <td valign=\"top\">".$arr_name[$i]['id']."</td>
                            <td> 
                                    <select size=\"1\" name=\"id\">
                                    <option value =".$arr_name[$i]['id'].">".$arr_name[$i]['id']."</option>
                            </td>
                        </tr>

                        <tr> 
                            <td width=\"200\" valign=\"top\">Порядковый номер КП</td>
                            <td valign=\"top\">".$arr_name[$i]['pp']."</td>
                        </tr>

                        <tr> 
                            <td width=\"200\" valign=\"top\">Номер КП</td>
                            <td valign=\"top\">".$arr_name[$i]['KpNumber']."</td>
                        </tr>
                        <tr> 
                        <td width=\"200\" valign=\"top\">Дата КП</td>
                        <td valign=\"top\">".$arr_name[$i]['KpData']."</td>
                        </tr>
                        <tr> 
                        <td width=\"200\" valign=\"top\">ИНН Заказчика</td>
                        <td valign=\"top\">".$arr_name[$i]['InnCustomer']."</td>
                        </tr>
                        <tr> 
                        <td width=\"200\" valign=\"top\">Наименование Заказчика</td>
                        <td valign=\"top\">".$arr_name[$i]['NameCustomer']."</td>
                        
                        </tr>

                        <tr> 
                           <td width=\"200\" valign=\"top\">Контакты Заказчика</td>
                           <td valign=\"top\">".$arr_name[$i]['ContactCustomer']."</td>
                           <td    
                                <p>    
                                    <textarea name=\"ContactCustomer\" rows=\"2\" cols=\"50\">".$arr_name[$i]['ContactCustomer'].
                                  "</textarea>
                                </p>
                           </td>
                        </tr>

                        <tr> 
                            <td width=\"200\" valign=\"top\">ID  закупки</td>
                            <td valign=\"top\">".$arr_name[$i]['idKp']."</td>
                        </tr>
     
                        <tr> 
                            <td width=\"200\" valign=\"top\">Статус КП</td>
                            <td valign=\"top\">".$arr_name[$i]['StatusKp']."</td>
                        </tr>
     
                        <tr> 
                        <td width=\"200\" valign=\"top\">Важность</td>
                        <td valign=\"top\">".$arr_name[$i]['KpImportance']."</td>
                            <td>
                                  <p>
                                  <select size=\"1\" name=\"KpImportance\">
                                    <option disabled>Значимость КП</option>
                                    <option value=\"Нейтрально\">Нейтрально</option>
                                    <option selected value=\"Важно\">Важно</option>
                                    <option value=\"Очень важно\">Очень важно</option>
                                    
                                  </select>
                                  </p>
                            </td>
                        </tr>

                        <tr> 
                        <td width=\"200\" valign=\"top\">Ответственный</td>
                        <td valign=\"top\">".$arr_name[$i]['Responsible']."</td>
                            <td>
                                  <p>
                                  <select size=\"1\" name=\"Responsible\">
                                      <option disabled>Выберите ответственного</option>
                                      <option value=\"Мандрыкин\">Мандрыкин</option>
                                      <option value=\"Гуц\">Гуц</option>
                                      <option value=\"Горячев\">Горячев</option>
                                      <option value=\"Зелизко\">Зелизко</option>
                                </select>
                                </p>
                            </td>
                        </tr>

                        <tr> 
                           <td width=\"200\" valign=\"top\">Комментарий</td>
                           <td valign=\"top\">".$arr_name[$i]['Comment']."</td>
                           <td    
                                <p>    
                                    <textarea name=\"Comment\" rows=\"2\" cols=\"50\">".$arr_name[$i]['Comment'].
                                  "</textarea>
                                </p>
                           </td>
                        </tr>

                        <tr> 
                            <td width=\"200\" valign=\"top\">Дата след.Звонка</td>
                            <td valign=\"top\">".$arr_name[$i]['DateNextCall']."</td>
                             <td    
                                  <p>
                                    <input type=\"date\" id=\"nextdate\" name=\"DateNextCall\"/>
                                  </p>
                             </td>
                        </tr>

                        <tr> 
                        <td width=\"200\" valign=\"top\">Состояние КП</td>
                        <td valign=\"top\">".$arr_name[$i]['KpCondition']."</td>
                            <td>
                                  <p>
                                  <select size=\"1\" name=\"KpCondition\">
                                      <option disabled>Выберите состояние</option>
                                      <option value=\"В работе\">В работе</option>
                                      <option value=\"Не требуется\">Не требуется</option>
                                      <option value=\"Купили у нас\">Купили у нас</option>
                                      <option value=\"Уже купили\">Уже купили</option>
                                </select>
                                </p>
                            </td>
                        </tr>

                        <tr> 
                            <td width=\"200\" valign=\"top\">Сумма КП</td>
                            <td valign=\"top\">".$arr_name[$i]['KpSum']."</td>
                        </tr>
                        <tr> 
                            <td width=\"200\" valign=\"top\">НМЦК Тендера КП</td>
                            <td valign=\"top\">".$arr_name[$i]['TenderSum']."</td>
                        </tr>

                        <tr> 
                        <td width=\"200\" valign=\"top\">Контракт закрыт</td>
                        <td valign=\"top\">".$arr_name[$i]['FinishContract']."</td>
                        <td>
                        <p>
                        <select size=\"1\" name=\"FinishContract\">
                          <option selected value=\"1\">Контракт закрыт</option>
                          <option value=\"0\">Контракт НЕ закрыт</option>
                          
                          
                        </select>
                        </p></td>
                    </tr>

                    <tr> 
                    <td width=\"200\" valign=\"top\">Адрес поставки</td>
                    <td valign=\"top\">".$arr_name[$i]['Adress']."</td>
                    <td    
                         <p>    
                             <textarea name=\"Adress\" rows=\"2\" cols=\"50\">".$arr_name[$i]['Adress'].
                           "</textarea>
                         </p>
                    </td>
                 </tr>";

                  };
                  echo "
                  </table>
                                    
                <p><input type=\"submit\" value=\"Отправить\"></p>
                  
              
        </form>
              </div>
          </div>
      </div>
  </div>";

?>
