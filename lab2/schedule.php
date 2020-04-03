<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Рух автобусів</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="wrapper">
        <?php include "schedule-table.php" ?>
        <?php include "schedule-add.php" ?>
        <div class="add">
            <form action="schedule.php" method="post">
                <fieldset>
                    <table>
                        <caption>
                            <h2>Додати рейс</h2>
                        </caption>
                        <tr>
                            <td><label for="number">Номер рейсу <span class="error">*</span></label></td>
                            <td>
                                <input type="text" id="number" name="number" maxlength="5" value="<?php echo $number; ?>" required>
                                <span class="error"><?php echo $numberErr; ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="destination">Місто призначення <span class="error">*</span></label></td>
                            <td>
                                <input type="text" id="destination" name="destination" maxlength="15" value="<?php echo $destination; ?>" required>
                                <span class="error"><?php echo $destinationErr; ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="time">Час відправлення <span class="error">*</span></label></td>
                            <td>
                                <input type="time" id="time" name="time" value="<?php echo $time; ?>" required>
                                <span class="error"><?php echo $timeErr; ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="driver">Водій <span class="error">*</span></label></td>
                            <td>
                                <input type="text" id="driver" name="driver" maxlength="50" value="<?php echo $driver; ?>" required>
                                <span class="error"><?php echo $driverErr; ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="price">Вартість квитка <span class="error">*</span></label></td>
                            <td>
                                <input type="text" id="price" name="price" maxlength="7" value="<?php echo $price; ?>" required>
                                <span class="error"><?php echo $priceErr; ?></span>
                            </td>
                        </tr>
                    </table>
                    <p style="text-align: right; padding-right: 7px;"><span class="error">* - обов'язкове поле</span></p>
                    <input type="submit" value="Додати">
                </fieldset>
            </form>
        </div>
    </div>
</body>

</html>