<?php
include_once '../config/database.php';
include_once '../models/category.php';
include_once '../models/story.php';
$database = new Database();
$db = $database->getConnection();
$story = new Story($db);
$category = new Category($db);

if (isset($_POST['ok'])) {

    $search = $_POST['search'];


    if (empty($search)) {
        echo "Yeu cau nhap du lieu vao o trong";
    } else {

        $query = "select * from list where name like '%$search%'";
        $stmt = $story->conn->prepare($query);
        $stmt->execute();

        $num = 5;

        if ($num > 0 && $search != "") {

            echo "$num ket qua tra ve voi tu khoa <b>$search</b>";


            echo '<table border="1" cellspacing="0" cellpadding="10">';
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<tr>';
                echo "<td>{$row['name']}</td>";
                echo "<td>{$row['images']}</td>";
                echo "<td>{$row['link']}</td>";
                echo "<td>{$row['view']}</td>";
                echo "<td>{$row['nation']}</td>";
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo "Khong tim thay ket qua!";
        }
    }
}
?>
</body>

</html>