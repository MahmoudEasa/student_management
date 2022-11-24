<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home.css">
    <title>Student Management</title>
</head>
<body>
    <?php
        // الأتصال مع قاعدة البيانات
        $host = "localhost";
        $user = "root";
        $pass = "";
        $db = "student1";
        $con = mysqli_connect($host, $user, $pass, $db);
        $res = mysqli_query($con, "select * from student");

        // Button Variable --
        $id = "";
        $name = "";
        $address = "";

        if(isset($_POST["id"])) {
            $id = $_POST["id"];
        }
        if(isset($_POST["name"])) {
            $name = $_POST["name"];
        }
        if(isset($_POST["address"])) {
            $address = $_POST["address"];
        }

        $sqls = "";
        if(isset($_POST["add"])){
            $sqls = "insert into student value($id, '$name', '$address')";
            mysqli_query($con, $sqls);
            header("location: home.php");
        }
        if(isset($_POST["del"])){
            $sqls = "delete from student where name='$name'";
            mysqli_query($con, $sqls);
            header("location: home.php");
        }
    ?>
    
    <div id="mother">
        <form action="" method="post">
            <!-- لوحة التحكم -->
            <aside>
                <div id="div">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/6/6c/Syndicalist_student.png" alt="لوجو الموقع">
                    <h3>لوحة المدير</h3>
                    <label for="id">رقم الطالب:</label><br>
                    <input type="text" name="id" id="id"><br>

                    <label for="name">أسم الطالب:</label><br>
                    <input type="text" name="name" id="name"><br>

                    <label for="address">عنوان الطالب:</label><br>
                    <input type="text" name="address" id="address"><br>
                    <button name="add">إضافة طالب</button>
                    <button name="del">حذف طالب</button>
                </div>
            </aside>
            <!-- عرض بيانات الطلاب -->
            <main>
                <table id="tbl">
                    <tr>
                        <th>الرقم التسلسلي</th>
                        <th>أسم الطالب</th>
                        <th>عنوان الطالب</th>
                    </tr>
                    <?php 
                        while($row = mysqli_fetch_array($res)) {
                            echo "<tr>";
                                echo "<td>" . $row["id"] . "</td>";
                                echo "<td>" . $row["name"] . "</td>";
                                echo "<td>" . $row["address"] . "</td>";
                            echo "</tr>";
                        };
                    ?>
                </table>
            </main>
        </form>
    </div>
</body>
</html>