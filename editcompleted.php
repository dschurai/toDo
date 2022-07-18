<?php
include 'config/db_connection.php';

//site entry
if(isset($_GET['id'])){
    $id = mysqli_real_escape_string($db_connection, $_GET['id']);
    $sql_query = "SELECT id, content, priority, timestamp FROM todos WHERE id = $id";
    $db_data = mysqli_query($db_connection, $sql_query);
    $todo = mysqli_fetch_assoc($db_data);
    mysqli_free_result($db_data);
    
    }

//deleting functionality:
if(isset($_POST['delete_id'])){
    $id = mysqli_real_escape_string($db_connection, $_POST['delete_id']);
    $sql_query = "DELETE FROM todos WHERE id = $id";
    mysqli_query($db_connection, $sql_query);
    header('Location: index.php'); //PROPOSAL: maybe add javascript to display "done" or st.
    }

//"undo" functionality
if(isset($_POST['undo'])){
    $id = mysqli_real_escape_string($db_connection, $_POST['undo']);
    $sql_query = "UPDATE todos SET completed = 0 WHERE id = $id";

    if(mysqli_query($db_connection, $sql_query)){
        header('Location: index.php');
    }
}

mysqli_close($db_connection);
?>
<!DOCTYPE html>
<html>
<?php include 'templates/header.php'?>


<section>
<div class="card">
    <div class="card-content">
    <p class="grey-text">Content:</p>
<p class="grey-text text-darken-3 active-content"><?=htmlspecialchars($todo['content'])?></p>
<br>
<p class="grey-text">Completed at: </p>
<p class="grey-text text-darken-3 active-content"><?=htmlspecialchars($todo['timestamp'])?></p>
<br>
<div>
<form style="display: inline" action="" method="post">
    <input type="hidden" name="undo" value="<?=$id?>">
    <button class="btn waves-effect waves-light grey darken-3 grey-text text-lighten-3" type="submit">reactivate</button>
</form>
<form style="display: inline" action="" method="post">
        <input type="hidden" name ="delete_id" value="<?=$id?>">
        <button class="right btn waves-effect waves-light red  grey-text text-lighten-3" type="submit">DELETE</button>
</form>
</div>
</div>
</div>
<br>
<a href="index.php">&larr; go back to ToDo list</a>
</section>
<?php include 'templates/footer.php' ?>
</html>
