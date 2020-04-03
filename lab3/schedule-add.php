<?php 
    define("UKR", "йцукенгшщзхїфівапролджєячсмитьбюЙЦУКЕНГШЩЗХЇФІВАПРОЛДЖЄЯЧСМИТЬБЮ");
    define("REQUIRED_MSG", "дане поле не може бути пустим");

    $number = $destination = $time = $driver = $price = "";
    $numberErr = $destinationErr = $timeErr = $driverErr = $priceErr = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (trim($_POST["number"]) === '') {
            $numberErr = REQUIRED_MSG;
        } else {
            $number = test_input($_POST["number"]);
            if (!preg_match("/^[0-9" . UKR . "]*$/", $number)) {
                $numberErr = "Номер рейсу повинен складатися тільки з цифр і букв українського алфавіту.";
            }
        }

        if (trim($_POST["destination"]) === '') {
            $destinationErr = REQUIRED_MSG;
        } else {
            $destination = test_input($_POST["destination"]);
            if (!preg_match("/^[" . UKR . "-]*$/", $destination)) {
                echo "<script type='text/javascript'>alert('$destination');</script>";
                $destinationErr = "Місто призначення повинно складатися тільки з букв українського алфавіту.";
            }
        }

        if (trim($_POST["time"]) === '') {
            $timeErr = REQUIRED_MSG;
        } else {
            $time = test_input($_POST["time"]);
        }

        if (trim($_POST["driver"]) === '') {
            $driverErr = REQUIRED_MSG;
        } else {
            $driver = test_input($_POST["driver"]);
            if (!preg_match("/^[" . UKR . "' ]*$/", $driver)) {
                $driverErr = "Прізвище та ім'я водія повинні складатися тільки з букв українського алфавіту.";
            }
            if (count(explode(" ", $driver)) != 2) {
                $driverErr = "Дане поле повинне включати прізвище та ім'я водія.";
            }
        }

        if (trim($_POST["price"]) === '') {
            $priceErr = REQUIRED_MSG;
        } else {
            $price = test_input($_POST["price"]);
            if (!preg_match("/^\d+(\.\d+)?$/", $price)) {
                $priceErr = "Значення введено некоректно";
                if ($price < 0) {
                    $priceErr = "Вартість квитка не може бути від'ємною.";
                }
            }
        }

        if ($numberErr == "" && $destinationErr == "" && $timeErr == "" && $driverErr == "" && $priceErr == "") {
            if (($handle = fopen("schedule.csv", "a")) !== FALSE) {
                $entry = "\n" . $number . ", " . $destination . ", " . $time . ", " . $driver . ", " . $price;
                fwrite($handle, $entry);

                fclose($handle);

                $number = $destination = $time = $driver = $price = "";
                header("Refresh:0");
            }
        }
    }

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>