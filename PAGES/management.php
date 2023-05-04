<?php
    if (session_status() != PHP_SESSION_ACTIVE) {
        session_start();
    }
    if (isset($_SESSION['account_change']) and $_SESSION['account_change'] == TRUE) {
        $_SESSION['account_change'] = FALSE;
        header("Location: management.php");
        die();
    }
?>

<!DOCTYPE html>
<html>
<head>
<title>Przedszkole</title>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="../CSS/style.css">
    
</head>
<body>

<div id="container">
<div id="baner">
<h1>Kindergarten no. 11 in Kołobrzeg</h1>
    <div id="left_top">
        <img src="../IMAGES/godlo.png" id="godlo">
        <a href="login.php" id="logowanie">Log in / Account info</a>
    </div>
    </h1>
</div>
<div id="menu">
<table id="tabela_menu">
<tr>
<td><a href="index.html">Home page</a></td>
<td><a href="management.php">Management</a></td>
<td><a href="hours.html">Opening time </a></td>
<td><a href="parents.php">Parent's zone</a></td>
<td><a href="contact.html">Contact</a></td>
<td><a href="about.html">About</a></td>
</tr>


</table>
</div>
<div id="left">
<table id="tabela_left">
<tr>
<td><a href="holidays.html" id="holidays">Holidays</a></td>
</tr>

<tr>
<td><a href="" id="rodoo">RODO</a></td>    
</tr>
<tr>
<td><a href="statut.html" id="statute">Statute</a></td>    
</tr>
<tr>
<td><a href="day.html" id="schedule">Day schedule</a></td>    
</tr>
<tr>
<td><a href="food.html" id="foodd">Food menu</a></td>    
</tr>
<tr>
<td><a href="groups.html" id="groups">Groups</a></td>    
</tr>
<tr>
<td><a href="extra.html" id="activities">Extra activities</a></td>    
</tr>

</table>
</div>
<div id="mid">
<h1 id="group">ACCOUNT MANAGEMENT</h1>
<?php
    $group_info_available = NULL;
    $conn = mysqli_connect("127.0.0.1", "root", "", "przedszkole_Adamczyk_Chojnacki");
    if (!$conn) {
        echo "Couldn't connect to database.";
    }
    else {
        if (!isset($_SESSION['account_id'])) {
            echo "<script>
            if (confirm('Log in as administrator to access this area.')) window.location = 'login.php'
            else window.location = 'index.html'</script>";
        }

        $_query1 = "SELECT accounts.id as id, account_types.name as 'account_type' FROM accounts 
        JOIN account_types ON account_types.id = accounts.Account_types_id WHERE accounts.id = ".$_SESSION['account_id'].";";
        $access_level = 0;
        $query = mysqli_query($conn, $_query1);
        $row = mysqli_fetch_array($query);
        if ($row['id'] == $_SESSION['account_id']) {
            if ($row['account_type'] == 'admin') {
                $access_level = 2;
            }
            else {
                $access_level = 1;
            }
        }
        
        if ($access_level < 2) {
            echo "<script>alert('You do not have access to this part of the site! Redirecting.'); window.location = 'index.html'</script>";
        }

        echo "<p><table class='group_info'>";
        $_query1 = "SELECT `accounts`.`id` as 'id', `groups`.`name` as 'group_name', `login` FROM accounts 
        JOIN groups ON Groups_id = `groups`.`id`;";
        $query = mysqli_query($conn, $_query1);
        echo "
        <tr class='group_info'>
            <td class='group_info'>Login</td>
            <td class='group_info_2'>Group access</td>
            <td class='group_info'>Reset password</td>
            <td class='group_info_2'>Remove account</td>
        </tr>";

        $light = FALSE;
        while ($row = mysqli_fetch_array($query)) {
            echo "<tr class='group_info_2'>";
            if ($light) {
                echo "
                <td class='group_info_2'>".$row['login']."</td>

                <td class='group_info'>".$row['group_name']."</td>

                <td class='group_info_2'><form method='POST'>
                <input type='hidden' name='account_id' value='".$row['id']."'>
                <input class='submit_button' type='submit' name='reset_password' value='Reset password'>
                </form></td>

                <td class='group_info'><form method='POST'>
                <input type='hidden' name='account_id' value='".$row['id']."'>";
                if ($row['id'] == $_SESSION['account_id']) echo "You can't remove your own account.";
                else echo "<input class='submit_button' type='submit' name='remove_account' value='Remove account'>";
                echo "</form></td>";
            }
            else {
                echo "
                <td class='group_info'>".$row['login']."</td>

                <td class='group_info_2'>".$row['group_name']."</td>

                <td class='group_info'><form method='POST'>
                <input type='hidden' name='account_id' value='".$row['id']."'>
                <input class='submit_button' type='submit' name='reset_password' value='Reset password'>
                </form></td>

                <td class='group_info_2'><form method='POST'>
                <input type='hidden' name='account_id' value='".$row['id']."'>";
                if ($row['id'] == $_SESSION['account_id']) echo "You can't remove your own account.";
                else echo "<input class='submit_button' type='submit' name='remove_account' value='Remove account'>";
                echo "</form></td>";
            }
            echo "</tr>";
            $light = !$light;
        }
        echo "</table>";

        if (isset($_POST['remove_account'])) {
            $_query1 = "DELETE FROM accounts WHERE id = ".$_POST['account_id'].";";
            $query = mysqli_query($conn, $_query1);
            $_SESSION['account_change'] = TRUE;
            echo "<script>window.location.reload()</script>";
        }

        if (isset($_POST['reset_password'])) {
            $length = 8;
            $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_-';
            $passphrase = substr(str_shuffle($chars), 0, $length);
            $_query1 = "UPDATE `accounts` SET `passphrase` = '".md5($passphrase)."' WHERE `accounts`.`id` = ".$_POST['account_id'].";";
            $query = mysqli_query($conn, $_query1);
            $_SESSION['account_change'] = TRUE;
            echo "<script>alert('Their password has been reset to \"".$passphrase."\"'); window.location.reload()</script>";
        }
        echo "</p><p><form method='POST'><table class='group_info'>
        <tr class='group_info_2'>
            <td class='group_info'>Login:<br><input type='text' name='login'></td>
            <td class='group_info_2'>Group access:<br>
            <label><input type='radio' name='group_access' value='1'>Ladybugs</label><br>
            <label><input type='radio' name='group_access' value='2'>Daisies</label><br>
            <label><input type='radio' name='group_access' value='3'>Strawberries</label></td>
            <td class='group_info'><input type='submit' class='submit_button' name='create_account' value='Create account'></td>
        </tr></table></form></p>";

        if (isset($_POST['create_account']) and isset($_POST['login']) and isset($_POST['group_access'])) {
            $length = 8;
            $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_-';
            $passphrase = substr(str_shuffle($chars), 0, $length);
            $_query1 = "INSERT INTO `accounts` (`id`, `Account_types_id`, `Groups_id`, `login`, `passphrase`) VALUES 
            (NULL, '2', '".$_POST['group_access']."', '".$_POST['login']."', '".md5($passphrase)."');";
            $query = mysqli_query($conn, $_query1);
            $_SESSION['account_change'] = TRUE;
            echo "<script>alert('Created an account. The password is \"".$passphrase."\".'); window.location.reload()</script>";
        }
    }
?>
</div>

<div id="footer">

</div>


















</div>
</body>
</html>