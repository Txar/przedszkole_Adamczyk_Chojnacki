<!DOCTYPE html>
<html>
<head>
<title>Przedszkole</title>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="style.css">
    
</head>
<body>

<div id="container">
<div id="baner">
<h1>Kindergarten no. 11 in Kołobrzeg</h1>
    <div id="left_top">
        <img src="godlo.png" id="godlo">
        <a href="login.php" id="logowanie">Log in / Account info</a>
    </div>
    </h1>
</div>
<div id="menu">
<table id="tabela_menu">
<tr>
<td><a href="index.html">Home page</a></td>
<td><a href="">News</a></td>
<td><a href="hours.html">Opening time </a></td>
<td><a href="">Parent's zone</a></td>
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
    $group_info_available = NULL;
    $conn = mysqli_connect("127.0.0.1", "root", "", "przedszkole_Adamczyk_Chojnacki");
    if (!$conn) {
        echo "Couldn't connect to database.";
        echo "<br><h2 id='group2'>Ladybugs</h2>";
        echo "<br><h2 id='group2'>Daisies</h2>";
        echo "<br><h2 id='group2'>Strawberries</h2>";
    }
    else {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        $group_info_available = null;
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
        echo "<br><h2 id='group2'>Ladybugs</h2>";
        echo "<p class='group_info'><table class='group_info'>";
        if ($group_info_available == "Ladybugs" or $access_level == 2) {
            $_query1 = 'SELECT children.first_name as "child_first_name", children.last_name as "child_last_name", PESEL, children.gender as "child_gender", 
            parents.first_name as "parent_first_name", parents.last_name as "parent_last_name", 
            city, street, zip_code FROM children JOIN parents ON Parents_id = parents.id WHERE Groups_id = 1;';
            $query = mysqli_query($conn, $_query1);
            echo 
            "<tr class='group_info'>
                <td class='group_info'>Child's name</td>
                <td class='group_info_2'>Child's gender</td>
                <td class='group_info'>Child's birth year</td>
                <td class='group_info_2'>Child's pesel</td>
                <td class='group_info'>Parent's name</td>
            </tr>";
            $light = FALSE;
            while ($row = mysqli_fetch_array($query)) {
                echo "<tr class='group_info_2'>";
                if ($light) {
                    echo "<td class='group_info'>".$row['child_first_name']." ".$row['child_last_name']."</td>";
                    echo "<td class='group_info_2'>";
                    if ($row['child_gender'] == "f") echo "fe";
                    echo "male</td>";
                    echo "<td class='group_info'>20".mb_substr($row['PESEL'], 0, 2)."</td>";
                    echo "<td class='group_info_2'>".$row['PESEL']."</td>";
                    echo "<td class='group_info'>".$row['parent_first_name']." ".$row['parent_last_name']."</td>";
                }
                else {
                    echo "<td class='group_info_2'>".$row['child_first_name']." ".$row['child_last_name']."</td>";
                    echo "<td class='group_info'>";
                    if ($row['child_gender'] == "f") echo "fe";
                    echo "male</td>";
                    echo "<td class='group_info_2'>20".mb_substr($row['PESEL'], 0, 2)."</td>";
                    echo "<td class='group_info'>".$row['PESEL']."</td>";
                    echo "<td class='group_info_2'>".$row['parent_first_name']." ".$row['parent_last_name']."</td>";

                }
                echo "</tr>";
                $light = !$light;
            }
        }
        echo "</table></p>";

        echo "<br><h2 id='group2'>Daisies</h2>";
        echo "<p class='group_info'><table class='group_info'>";
        if ($group_info_available == "Daisies" or $access_level == 2) {
            $_query1 = 'SELECT children.first_name as "child_first_name", children.last_name as "child_last_name", PESEL, children.gender as "child_gender", 
            parents.first_name as "parent_first_name", parents.last_name as "parent_last_name", 
            city, street, zip_code FROM children JOIN parents ON Parents_id = parents.id WHERE Groups_id = 2;';
            $query = mysqli_query($conn, $_query1);
            echo 
            "<tr class='group_info'>
                <td class='group_info'>Child's name</td>
                <td class='group_info_2'>Child's gender</td>
                <td class='group_info'>Child's birth year</td>
                <td class='group_info_2'>Child's pesel</td>
                <td class='group_info'>Parent's name</td>
            </tr>";
            $light = FALSE;
            while ($row = mysqli_fetch_array($query)) {
                echo "<tr class='group_info_2'>";
                if ($light) {
                    echo "<td class='group_info'>".$row['child_first_name']." ".$row['child_last_name']."</td>";
                    echo "<td class='group_info_2'>";
                    if ($row['child_gender'] == "f") echo "fe";
                    echo "male</td>";
                    echo "<td class='group_info'>20".mb_substr($row['PESEL'], 0, 2)."</td>";
                    echo "<td class='group_info_2'>".$row['PESEL']."</td>";
                    echo "<td class='group_info'>".$row['parent_first_name']." ".$row['parent_last_name']."</td>";
                }
                else {
                    echo "<td class='group_info_2'>".$row['child_first_name']." ".$row['child_last_name']."</td>";
                    echo "<td class='group_info'>";
                    if ($row['child_gender'] == "f") echo "fe";
                    echo "male</td>";
                    echo "<td class='group_info_2'>20".mb_substr($row['PESEL'], 0, 2)."</td>";
                    echo "<td class='group_info'>".$row['PESEL']."</td>";
                    echo "<td class='group_info_2'>".$row['parent_first_name']." ".$row['parent_last_name']."</td>";

                }
                echo "</tr>";
                $light = !$light;
            }
        }
        echo "</table></p>";

        echo "<br><h2 id='group2'>Strawberries</h2>";
        echo "<p class='group_info'><table class='group_info'>";
        if ($group_info_available == "Daisies" or $access_level == 2) {
            $_query1 = 'SELECT children.first_name as "child_first_name", children.last_name as "child_last_name", PESEL, children.gender as "child_gender", 
            parents.first_name as "parent_first_name", parents.last_name as "parent_last_name", 
            city, street, zip_code FROM children JOIN parents ON Parents_id = parents.id WHERE Groups_id = 3;';
            $query = mysqli_query($conn, $_query1);
            echo 
            "<tr class='group_info'>
                <td class='group_info'>Child's name</td>
                <td class='group_info_2'>Child's gender</td>
                <td class='group_info'>Child's birth year</td>
                <td class='group_info_2'>Child's pesel</td>
                <td class='group_info'>Parent's name</td>
            </tr>";
            $light = FALSE;
            while ($row = mysqli_fetch_array($query)) {
                echo "<tr class='group_info_2'>";
                if ($light) {
                    echo "<td class='group_info'>".$row['child_first_name']." ".$row['child_last_name']."</td>";
                    echo "<td class='group_info_2'>";
                    if ($row['child_gender'] == "f") echo "fe";
                    echo "male</td>";
                    echo "<td class='group_info'>20".mb_substr($row['PESEL'], 0, 2)."</td>";
                    echo "<td class='group_info_2'>".$row['PESEL']."</td>";
                    echo "<td class='group_info'>".$row['parent_first_name']." ".$row['parent_last_name']."</td>";
                }
                else {
                    echo "<td class='group_info_2'>".$row['child_first_name']." ".$row['child_last_name']."</td>";
                    echo "<td class='group_info'>";
                    if ($row['child_gender'] == "f") echo "fe";
                    echo "male</td>";
                    echo "<td class='group_info_2'>20".mb_substr($row['PESEL'], 0, 2)."</td>";
                    echo "<td class='group_info'>".$row['PESEL']."</td>";
                    echo "<td class='group_info_2'>".$row['parent_first_name']." ".$row['parent_last_name']."</td>";

                }
                echo "</tr>";
                $light = !$light;
            }
        }
        echo "</table></p><br><hr>";

        if ($access_level == 2) {
            echo "<form method='POST'>
            <p class='group_info'><h2 id='group2'>Child assignment</h2>
            <table class='group_info'><tr class='group_info'>
            <td class='group_info'>Child's name:<br></td>
            <td class='group_info_2'>Child's gender:<br></td>
            <td class='group_info'>Child's pesel:<br></td>
            <td class='group_info_2'>Parent:<br></td>
            </tr></table>
            </form>";
        }

        echo "<br><h2 id='group2'>Parents</h2>";
        echo "<p class='group_info'><table class='group_info_2'>";
        if ($access_level == 2) {
            $_query1 = 'SELECT first_name, last_name, phone_number, gender, zip_code, city, street FROM parents;';
            $query = mysqli_query($conn, $_query1);
            echo 
            "<tr class='group_info'>
                <td class='group_info'>First name</td>
                <td class='group_info_2'>Last name</td>
                <td class='group_info'>Phone number</td>
                <td class='group_info_2'>Gender</td>
                <td class='group_info'>Zip code</td>
                <td class='group_info_2'>City</td>
                <td class='group_info'>Street</td>

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
                }
                echo "</tr>";
                $light = !$light;

            }
        }
        echo "</table></p><br><hr>";
    }
?>
</div>

<div id="footer">

</div>


















</div>
</body>
</html>