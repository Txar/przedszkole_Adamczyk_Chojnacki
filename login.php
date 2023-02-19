<?php
    if (session_status() != PHP_SESSION_ACTIVE) {
        session_start();
    }
    if (isset($_SESSION['account_id'])) {
        header("Location: account_options.php");
        die();
    }
    $conn = mysqli_connect("127.0.0.1", "root", "", "przedszkole_Adamczyk_Chojnacki");
    if (!$conn) {
        echo "<script>alert('Couldn't connect to database! Redirecting to home page.')</script>";
        header("Location: index.html");
        die();
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Przedszkole</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="login_style.css">        
</head>
<body>

<div id="container">
    <div id="login_menu">
        <div class="shadow_text"><h1>Logging in</h1></div>
        <p>
        Input your login and password to log in. If you do not have an account, you can still explore the <a href="index.html">page</a> with limited access to information.
        If you lost access or think you should have an account <a href="contact.html">contact the administrator</a>.
        </p>
        <form method="POST">
            <p><table>
                <tr>
                    <td>Login:</td>
                    <td><input type="text" name="login"></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="passphrase"></td>
                </tr>
            </table></p>
            <button type="submit">Log in</button>

        <p class="warning">
        <?php
            if (isset($_POST["login"]) and isset($_POST["passphrase"])) {
                $login = $_POST["login"];
                $passphrase = $_POST["passphrase"];
                
                if (!(is_null($login) or is_null($passphrase) or $login == "" or $passphrase == "")){
                    $_query1 = "SELECT id, login, passphrase FROM accounts;";
                    $query = mysqli_query($conn, $_query1);

                    while ($row = mysqli_fetch_array($query)) {
                        if ($login == $row['login'] and md5($passphrase) == $row['passphrase']){
                            echo "<a>Logged in succesfully!</a>";
                            $_SESSION['account_id'] = $row['id'];
                            session_write_close();
                        }
                    }

                    if (!isset($_SESSION['account_id'])) echo "Incorrect. Make sure to input your login and password thoroughly.";
                }
            }
        ?>
        </p>
        </form>

        <a id="back_button" href="index.html">Back to home page</a>
    </div>
</div>
</div>
</body>
</html>