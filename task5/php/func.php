<?php
//Объявляем глобальную переменную которая будет отвечать за соединение с БД.
global $connection;
//Создаем подключение к БД через trycatch для возможного перехвата ошибок, и делаем кодировку.
try {
    $connection = new mysqli("127.0.0.1", "root", "root", "intervolga_db");
    $connection->query("SET NAMES 'utf8'");
    $systemMessage = "Сообщения отсутсвуют";
} catch (Exception $e) {
    $error = $e->getMessage();
    echo $error;
}
//Функция добавления стран,плюс редирект на главную страницу
function addCountry($country_name, $connection)
{
    $add = $connection->query("INSERT INTO intervolga_db.countries (id, country_name) VALUES (NULL, '$country_name')");
    if ($add) {
        $GLOBALS['systemMessage'] = "Добавлена новая страна";
        $country_name = "";
        header("Location: http://localhost");
    } else {
        $GLOBALS['systemMessage'] = "Ошибка добавления страны в БД";
    }
}
//Если было инициализировано добавление страны, то заносим в БД,тоже через trycatch
try {
    if ($_POST['add']) {
        $country_name = mysqli_real_escape_string($connection, trim($_POST['country_name']));
        if (!empty($country_name) &&!is_numeric($country_name))
            addCountry($country_name, $connection);            
    }
} catch (Exception $er) {
    $err = $er->getMessage();
}

//Вывод информации
function countryList($connection)
{
    $countries = $connection->query("SELECT * FROM countries");
    $num = 0;
    //
    while (($row = $countries->fetch_assoc()) != FALSE) {
        $num++;
        $id = $row['id'];
        echo '
        <tr>
            <td>' . $row['id'] . '</td>
            <td>' . $row['country_name'] . '</td>
            <td>
                <form method="get">
                <input type="hidden" name="id" value="' . $id . '">
                <input class="del" type="submit" name="del" value="Удалить" >
                </form>
            </td>
        </tr>';
    }
}
//Удаляем данные из БД,и редирект на главную страницу
if($_GET['del']){
    $id = $_GET['id'];
    $del = $connection->query("DELETE FROM countries WHERE id = $id");  
    header("Location: http://localhost");
    if($del){
        $GLOBALS['systemMessage'] = "Страна удалена.";
    }else{
        $GLOBALS['systemMessage'] = " Ошибка удаления";
    }
    
}
//Системные сообщения
echo "<p style='color: red; font-size: 22px;'>" . $systemMessage . "</p>";
?>