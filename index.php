<?php

$host = 'localhost';
$db = 'simple_app';
$user = 'root';
$pass = 'root'; 

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Insert user
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $conn->real_escape_string($_POST["name"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $telephone = $conn->real_escape_string($_POST["telephone"]);

    $sql = "INSERT INTO users (name, email, telephone) VALUES ('$name', '$email', '$telephone')";
    $conn->query($sql);
}

// Get all users
$result = $conn->query("SELECT * FROM users");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Registration App</title>
</head>
<body>
    <h1>Register a New User</h1>
    <form method="post">
        <label>Name:</label><br>
        <input type="text" name="name" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Telephone:</label><br>
        <input type="text" name="telephone" required><br><br>

        <button type="submit">Save User</button>
    </form>

    <h2>Registered Users</h2>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>ID</th><th>Name</th><th>Email</th><th>Telephone</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row["id"]) ?></td>
            <td><?= htmlspecialchars($row["name"]) ?></td>
            <td><?= htmlspecialchars($row["email"]) ?></td>
            <td><?= htmlspecialchars($row["telephone"]) ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
