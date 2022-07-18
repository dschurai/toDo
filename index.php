<?php
//sets up connection with DB:
include 'config/db_connection.php';

//marks TODO as completed in DB, updates the timestamp and refreshs site:
if(isset($_POST['id_completed'])){
    $completed_id = mysqli_real_escape_string($db_connection, $_POST['id_completed']);
    $sql_query= "UPDATE todos SET completed = 1, timestamp = CURRENT_TIMESTAMP WHERE id =$completed_id";

    if(mysqli_query($db_connection, $sql_query)){
        header('Location: index.php');
    }
}

//gets data for TODOS, sorted by 1.priority and 2.timestamp
$db_data_todo = mysqli_query($db_connection, "SELECT content, priority, id, completed, timestamp FROM todos WHERE completed = 0 ORDER BY priority ASC, timestamp");
$todos = mysqli_fetch_all($db_data_todo, MYSQLI_ASSOC);

//gets data for completed TODOS, sorted by (new)timestamp
$db_data_completed = mysqli_query($db_connection, "SELECT content, priority, id, completed, timestamp FROM todos WHERE completed = 1 ORDER BY timestamp DESC LIMIT 10");
$completed_todos = mysqli_fetch_all($db_data_completed, MYSQLI_ASSOC);

//freeing resources, closing connection
mysqli_free_result($db_data_completed);
mysqli_free_result($db_data_todo);
mysqli_close($db_connection);
?>
<!DOCTYPE html>
<html>
<?php include 'templates/header.php'; ?>

<div class="section">
<h4 id="heading" class="center grey-text text-darken-3" ><?= count($todos)?> active tasks:</h4>
<!--<div class="row"> -->
<?php 

//displays TODOS, colored by priority, able to mark as "completed" (hidden form with id to submit id)
foreach($todos as $index => $content_array):
    $content = $content_array['content'];
    $priority = $content_array['priority'];
    $id = $content_array['id'];
    switch($priority){
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
    
    
<a href="edit.php?id=<?=$id?>" title="Edit toDo">
    <div class="card" style="box-shadow: 3px 3px 10px <?=$color?>;">
        <div style="justify-content: space-between;" class="card-content valign-wrapper"> <!-- valign-wrapper for text -->
            <blockquote style="border-color: <?=$color?>" class="truncate grey-text text-darken-3 active-content"><?=nl2br(htmlspecialchars($content))?></blockquote>
            <form method="post"><input type="hidden" name="id_completed" value="<?=$id?>">
                <button title="Mark completed" style="display: inline;" class="btn-floating btn-large green darken-1 waves-effect waves-light"><i class="material-icons grey-text text-lighten-3">check</i>   
                </button>
            </form>
        </div>
    </div></a>                       
<?php endforeach; ?>
</div>

<div class="section">
<h4 id="heading" class="center grey-text text-darken-1" >completed tasks:</h4>


<?php 

//displays completed TODOS
foreach($completed_todos as $index => $completed_content_array): 
    $completed_content = $completed_content_array['content'];
    $completed_id = $completed_content_array['id'];

?>

<div class="row">
    <div class="col s12">
      <div class="card-panel">
        <span class="grey-text"><?=mb_strimwidth(htmlspecialchars($completed_content), 0 , 70, "...")?>
        </span>
        <a title="edit" href="editcompleted.php?id=<?=$completed_id?>"><i class="right material-icons grey-text text-darken-1">edit</i></a>
      </div>
    </div>
  </div>
            

<?php endforeach; ?>
</div>



<?php include "templates/footer.php" ; ?>
</html>