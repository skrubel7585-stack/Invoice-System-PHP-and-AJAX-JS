<?php
session_start();
include "db/conn.php";
$username = $_SESSION['username'];
$pass = $_SESSION['pass'];
$adminsql = mysqli_query($conn, "select * from user where email = '$username' and pass = '$pass'");
$adminfetch = mysqli_fetch_array($adminsql);
if($username == true & $pass == true){
    
    if(isset($_GET['id'])) {
        $tc_id = $_GET['id'];
        ?>
        <style>
    .middle {
  display: flex;
  width: 100%;
  heighT: 100vh;
  justify-content: center;
  align-self: center;
}

/* Just to Center */
.bypassChoice { display: flex; justify-content: center; align-items: center; }

.bypassChoice { /*display: inline-block;*/ position: relative; width: 0 auto; margin-left: 5%; text-align: center; }
.bypassChoice button { cursor: pointer; }
.bypassChoice button.bypass { margin-right: 10px; display: inline-block; background: green; color: #fff; box-sizing: border-box; padding: 8px 15px; border-radius: 5px; -webkit-border-radius: 5px; -moz-border-radius: 5px; }
.bypassChoice button.noBypass { margin-right: 10px; display: inline-block; background: red; color: #fff; box-sizing: border-box; padding: 8px 15px; border-radius: 5px; -webkit-border-radius: 5px; -moz-border-radius: 5px; }
.bypassChoice button.bypass, .bypassChoice button.noBypass { border: 0; outline: 0; transition: all 0.3s; -webkit-transition: all 0.3s; -moz-transition: all 0.3s; }
.bypassChoice button.bypass:hover, .bypassChoice button.noBypass:hover { 
    color: #fff !important; 
    box-shadow: 0 1px 1px rgba(0,0,0,0.11), 
              0 2px 2px rgba(0,0,0,0.11), 
              0 4px 4px rgba(0,0,0,0.11), 
              0 6px 8px rgba(0,0,0,0.11),
              0 8px 16px rgba(0,0,0,0.11);
    -webkit-box-shadow: 0 1px 1px rgba(0,0,0,0.11), 
              0 2px 2px rgba(0,0,0,0.11), 
              0 4px 4px rgba(0,0,0,0.11), 
              0 6px 8px rgba(0,0,0,0.11),
              0 8px 16px rgba(0,0,0,0.11);
    -moz-box-shadow: 0 1px 1px rgba(0,0,0,0.11), 
              0 2px 2px rgba(0,0,0,0.11), 
              0 4px 4px rgba(0,0,0,0.11), 
              0 6px 8px rgba(0,0,0,0.11),
              0 8px 16px rgba(0,0,0,0.11);
}
.bypassChoice button.bypass:active, .bypassChoice button.noBypass:active { 
    box-shadow: none; -webkit-box-shadow: none; -moz-box-shadow: none; 
}


</style>

<div class="middle">
    <div class="bypassChoice">
        <form method="POST">
            <button href="#" class="bypass" name="YES"><i class="fa fa-check" aria-hidden="true"></i> Yes</button>
        <button href="#" class="noBypass" name="NO"><i class="fa fa-check" aria-hidden="true"></i> No</button>
        </form>
    </div>
</div>
        
        <?php
        if(isset($_POST['YES'])){
        // First delete from terms table
        $delete_terms = mysqli_query($conn, "DELETE FROM terms WHERE tc_idd = '$tc_id'");
        
        // Then delete from main table
        $delete_main = mysqli_query($conn, "DELETE FROM termsandconditionlist WHERE tc_id = '$tc_id'");
        
        if($delete_main) {
            echo "<script>alert('Terms & Conditions Deleted Successfully'); window.location.href='terms-and-condition-list.php';</script>";
        } else {
            echo "<script>alert('Error Deleting Terms & Conditions'); window.location.href='terms-and-condition-list.php';</script>";
        }
        }elseif(isset($_POST['NO'])){
    echo "<script>window.location.href='index.php';</script>";
}
  
    }
    
} else {
    echo "<script>window.location.href='login/';</script>";
}
?>