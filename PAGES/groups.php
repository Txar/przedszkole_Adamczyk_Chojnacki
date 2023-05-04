<?php
    if (session_status() != PHP_SESSION_ACTIVE) {
        session_start();
    }
    if (isset($_SESSION['assigned_child']) and $_SESSION['assigned_child'] == TRUE) {
        $_SESSION['assigned_child'] = FALSE;
        header('Location: groups.php');
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
<td><a href="parents.html">Parent's zone</a></td>
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
<h1 id="group">GROUPS</h1>
<?php
    //hasło Joanny: "hasło_Joanny"
    $group_info_available = NULL;
    $conn = mysqli_connect("127.0.0.1", "root", "", "przedszkole_Adamczyk_Chojnacki");
    if (!$conn) {
        echo "Couldn't connect to database.";
        echo "<br><h2 id='group2'>Ladybugs</h2>";
        echo "<br><h2 id='group2'>Daisies</h2>";
        echo "<br><h2 id='group2'>Strawberries</h2>";
    }
    else {
        $group_info_available = NULL;
        $access_level = 0;
        if (isset($_SESSION['account_id'])) {
            $_query1 = "SELECT accounts.id as id, account_types.name as 'account_type', accounts.Groups_id as 'group' FROM accounts 
            JOIN account_types ON account_types.id = accounts.Account_types_id WHERE accounts.id = ".$_SESSION['account_id'].";";
            $query = mysqli_query($conn, $_query1);
            $row = mysqli_fetch_array($query);
            if ($row['id'] == $_SESSION['account_id']) {
                if ($row['account_type'] == 'admin') {
                    $access_level = 2;
                }
                else {
                    $access_level = 1;
                }
                $group_info_available = $row['group'];
            }
        }

        echo "<br><h2 id='group2'>Ladybugs</h2><p class='group_info'>";
        if ($group_info_available == 1 or $access_level == 2) {
            $_query1 = 'SELECT first_name, last_name FROM teachers WHERE Groups_id = 1;';
            $query = mysqli_query($conn, $_query1);
            $row = mysqli_fetch_array($query);
            echo "<h3 class='teacher_name'>Teacher: ".$row['first_name']." ".$row['last_name']."</h3><br>";

            echo "<table class='group_info'>";
            $_query1 = 'SELECT children.id as "child_id", children.first_name as "child_first_name", 
            children.last_name as "child_last_name", PESEL, children.gender as "child_gender", 
            parents.first_name as "parent_first_name", parents.last_name as "parent_last_name", 
            city, street, zip_code, phone_number FROM children JOIN parents ON Parents_id = parents.id WHERE Groups_id = 1;';
            $query = mysqli_query($conn, $_query1);
            echo 
            "<tr class='group_info'>
                <td class='group_info_2'>Child's name</td>
                <td class='group_info'>Child's gender</td>
                <td class='group_info_2'>Child's PESEL</td>
                <td class='group_info'>Parent's name</td>
                <td class='group_info_2'>Parent's contact info</td>";
            if ($access_level == 2) {
                echo "<td class='group_info'>Remove from group</td>";
            }
            echo "</tr>";
            $light = FALSE;
            while ($row = mysqli_fetch_array($query)) {
                echo "<tr class='group_info_2'>";
                if ($light) {
                    echo "<td class='group_info_2'>".$row['child_first_name']."<br>".$row['child_last_name']."</td>";
                    echo "<td class='group_info'>";
                    if ($row['child_gender'] == "f") echo "fe";
                    echo "male</td>";
                    echo "<td class='group_info_2'>".$row['PESEL']."</td>";
                    echo "<td class='group_info'>".$row['parent_first_name']."<br>".$row['parent_last_name']."</td>";
                    echo "<td class='group_info_2'>Phone number: ".$row['phone_number']."<br>".$row['city']."<br>".$row['street']."<br>".$row['zip_code'];
                    if ($access_level == 2) {
                        echo "<td class='group_info'><form method='POST'><input name='child_remove_id' type='hidden' value='".$row['child_id']."'>
                        <input class='submit_button' type='submit' name='remove_child' value='Remove child'></form></td>";
                    }
                }
                else {
                    echo "<td class='group_info'>".$row['child_first_name']."<br>".$row['child_last_name']."</td>";
                    echo "<td class='group_info_2'>";
                    if ($row['child_gender'] == "f") echo "fe";
                    echo "male</td>";
                    echo "<td class='group_info'>".$row['PESEL']."</td>";
                    echo "<td class='group_info_2'>".$row['parent_first_name']."<br>".$row['parent_last_name']."</td>";;
                    echo "<td class='group_info'>Phone number: ".$row['phone_number']."<br>".$row['city']."<br>".$row['street']."<br>".$row['zip_code'];
                    if ($access_level == 2) {
                        echo "<td class='group_info_2'><form method='POST'><input name='child_remove_id' type='hidden' value='".$row['child_id']."'>
                        <input class='submit_button' type='submit' name='remove_child' value='Remove child'></form></td>";
                    }
                }
                echo "</tr>";
                $light = !$light;
            }
            if (isset($_POST['remove_child'])) {
                $_query1 = 'DELETE FROM children WHERE `children`.`id` = '.$_POST['child_remove_id'].';';
                $query = mysqli_query($conn, $_query1);
                $_SESSION['assigned_child'] = TRUE;
                echo "<script>window.location.reload()</script>";
            }
            echo "</table>";
        }
        echo "</p>";
        
        $_query1 = "SELECT COUNT(*) as n FROM `children` WHERE Groups_id = 1 AND gender = 'f';";
        $query = mysqli_query($conn, $_query1);
        echo "<h4 id='group2'>There are ".mysqli_fetch_array($query)['n']." girls in this group.</h4>";

        $_query1 = "SELECT COUNT(*) as n FROM `children` WHERE Groups_id = 1 AND gender = 'm';";
        $query = mysqli_query($conn, $_query1);
        echo "<h4 id='group2'>There are ".mysqli_fetch_array($query)['n']." boys in this group.<br><br></h4>";




        echo "<br><h2 id='group2'>Daisies</h2>";
        echo "<p class='group_info'>";
        if ($group_info_available == 2 or $access_level == 2) {
            $_query1 = 'SELECT first_name, last_name FROM teachers WHERE Groups_id = 2;';
            $query = mysqli_query($conn, $_query1);
            $row = mysqli_fetch_array($query);
            echo "<h3 class='teacher_name'>Teacher: ".$row['first_name']." ".$row['last_name']."</h3><br>";

            echo "<table class='group_info'>";
            $_query1 = 'SELECT children.id as "child_id", children.first_name as "child_first_name", 
            children.last_name as "child_last_name", PESEL, children.gender as "child_gender", 
            parents.first_name as "parent_first_name", parents.last_name as "parent_last_name", 
            city, street, zip_code, phone_number FROM children JOIN parents ON Parents_id = parents.id WHERE Groups_id = 2;';
            $query = mysqli_query($conn, $_query1);
            echo 
            "<tr class='group_info'>
                <td class='group_info_2'>Child's name</td>
                <td class='group_info'>Child's gender</td>
                <td class='group_info_2'>Child's PESEL</td>
                <td class='group_info'>Parent's name</td>
                <td class='group_info_2'>Parent's contact info</td>";
            if ($access_level == 2) {
                echo "<td class='group_info'>Remove from group</td>";
            }
            echo "</tr>";
            $light = FALSE;
            while ($row = mysqli_fetch_array($query)) {
                echo "<tr class='group_info_2'>";
                if ($light) {
                    echo "<td class='group_info_2'>".$row['child_first_name']."<br>".$row['child_last_name']."</td>";
                    echo "<td class='group_info'>";
                    if ($row['child_gender'] == "f") echo "fe";
                    echo "male</td>";
                    echo "<td class='group_info_2'>".$row['PESEL']."</td>";
                    echo "<td class='group_info'>".$row['parent_first_name']."<br>".$row['parent_last_name']."</td>";
                    echo "<td class='group_info_2'>Phone number: ".$row['phone_number']."<br>".$row['city']."<br>".$row['street']."<br>".$row['zip_code'];
                    if ($access_level == 2) {
                        echo "<td class='group_info'><form method='POST'><input name='child_remove_id' type='hidden' value='".$row['child_id']."'>
                        <input class='submit_button' type='submit' name='remove_child' value='Remove child'></form></td>";
                    }
                }
                else {
                    echo "<td class='group_info'>".$row['child_first_name']."<br>".$row['child_last_name']."</td>";
                    echo "<td class='group_info_2'>";
                    if ($row['child_gender'] == "f") echo "fe";
                    echo "male</td>";
                    echo "<td class='group_info'>".$row['PESEL']."</td>";
                    echo "<td class='group_info_2'>".$row['parent_first_name']."<br>".$row['parent_last_name']."</td>";;
                    echo "<td class='group_info'>Phone number: ".$row['phone_number']."<br>".$row['city']."<br>".$row['street']."<br>".$row['zip_code'];
                    if ($access_level == 2) {
                        echo "<td class='group_info_2'><form method='POST'><input name='child_remove_id' type='hidden' value='".$row['child_id']."'>
                        <input class='submit_button' type='submit' name='remove_child' value='Remove child'></form></td>";
                    }
                }
                echo "</tr>";
                $light = !$light;
            }
            if (isset($_POST['remove_child'])) {
                $_query1 = 'DELETE FROM children WHERE `children`.`id` = '.$_POST['child_remove_id'].';';
                $query = mysqli_query($conn, $_query1);
                $_SESSION['assigned_child'] = TRUE;
                echo "<script>window.location.reload()</script>";
            }
            echo "</table>";
        }
        echo "</p>";
        $_query1 = "SELECT COUNT(*) as n FROM `children` WHERE Groups_id = 2 AND gender = 'f';";
        $query = mysqli_query($conn, $_query1);
        echo "<h4 id='group2'>There are ".mysqli_fetch_array($query)['n']." girls in this group.</h4>";

        $_query1 = "SELECT COUNT(*) as n FROM `children` WHERE Groups_id = 2 AND gender = 'm';";
        $query = mysqli_query($conn, $_query1);
        echo "<h4 id='group2'>There are ".mysqli_fetch_array($query)['n']." boys in this group.<br><br></h4>";




        echo "<br><h2 id='group2'>Strawberries</h2>";
        echo "<p class='group_info'>";
        if ($group_info_available == 3 or $access_level == 2) {
            $_query1 = 'SELECT first_name, last_name FROM teachers WHERE Groups_id = 3;';
            $query = mysqli_query($conn, $_query1);
            $row = mysqli_fetch_array($query);
            echo "<h3 class='teacher_name'>Teacher: ".$row['first_name']." ".$row['last_name']."</h3><br>";

            echo "<table class='group_info'>";
            $_query1 = 'SELECT children.id as "child_id", children.first_name as "child_first_name", 
            children.last_name as "child_last_name", PESEL, children.gender as "child_gender", 
            parents.first_name as "parent_first_name", parents.last_name as "parent_last_name", 
            city, street, zip_code, phone_number FROM children JOIN parents ON Parents_id = parents.id WHERE Groups_id = 3;';
            $query = mysqli_query($conn, $_query1);
            echo 
            "<tr class='group_info'>
                <td class='group_info_2'>Child's name</td>
                <td class='group_info'>Child's gender</td>
                <td class='group_info_2'>Child's PESEL</td>
                <td class='group_info'>Parent's name</td>
                <td class='group_info_2'>Parent's contact info</td>";
            if ($access_level == 2) {
                echo "<td class='group_info'>Remove from group</td>";
            }
            echo "</tr>";
            $light = FALSE;
            while ($row = mysqli_fetch_array($query)) {
                echo "<tr class='group_info_2'>";
                if ($light) {
                    echo "<td class='group_info_2'>".$row['child_first_name']."<br>".$row['child_last_name']."</td>";
                    echo "<td class='group_info'>";
                    if ($row['child_gender'] == "f") echo "fe";
                    echo "male</td>";
                    echo "<td class='group_info_2'>".$row['PESEL']."</td>";
                    echo "<td class='group_info'>".$row['parent_first_name']."<br>".$row['parent_last_name']."</td>";
                    echo "<td class='group_info_2'>Phone number: ".$row['phone_number']."<br>".$row['city']."<br>".$row['street']."<br>".$row['zip_code'];
                    if ($access_level == 2) {
                        echo "<td class='group_info'><form method='POST'><input name='child_remove_id' type='hidden' value='".$row['child_id']."'>
                        <input class='submit_button' type='submit' name='remove_child' value='Remove child'></form></td>";
                    }
                }
                else {
                    echo "<td class='group_info'>".$row['child_first_name']."<br>".$row['child_last_name']."</td>";
                    echo "<td class='group_info_2'>";
                    if ($row['child_gender'] == "f") echo "fe";
                    echo "male</td>";
                    echo "<td class='group_info'>".$row['PESEL']."</td>";
                    echo "<td class='group_info_2'>".$row['parent_first_name']."<br>".$row['parent_last_name']."</td>";;
                    echo "<td class='group_info'>Phone number: ".$row['phone_number']."<br>".$row['city']."<br>".$row['street']."<br>".$row['zip_code'];
                    if ($access_level == 2) {
                        echo "<td class='group_info_2'><form method='POST'><input name='child_remove_id' type='hidden' value='".$row['child_id']."'>
                        <input class='submit_button' type='submit' name='remove_child' value='Remove child'></form></td>";
                    }
                }
                echo "</tr>";
                $light = !$light;
            }
            echo "</table>";
        }
        echo "</p>";
        
        $_query1 = "SELECT COUNT(*) as n FROM `children` WHERE Groups_id = 3 AND gender = 'f';";
        $query = mysqli_query($conn, $_query1);
        echo "<h4 id='group2'>There are ".mysqli_fetch_array($query)['n']." girls in this group.</h4>";

        $_query1 = "SELECT COUNT(*) as n FROM `children` WHERE Groups_id = 3 AND gender = 'm';";
        $query = mysqli_query($conn, $_query1);
        echo "<h4 id='group2'>There are ".mysqli_fetch_array($query)['n']." boys in this group.<br><br></h4>";

        if ($access_level == 2) {
            $_query1 = 'SELECT id, first_name, last_name FROM parents';
            $query = mysqli_query($conn, $_query1);

            echo "<hr><form method='POST'>
            <p class='group_info'><h2 id='group2'>Child assignment</h2>
            <table class='group_info_3'><tr class='group_info'>";
            echo "<td class='group_info'>Child's first name:<br><input type='text' name='child_first_name'></td>";
            echo "<td class='group_info_2'>Child's last name:<br><input type='text' name='child_last_name'></td>";
            echo "<td class='group_info'>Child's gender:<br>
            <label><input type='radio' name='child_gender' value='m'>male</label><br>
            <label><input type='radio' name='child_gender' value='f'>female</label></td>";
            echo "<td class='group_info_2'>Child's PESEL:<br><input type='text' name='PESEL'></td>";
            echo "<td class='group_info'>Group:<br>
            <select name='child_group'>
                <option value='1'>Ladybugs</option>
                <option value='2'>Daisies</option>
                <option value='3'>Strawberries</option>
            </select>
            </td>";
            echo "<td class='group_info_2'>Parent:<br><select name='child_parent_id'>";
            while ($row = mysqli_fetch_array($query)) {
                echo "<option value='".$row['id']."'>".$row['first_name']." ".$row['last_name']."</option>";
            }
            echo "</select></tr></table><button type='submit'>Assign</button></form>";

            if (!empty($_POST['child_first_name']) and !empty($_POST['child_last_name']) 
            and !empty($_POST['PESEL']) and !empty($_POST['child_group']) and !empty($_POST['child_parent_id']) 
            and !empty($_POST['child_gender'])) {
                if (mb_strlen($_POST['PESEL']) != 11 or is_numeric($_POST['PESEL'])) {
                    echo "<script>alert('Invalid PESEL.')</script>";
                }
                else {
                    $_query1 = "INSERT INTO `children` (`id`, `Groups_id`, `Parents_id`, `first_name`, `last_name`, `PESEL`, `gender`) 
                    VALUES (NULL, '".$_POST['child_group']."', '".$_POST['child_parent_id']."', '".$_POST['child_first_name']
                    ."', '".$_POST['child_last_name']."', '".$_POST['PESEL']."', '".$_POST['child_gender']."');";
                    $query = mysqli_query($conn, $_query1);
                    if (!$query) {
                        echo "We have encountered an issue.";
                    }
                    $_SESSION['assigned_child'] = TRUE;
                    echo "<script>window.location.reload()</script>";
                }
            }
        }

        if ($access_level == 2) {
            echo "<br><h2 id='group2'>Parents</h2>";
            echo "<p class='group_info'><table class='group_info_3'>";
            $_query1 = 'SELECT id, first_name, last_name, phone_number, gender, zip_code, city, street FROM parents;';
            $query = mysqli_query($conn, $_query1);
            echo 
            "<tr class='group_info'>
                <td class='group_info'>First name</td>
                <td class='group_info_2'>Last name</td>
                <td class='group_info'>Phone number</td>
                <td class='group_info_2'>Gender</td>
                <td class='group_info'>Zip<br>code</td>
                <td class='group_info_2'>City</td>
                <td class='group_info'>Street</td>
                <td class='group_info_2'>Remove parent</td>
            </tr>";
            $light = FALSE;
            while ($row = mysqli_fetch_array($query)) {
                echo "<tr class='group_info_2'>";
                if ($light) {
                    echo "<td class='group_info'>".$row['first_name']."</td>";
                    echo "<td class='group_info_2'>".$row['last_name']."</td>";
                    echo "<td class='group_info'>".$row['phone_number']."</td>";
                    echo "<td class='group_info_2'>";
                    if ($row['gender'] == "f") echo "fe";
                    echo "male</td>";
                    echo "<td class='group_info'>".$row['zip_code']."</td>";
                    echo "<td class='group_info_2'>".$row['city']."</td>";
                    echo "<td class='group_info'>".$row['street']."</td>";
                    echo "<td class='group_info_2'><form method='POST'>
                    <input name='parent_remove_id' type='hidden' value='".$row['id']."'>
                    <input class='submit_button' type='submit' name='remove_parent' value='Remove parent'></form>
                    </td>";
                }
                else {
                    echo "<td class='group_info_2'>".$row['first_name']."</td>";
                    echo "<td class='group_info'>".$row['last_name']."</td>";
                    echo "<td class='group_info_2'>".$row['phone_number']."</td>";
                    echo "<td class='group_info'>";
                    if ($row['gender'] == "f") echo "fe";
                    echo "male</td>";
                    echo "<td class='group_info_2'>".$row['zip_code']."</td>";
                    echo "<td class='group_info'>".$row['city']."</td>";
                    echo "<td class='group_info_2'>".$row['street']."</td>";
                    echo "<td class='group_info'><form method='POST'>
                    <input name='parent_remove_id' type='hidden' value='".$row['id']."'>
                    <input class='submit_button' type='submit' name='remove_parent' value='Remove parent'></form>
                    </td>";
                }
                echo "</tr>";
                $light = !$light;
            }
            if (isset($_POST['remove_parent'])) {
                $_query1 = 'DELETE FROM parents WHERE `parents`.`id` = '.$_POST['parent_remove_id'].';';
                $query = mysqli_query($conn, $_query1);
                $_SESSION['assigned_child'] = TRUE;
                echo "<script>window.location.reload()</script>";
            }
            echo "</table></p><br>";

            echo "<br><h2 id='group2'>Parent registration</h2>";
            echo "<p class='group_info'><form method='POST'><table class='group_info_3'>";
            echo 
            "<tr class='group_info'>
                <td class='group_info'>First name:<br><input class='thin_input' type='text' name='parent_first_name'></td>
                <td class='group_info_2'>Last name:<br><input class='thin_input' type='text' name='parent_last_name'></td>
                <td class='group_info'>Phone number:<br><input class='thin_input' type='text' name='phone_number'></td>
                <td class='group_info_2'>Parent's gender:<br>
                <label><input type='radio' name='parent_gender' value='m'>male</label><br>
                <label><input type='radio' name='parent_gender' value='f'>female</label></td>
                <td class='group_info'>Zip code:<br><input class='thin_input' type='text' name='zip_code'></td>
                <td class='group_info_2'>City:<br><input class='thin_input' type='text' name='city'></td>
                <td class='group_info'>Street:<br><input class='thin_input' type='text' name='street'></td>
            </tr></table></p></select></tr></table><input class='submit_button_2' name='register_parent' type='submit' value='Register'></form>";

            if (!empty($_POST['register_parent'])) {
                if (!empty($_POST['parent_first_name']) and !empty($_POST['parent_last_name']) 
                and !empty($_POST['phone_number']) and !empty($_POST['parent_gender']) and !empty($_POST['zip_code']) 
                and !empty($_POST['street']) and !empty($_POST['city'])) {
                    $_query1 = "INSERT INTO `parents` (`id`, `first_name`, `last_name`, `phone_number`, `gender`, `zip_code`, `city`, `street`) 
                    VALUES (NULL, '".$_POST['parent_first_name']."', '".$_POST['parent_last_name']."', '".$_POST['phone_number']."', '".$_POST['parent_gender']."', '".$_POST['zip_code']."', 
                    '".$_POST['city']."', '".$_POST['street']."');";
                    $query = mysqli_query($conn, $_query1);
                    if (!$query) {
                        echo "<script>alert('We have encountered an issue. Make sure to input all data thoroughly.')</script>";
                    }
                    $_SESSION['assigned_child'] = TRUE;
                    echo "<script>window.location.reload()</script>";
                }
            }
        }
        echo "<br>";
    }
?>
</div>

<div id="footer">

</div>

</div>
</body>
</html>