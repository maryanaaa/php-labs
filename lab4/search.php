<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Пошук</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div id="search">
        <hr>
        <form method="post">
            <table>
                <tr>
                    <th>
                        <label for="keyword">Пошук за прізвищем водія</label>
                        <input type="text" id="keyword" name="keyword" maxlength="20" required>
                    </th>
                    <td style="width:auto"><input type="submit" value="Пошук"></td>
                </tr>
            </table>
        </form>
        <hr>
        <?php
            define("UKR", "йцукенгшщзхїфівапролджєячсмитьбюЙЦУКЕНГШЩЗХЇФІВАПРОЛДЖЄЯЧСМИТЬБЮ");
            $keywordErr = "";

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $keyword = trim($_POST["keyword"]);

                if ($keyword === '') {
                    $keywordErr = "дане поле не може бути пустим";
                } else {
                    if (!preg_match("/^[" . UKR . "' ]*$/", $keyword)) {
                        $keywordErr = "допустимими символами є тільки букви українського алфавіту";
                        echo '<h3><span class="error">' . $keywordErr . '</span></h3>';
                    }
                }

                
                if ($keywordErr == "") {
                    if ( ($h = fopen("schedule.csv", "r")) !== FALSE ) {

                        $data = [];

                        $keyword = mb_strtoupper($keyword);

                        while ( ($line = fgetcsv($h, 1000, ",")) !== FALSE ) {
                            $surname = explode(" ", trim($line[3]))[0];
                            if ( preg_match( "/^.*$keyword.*$/", mb_strtoupper($surname) ) )
                                $data[] = $line;
                        }
                
                        fclose($h);   
                        
                        if (!empty($data)) {
                            echo '<table border="1" id="list">
                                <caption><h2>Знайдено ' . count($data) . ' результати</h2></caption>';
                            echo '<tr><th>Номер рейсу</th>
                                <th>Місто призначення</th>
                                <th>Час відправлення</th>
                                <th>Водій</th>
                                <th>Вартість квитка</th></tr>';

                                foreach ($data as $row) {
                                    echo '<tr>';
                        
                                    foreach ($row as $value) {
                                        echo '<td>' . trim($value) . '</td>';
                                    }
                        
                                    echo '</tr>'; 
                                }
                        
                                echo '</table>';
                        }
                    }

                    $keyword = ""; 
                }
            }
        ?>
    </div>
</body>

</html>