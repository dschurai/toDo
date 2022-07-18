# GENERAL

This projects' purpose is to practise building a simple web application. 
Since this is my first complete web project, I knowingly use imperfect techniques in some cases to not get lost while learning single specific concepts.
However, I intend to improve the project step by step and get rid of all the flaws I made so far.

The project itself wasn't planned at all, so I just add idea by idea. 
Everything I used is self-taught.

# USAGE

I tried to create an intuitive frontend which shouldn't need much explanations.

Main Page (index.php): 
All the added todos are displayed. 
The coloring of the todos is based on their priority: red for high priority, orange for medium priority and green for low priority.
In the "active tasks" section todos are sorted first by priority and second by date, so the top todo is always the oldest with the "high" priority.
Every active todo can be marked as "done" by clicking on the green checkmark button. This will move the active todo to the "completed tasks" section.
Every active todo can be edited by clicking on the grey pen button, which will redirect to  edit.php .

In the "completed tasks" section the last 20 completed todos are displayed and sorted by completion date, so the most recently completed todo is always on top.
Every completed todo can be edited by clicking on the grey pen button, which will redirect to editcompleted.php .  

Navbar:
When clicking on the "todo"- logo in the middle of the navbar, the view will scroll to the top of the page.
When clicking on the house-button, you will always be redirected to the main page.
When clicking on the plus-button, you will be redirected to addtodo.php .

Add to do (addtodo.php):
Adding a new todo.
You need to enter a description text as well as a priority for the new task.
Only when both is entered, a new todo will be created when clicking on the "add todo"-button.

Edit to do (edit.php):
Editing an active todo.
The description and the priority of the todo can be changed here.
If one of both is changed, it will be saved.
"push to top" is not active yet. In the future, this button will enable the user to push the chosen todo to the top of the todo list.

Edit completed: (editcompleted.php):
Editing a completed todo.
The completed todo can be reactivated (moved to the "active tasks" section) an deleted by clicking the corresponding button.



# LEARNING TARGET

In the beginning, the only target was to get in touch with PHP. 
The project grew and so did the learning target.

Since the project and the aims always change and new features are added to the project, I guess I am also learning to use some kind of unstructured agile development.

I learned using my first frontend framework Materialize, started to learn MySQL and Git as well as GitHub.

Besides adding some more functionality and complexicity, I intend to make the project safer and add some more UX components. 

For the security purposes I will need to learn using PHP PDO and the use of prepared SQL statements in combination with whitelists.
For the UX components I will need to learn some basic JavaScript/TypeScript.
For trying new features and alternative functionalities I will need to learn the proper use of Git Branches.


# USED TECHNOLOGIES

I run this application on localhost and a local MySQL DB via XAMPP.
For the frontend I use HTML, some basic CSS and mainly the materializecss framework.
For the backend I use PHP 8.1.4 and MySQL.

# PROBLEMS/TRADEOFFS

I created the site just for my personal use running locally with XAMPP. Maybe I will add functionality for multiple users later on. If I would ever plan to host this on a remote server, I'd need to change a lot of things regarding the access of the database (e.g. root pw) and strongly improve security aspects.

I am aware of some security issues of this application which I intend to improve in the future. 
One main point here is the use of mysqli with plain SQL statements. A safer approach with prepared Statements and PDO would be better.

I used get method for the "edit" functionality, even though I'd prefer to use a different method (post or session).
I will readdress this issue when I am adding the login functionality because then I will have to use sessions or something similiar anyways.

Most of the project's time I spent struggling with the materialize framework. It forced me to do some tradeoffs regarding the frontend design which I planned to be different in a few points:
I couldn't make it work to have the "card-action" section of the cards on the right side instead of having them on the bottom.
In "addtodo.php" and "edit.php" I didn't use the materialize textarea because I don't know how to transfer the data via post method with it.
In "addtodo.php" and "edit.php"I couldn't make it work to change the colors in the dropdown menu for the priority. It seems there is some JS knowledge needed for this.

I used get method for the "edit" functionality, even though I'd prefer to use a different method (post or session). I couldn't make the design work without it, because I couldn't realize it with e.g. a hidden form.

Responsiveness:
This app is mainly for desktop use, so I didn't make it responsive for mobile use and I don't intend to.

# FUTURE FEATURES

- PHP: replace mysqli usage with PDO, prepared statements and whitelist
- JS: add some JavaScript (e.g. asking for confirmation when deleting a toDo etc.)
- JS: change some materialize classes (e.g. color for the dropdowns)
- PHP: use different method for passing data to edit.php, maybe use session/server (probably design tradeoff with materialize)
- PHP: add a login functionality
- PHP/SQL: make multiple users possible
- PHP/SQL: make multiple toDo-lists/categories per user possible
- PHP/SQL: add "push to top" functionality (change order of todos' sorting)
- PHP/SQL: find a better way to sort toDos when updated/be pushed to top




