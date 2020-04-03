<?php
    if ( ($h = fopen("schedule.csv", "r")) !== FALSE ) {

        $data = [];

        while ( ($line = fgetcsv($h, 1000, ",")) !== FALSE ) {
            $data[] = $line;
        }

        fclose($h);

        $price_column = array_column($data, 4);
        array_multisort($price_column, SORT_ASC, $data);


        echo '<table border="1" id="list">
            <caption><h2>Рух автобусів зі станції м.Чернівці</h2></caption>';
        echo '<tr><th>Номер рейсу</th>
            <th>Місто призначення</th>
            <th>Час відправлення</th>
            <th>Водій</th>
            <th>Вартість квитка &#9650;</th></tr>';

        $lviv_count = 0;
        foreach ($data as $row) {
            echo '<tr>';

            foreach ($row as $value) {
                echo '<td>' . trim($value) . '</td>';
                if (trim($value) == "Львів")    ++$lviv_count;
            }

            echo '</tr>'; 
        }

        echo '</table>';
    }

?>