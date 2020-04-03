<?php
    if ( ($h = fopen("schedule.csv", "r")) !== FALSE ) {

        echo '<table border="1" id="list">
            <caption><h2>Рух автобусів зі станції м.Чернівці</h2></caption>';
        echo '<tr><th>Номер рейсу</th>
            <th>Місто призначення</th>
            <th>Час відправлення</th>
            <th>Водій</th>
            <th>Вартість квитка</th></tr>';

        while ( ($data = fgetcsv($h, 1000, ",")) !== FALSE ) {
            
            echo '<tr>';

            foreach ($data as $value) {
                echo '<td>' . trim($value) . '</td>';
            }
            
            echo '</tr>';
        }

        echo '</table>';

        fclose($h);
    }
?>