<?php 
    include_once 'header.php'; 
    require_once 'includes/config.php';  
?>


<div style="padding-top: 200px;">
    <h3>User Registration</h3>
    
    <?php   
    echo "<table>
    <tr>
        <th>first name</th>
        <th>last name</th>
        <th>email address</th>
        <th>Mobile Number</th>
        <th>status</th>
    </tr>";   
        
        $sql = "SELECT * FROM users WHERE status = 'pending';";        
        $result = $conn-> query($sql);
        
       

        if($result-> num_rows > 0) {           
            while($row = $result-> fetch_assoc()){
                echo "<tr><td>" . $row["first_name"] . "</td>
                <td>" . $row['last_name'] . "</td>
                <td>" . $row['email'] . "</td>
                <td>" . $row['cell_num'] . "</td>
                <td>" . $row['status'] . "</td>
                <td>
                <form action =\"admin.php\" method =\"POST\">
                    <input type = 'hidden' name ='id' value =" . $row['id'] . ">
                    <input style='color:green;' type = \"submit\" name  =\"approve\" value = \"Approve\"/>
                    <input style='color:red; padding-left: 5px;' type = \"submit\" name  =\"deny\" value = \"Deny\"/>
                </form>
            </td>
                </tr>";
            }            
        }
        else{
            echo "0 results"; 
       }
        echo "</table>";
    ?>   
   
    </div>

<?php

if(isset($_POST['approve'])){
    $id = $_POST['id'];
   
    $sql = "UPDATE users SET status = 'approved' WHERE id = '$id' ";
    $result = $conn-> query($sql);

    echo '<script type = "text/javascript">';
    echo 'alert("User Approved!");';
    echo 'window.location.href = "admin.php"';
    echo '</script>';
    
}

if(isset($_POST['deny'])){
    $id = $_POST['id'];

    $select = "DELETE FROM users WHERE id = '$id'";
    $result = mysqli_query($conn, $select);

    echo '<script type = "text/javascript">';
    echo 'alert("User Denied!");';
    echo 'window.location.href = "admin.php"';
    echo '</script>';
}
?>

<?php 
    include_once 'footer.php';
?>