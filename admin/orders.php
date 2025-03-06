<?php
require __DIR__ . "/../config/config.php";

// Ma'lumotlarni olish
// SQL so‘rov
$sql = "SELECT 
            orders.id, 
            users_telegram.username,  
            courses.description AS course_name, 
            orders.course_price, 
            orders.order_date  
        FROM orders 
        JOIN users_telegram ON orders.user_id = users_telegram.id  
        JOIN courses ON orders.course_id = courses.id 
        ORDER BY orders.order_date DESC";

$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buyurtmalar ro‘yxati</title>
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<body>
            <div class="admin-header">
        <h1>Admin Panel</h1>
        <a href="index.php">Asosiy</a> |
        <a href="courses.php">Kurslar</a> | 
        <a href="users.php">Foydalanuvchilar</a> | 
        <a href="orders.php">Buyurtmalar</a> | 
        <a href="logout.php">Chiqish</a>
    </div>

<h2>Buyurtmalar ro‘yxati</h2>
<table>
    <tr>
        <th>#</th>
        <th>Foydalanuvchi</th>
        <th>Kurs nomi</th>
        <th>Narx ($)</th>
        <th>Buyurtma sanasi</th>
    </tr>

    <?php 
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['username']}</td>
                    <td>{$row['course_name']}</td>
                    <td>\${$row['course_price']}</td>
                    <td>{$row['order_date']}</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='5'>Hech qanday buyurtma topilmadi.</td></tr>";
    }
    ?>
</table>

</body>
</html>

<?php
// Ulanishni yopish
$conn->close();
?>
