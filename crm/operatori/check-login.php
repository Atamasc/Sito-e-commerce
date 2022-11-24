<?php include("../inc/db-conn.php"); ?>
<?php
@$username = $_POST["username"];
@$password = $_POST["password"];
$remember = isset($_POST['remember']) ? 1 : 0;

$username = trim($username);
$password = trim($password);
$username = @$dbConn->real_escape_string($username);
$password = @$dbConn->real_escape_string($password);

$querySql = "SELECT * FROM op_operatori WHERE op_codice = '$username' AND op_password = '$password' ";
$result = @$dbConn->query($querySql);
$rows = @$dbConn->affected_rows;

while (($row_data = $result->fetch_assoc()) !== NULL) {
    $id = $row_data['op_id'];
}

$result->close();
$dbConn->close();

if ($rows == 0) {
    header('Location:index.php?login=false');
} else {
    session_start();
    $_SESSION['login'] = "operatore";
    $_SESSION['id'] = $id;
    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password;

    if ($remember == 1) {
        //$hour = time() + 3600 * 24 * 30;
        setcookie('login', "operatore");
        setcookie('id', $id);
        setcookie('username', $username);
        setcookie('password', $password);
    };

    header('location:dashboard.php');
};
?>
