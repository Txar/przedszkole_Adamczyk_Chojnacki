<?php
    if (session_status() != PHP_SESSION_ACTIVE) {
        session_start();
    }
    if (!isset($_SESSION['account_id'])){
        header("Location: login.php");
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
        <div class="shadow_text"><h1>Account settings</h1></div>
        <form method="POST">
            <p><table>
                <tr>
                    <td>Logged in as:</td>
                    <td>
                    <?php
                        $_query1 = "SELECT id, login FROM accounts;";
                        $query = mysqli_query($conn, $_query1);
                        while ($row = mysqli_fetch_array($query)) {
                            if ($_SESSION['account_id'] == $row['id']) {
                                echo $row['login'];
                            }
                        }
                    ?>
                    </td>
                </tr>
                <tr>
                    <td>Account type:</td>
                    <td>
                    <?php
                        $_query1 = "SELECT id, login FROM accounts;";
                        $query = mysqli_query($conn, $_query1);
                        while ($row = mysqli_fetch_array($query)) {
                            if ($_SESSION['account_id'] == $row['id']) {
                                echo $row['login'];
                            }
                        }
                    ?>
                </tr>
            </table></p>
            <hr>
            
            <h3>Password change</h3>
            <p>
            <table>
                <tr>
                    <td>Old password:</td>
                    <td><input type="password" name="passphrase"></td>
                </tr>
                <tr>
                    <td>New password:</td>
                    <td><input type="password" name="new_passphrase"></td>
                </tr>
                <tr>
                    <td>Repeat new password:</td>
                    <td><input type="password" name="new_passphrase_repeat"></td>
                </tr>
            </table></p>
            <button type="submit">Change password</button>
            <p class="warning">
            <?php
                if (isset($_POST["passphrase"]) and isset($_POST["new_passphrase"])) {
                    $passphrase = $_POST["passphrase"];
                    $new_passphrase = $_POST["new_passphrase"];
                    
                    if (!(is_null($passphrase) or $passphrase == "")) {
                        $success = FALSE;
                        if ($new_passphrase == $_POST["new_passphrase_repeat"]) {
                            $_query1 = "SELECT id, passphrase FROM accounts;";
                            $query = mysqli_query($conn, $_query1);

                            while ($row = mysqli_fetch_array($query)) {
                                if ($_SESSION['account_id'] == $row['id'] and md5($passphrase) == $row['passphrase']){
                                    $_query2 = "UPDATE `accounts` SET `passphrase` = '".md5($new_passphrase)."' WHERE `accounts`.`id` = ".$_SESSION['account_id'].";";
                                    $query2 = mysqli_query($conn, $_query2);
                                    echo "<a>Changed password succesfully!</a>";
                                    $_SESSION['account_id'] = $row['id'];
                                    $success = TRUE;
                                    break;
                                }
                            }
                        }
                        if (!$success) echo "Incorrect. Make sure to input your old and new password thoroughly.";
                    }
                }
            ?>
        </p>
        <p>
            <input type="submit" name="log_out" value="Log out" />
        </p>
        <?php
            if (isset($_POST["log_out"])) {
                session_unset();
            }
        ?>
        </form>

        <a id="back_button" href="index.html">Back to home page</a>
    </div>
</div>
</div>
</body>
</html>