<!DOCTYPE html>
<html>
<head>
    <title>Salary</title>
    </head>
    <body>

    <h2>Salary Calculator</h2>

    <form method="post">
        Basic Salary: <input type="text" name="basic"><br><br>
            HRA: <input type="text" name="hra"><br><br>
                DA: <input type="text" name="da"><br><br>

                    <input type="submit" name="submit" value="Total Salary">
                    </form>

                    <?php
                    if(isset($_POST['submit']))
                    {
                        $total = $_POST['basic'] + $_POST['hra'] + $_POST['da'];
                            echo "Total Salary = ".$total;
                            }
                            ?>

                            </body>
                            </html>