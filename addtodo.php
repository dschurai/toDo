<?php
include 'config/db_connection.php';
$todo_input = "";
$errors = ['todo' => '', 'priority' => ''];

//input handling and error displaying
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(empty($_POST['todo'])){
        $errors['todo'] = "Enter toDo! ";
    }
    else{
        $todo_input = htmlspecialchars($_POST['todo']);
    }
    if($_POST['priority'] < 0){
        $errors['priority']= "Choose Priority! ";
    }


    if(!array_filter($errors)){ //if there are no errors ...

        /*!!!CAUTION: unsafe SQL. just for practise purposes. 
        In real Apps, always use PDO, prepared statements and whitelist.*/

        $todo = mysqli_real_escape_string($db_connection, $_POST["todo"]);
        $priority = mysqli_real_escape_string($db_connection, $_POST["priority"]); //probably not necessary ?
        $sql_query = "INSERT INTO todos(content, priority) VALUES('$todo', '$priority')";
        
        if(mysqli_query($db_connection, $sql_query)){
        header('Location: index.php');}
        else{ echo mysqli_error($db_connection);}
        
    }
}



?>
<!DOCTYPE html>
<html>
<?php include 'templates/header.php'; ?>

<section>
<h4 id="heading" class="center grey-text text-darken-3">add toDo:</h4>
    <div class="card">
        <div class="card-content">
    
    <form  action="addtodo.php" method="post" >
    <label  for="todo" >&nbsp &nbsp toDo:</label>
        <br>
        <textarea name="todo" id="todo" cols="30" rows="3"><?= $todo_input?></textarea>
        <br>
        <br>
        <p style="color: red"><?= $errors['todo'] ?></p>
        <br>
        <div class="input-field">
        <select  name="priority">
            <option class="grey-text" value="-1">Choose</option>
            <option value="1">High</option>
            <option value="2">Medium</option>
            <option value="3">Low</option>
        </select>
        <label for="priority">Priority:</label>
        </div>
        <br>
        <p style="color: red"><?= $errors['priority'] ?></p>
        <br>
        <!-- didn't manage to change the color in the dropdown (probably JS skills needed)-->

        <button class="btn waves-effect waves-light grey darken-3 grey-text text-lighten-3" type="submit">ADD TODO</button>
        
    </form>
    </div>
    </div>
    <a href="index.php">&larr; go back to ToDo list</a>
</section>




        
<?php include 'templates/footer.php' ; ?>
</html>