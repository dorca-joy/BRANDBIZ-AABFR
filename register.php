<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $host = 'localhost';
    $port = '5432';
    $dbname = 'registerform';
    $user = 'postgres';
    $dbpassword = 'justaqua32011904';

    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$dbpassword";

    try {
        $pdo = new PDO($dsn);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Hash the password before storing it
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // SQL query to insert user data into the 'registration' table
        $sql = "INSERT INTO registration (firstname, lastname, email, password) VALUES (:firstname, :lastname, :email, :password)";

        // Prepare the SQL statement to prevent SQL injection
        $stmt = $pdo->prepare($sql);

        // Bind parameters to the prepared statement
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);

        // Execute the prepared statement
        if ($stmt->execute()) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $stmt->errorCode();
        }
    } catch (PDOException $e) {
        if ($e->getCode() == 23505) {
            echo "Email already exists. Please use a different email.";
        } else {
            echo $e->getMessage();
        }
    }
}
