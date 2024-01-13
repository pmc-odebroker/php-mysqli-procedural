<?php
$result;
function emptyUserSignup($firstname, $middlename, $lastname, $email, $username, $password, $repeatpassword) {
    if (empty($firstname) || empty($middlename) || empty($lastname) || empty($email) || empty($username) || empty($password) || empty($repeatpassword)) {
        $result = true;
    } else {
        $result = false;
    }
    echo "emptyUserSignup result: " . var_export($result, true) . "<br>";
    return $result;
}

function InvalidUsername($username) {
    if (!preg_match("/^[a-zA-Z0-9_]{5,15}$/", $username)) {
        $result = true;
    } else {
        $result = false;
    }
    echo "InvalidUsername result: " . var_export($result, true) . "<br>";
    return $result;
}

function InvalidEmail($email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } else {
        $result = false;
    }
    echo "InvalidEmail result: " . var_export($result, true) . "<br>";
    return $result;
}

function PasswordMismatch($password, $repeatpassword) {
    if ($password !== $repeatpassword) {
        $result = true;
    } else {
        $result = false;
    }
    echo "PasswordMismatch result: " . var_export($result, true) . "<br>";
    return $result;
}

function UsernameExist($conn, $username, $email) {
    $sql = "SELECT * FROM users WHERE username = ? OR email = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
    }
    mysqli_stmt_bind_param($stmt, 'ss', $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}

function createUser($conn, $firstname, $middlename, $lastname, $email, $username, $password) {
    // Debugging: Check the connection
    if (!$conn) {
        echo "Connection failed: " . mysqli_connect_error() . "<br>";
        exit();
    } else {
        echo "Connected successfully to the database!<br>";
    }

    echo "createUser function called with parameters: ";
    var_dump($firstname, $middlename, $lastname, $email, $username, $password);

    $sql = "INSERT INTO users (first_name, middle_name, last_name, email, username, password) VALUES (?, ?, ?, ?, ?, ?)";
    echo "SQL Query: $sql<br>";

    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
    echo "Hashed Password: $hashedPwd<br>";

    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "Prepare failed: " . mysqli_error($conn) . "<br>";
        exit();
    }

    mysqli_stmt_bind_param($stmt, 'ssssss', $firstname, $middlename, $lastname, $email, $username, $hashedPwd);
    echo "Executing SQL query...<br>";

    if (!mysqli_stmt_execute($stmt)) {
        echo "Execution failed: " . mysqli_error($conn) . "<br>";
        exit();
    }

    echo "User successfully created!<br>";
}


?>
