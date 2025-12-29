<?php
include "db/conn.php";
    $id = $_GET['id'];
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
    $sql = mysqli_query($conn, "DELETE FROM clientlist Where cid = '$id'");
    if($sql){
        echo "<script>alert('Delete Successfully')</script>";
        echo "<script>window.location.href='client_list.php';</script>";
    }
}elseif(isset($_POST['NO'])){
   echo "<script>window.location.href='client_list.php';</script>";
}
?>