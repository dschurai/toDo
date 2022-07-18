<?php
include 'config/db_connection.php';

$edit_message = "";
$priority_message = "";

//entry to site, display infos:
if(isset($_GET['id'])){
$id = mysqli_real_escape_string($db_connection, $_GET['id']);
$sql_query = "SELECT id, content, priority, timestamp FROM todos WHERE id = $id";
$db_data = mysqli_query($db_connection, $sql_query);
$todo = mysqli_fetch_assoc($db_data);
mysqli_free_result($db_data);

}

//deleting functionality:
if(isset($_POST['delete_id'])){
$delete_id = mysqli_real_escape_string($db_connection, $_POST['delete_id']);
$sql_query = "DELETE FROM todos WHERE id = $delete_id";
mysqli_query($db_connection, $sql_query);
header('Location: index.php'); //PROPOSAL: maybe add javascript to display "done" or st.
}

//editing content functionality:
if(isset($_POST['edit_content_id'])){
$id = mysqli_real_escape_string($db_connection, $_POST['edit_content_id']);

$old_todo = $todo['content'];

$edit_content = mysqli_real_escape_string($db_connection, $_POST['edit_content']);
$sql_query_edit = "UPDATE todos SET content = '$edit_content' WHERE id = $id";
mysqli_query($db_connection, $sql_query_edit);


$sql_query = "SELECT id, content, priority, timestamp FROM todos WHERE id = $id";
$db_data = mysqli_query($db_connection, $sql_query);
$todo = mysqli_fetch_assoc($db_data);
mysqli_free_result($db_data);

//show editing message if content has changed:
if(strcmp($_POST['edit_content'], $old_todo) !== 0){
$edit_message= '<p style="color: red">Content has been edited!</p>';
}

}

//priority change functionality:
if(isset($_POST['priority_id']) && isset($_POST['priority_change'])){
    //check input:
    $priority_change = $_POST['priority_change'];
    if($priority_change < 0){
        $priority_message = '<p style="color: red">Choose priority to change!</p>';
    }
    elseif($priority_change > 0){
        //changing priority
        $old_priority = $todo['priority'];

        $id = mysqli_real_escape_string($db_connection, $_POST['priority_id']);
        $priority_change_esc = mysqli_real_escape_string($db_connection, $_POST['priority_change']);
        $sql_query_change_priority = "UPDATE todos SET priority = $priority_change_esc WHERE id = $id";
        
        if(mysqli_query($db_connection, $sql_query_change_priority)){

            //show editing message if priority has changed:
            if($old_priority != $_POST['priority_change']){
                $priority_message = '<p>Priority changed.</p>';
            }
            
            //update data, so updated priority gets displayed:
            $sql_query = "SELECT id, content, priority, timestamp FROM todos WHERE id = $id";
            $db_data = mysqli_query($db_connection, $sql_query);
            $todo = mysqli_fetch_assoc($db_data);
            
            mysqli_free_result($db_data);
        }        
    }
}

//push to top functionality: (needs some thinking)
if(isset($_POST['push_top'])){
    $id = mysqli_real_escape_string($db_connection, $_POST['push_top']);
    $sql_push_top = "";
}


mysqli_close($db_connection);

//color functionality:
$color ="";

switch($todo['priority']){
    case 1 : 
        $color = '#ef9a9a'; 
        break;
    case 2: 
        $color = '#ffe57f'; 
        break;
    case 3: 
        $color = '#ccff90';
        break;
}

?>
<?php include 'templates/header.php';?>
<!DOCTYPE html>
<html>
    <section>
    <h4 id="heading" class="center grey-text text-darken-3">edit toDo:</h4>
    <div class="card" style="box-shadow: 3px 3px 10px <?=$color?>;">
        <div class="card-content">
    <form action="" method="post">
        <label for="edit_content">content:</label>
        <textarea name="edit_content" id="edit_content" cols="30" rows="10"><?=htmlspecialchars($todo['content'])?></textarea>
        <input type="hidden" name="edit_content_id" value="<?=$id?>">
        <button class="btn waves-effect waves-light grey darken-3 grey-text text-lighten-3" type="submit">Edit content</button>
    </form>
    <?=$edit_message?>
    <br>
    <label for="blockqutoe">current priority:</label>
    <blockquote name="blockquote" style="border-color: <?=$color?>" class="truncate grey-text text-darken-3 active-content"> <?php 
    //displays priority as text:
    switch($todo['priority']){
        case 1:
            echo "High";
            break;
        case 2:
            echo "Medium";
            break;
        case 3:
            echo "Low";
            break;
    }
    ?></blockquote>
    <br>
    <form action="" method="post">
        <label for="priotity_change">new priority:</label>
        <input type="hidden" name="priority_id" value="<?=$id?>">
        <select name="priority_change" id="priority_change">
            <option value="-1">Choose</option>
            <option value="1">High</option>
            <option value="2">Medium</option>
            <option value="3">Low</option>
        </select>
        <button class="btn waves-effect waves-light grey darken-3 grey-text text-lighten-3" type="submit">Change Priority</button>
    </form>
    <?=$priority_message?>
    <!--<p>created at: <?=$todo['timestamp']?></p> -->
    <br>
    
    <br>
    <div>
    <form style="display: inline" action="" method="post">
        <input type="hidden" name="push_top" value="<?=$id?>">
        <button class="btn disabled waves-effect waves-light grey darken-3 grey-text text-lighten-3" type="submit">push to top &nbsp &uarr;</button>
    </form>
    <form style="display: inline" action="" method="post">
        <input type="hidden" name ="delete_id" value="<?=$id?>">
        <button class="right btn waves-effect waves-light red  grey-text text-lighten-3" type="submit">DELETE</button>
    </form>
    </div>
    </div>
    </div>
    <a href="index.php">&larr; go back to ToDo list</a>
    </section>
</html>
<?php include 'templates/footer.php';?> 


