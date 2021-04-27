<?php
# ЗАГРУЖАЕМ НЕОБХОДИМЫЕ ФАЙЛЫ НА САЙТ

$uploaddir = '..';

if (!empty($_POST['adres']))  {
    // echo "00000".$_POST['adres']."<br>";
    $uploaddir = '..'.$_POST['adres'];
    };

$Files_count = 0;
    // echo "КОЛИЧЕСТВО ФАЙЛОВ NN = ".count($_FILES['upload_file']['name']). "<br>";

for ($i=0; $i < count($_FILES['upload_file']['name']); $i++ ){
$uploadfile = $uploaddir . basename($_FILES['upload_file']['name'][$i]);

$file_name = basename($_FILES['upload_file']['name'][$i]);

//  echo "3333--" . $uploadfile;
// echo "<br>888==".$_FILES['upload_file']['tmp_name']."<br>";

        if (move_uploaded_file($_FILES['upload_file']['tmp_name'][$i], $uploadfile)) {
            // echo "Файл корректен и был успешно загружен.\n";
            $Files_count++;
             if ($Files_count == count($_FILES['upload_file']['name'])) {
                header("Location: ../index.php?fullload=777"); exit();
             }
             

        } else {
            echo '<pre>';
                
                echo "Некоторая отладочная информация:\n";
                    print_r($_FILES);

                    print "</pre>";
        }

}






?>

<!-- $uploaddir = '..';

if (!empty($_POST['adres']))  {
    // echo "00000".$_POST['adres']."<br>";
    $uploaddir = '..'.$_POST['adres'];
    };
$uploadfile = $uploaddir . basename($_FILES['upload_file']['name']);

$file_name = basename($_FILES['upload_file']['name']);

//  echo "3333--" . $uploadfile;
// echo "<br>888==".$_FILES['upload_file']['tmp_name']."<br>";
echo '<pre>';
if (move_uploaded_file($_FILES['upload_file']['tmp_name'], $uploadfile)) {
    echo "Файл корректен и был успешно загружен.\n";
    header("Location: ../index.php?fullload=".$file_name); exit();
} else {
    echo "Возможная атака с помощью файловой загрузки!\n";
}

echo 'Некоторая отладочная информация:';
print_r($_FILES);

print "</pre>";

?> -->