import { generateHtml } from "./structboard";
import "../css/boards.css"
import { taskList } from "./classes/taskList";
import { Task } from "./classes/tasks";

export function Board(){

  
  let llista = new taskList();


  var html = document.createElement("div");
  html.id = "crear";
  html.innerHTML = generateHtml(llista.tasks);
  document.body.append(html);
    

  var checkBoxes = document.querySelectorAll("input[type=checkbox]");
  var editButtons = document.querySelectorAll("button.edit");
  var deleteButtons = document.querySelectorAll("button.delete");

  for (i of checkBoxes){
    i.onchange = taskCompleted;
  }

  for (i of editButtons){
    i.onclick = editTask;
  }

  for (i of deleteButtons){
    i.onclick = deleteTask;
  }
  

  // Problem: User interaction doesn't provide desired results.
  // Solution: Add interactivity so the user can manage daily tasks

  var taskInput = document.getElementById("new-task");
  var addButton = document.getElementsByTagName("button")[0];
  var incompleteTasksHolder = document.getElementById("incomplete-tasks");
  var completedTasksHolder = document.getElementById("completed-tasks");
  var areaImput = document.getElementById("area");

//New Task List Item
const createNewTaskElement = function(taskString, areaString, llista) {
  //Create List Item
  var listItem = document.createElement("li");

  var area = document.createElement("textarea");
  //input (checkbox)
  var checkBox = document.createElement("input"); // checkbox
  //label
  var label = document.createElement("label");
  //input (text)
  var editInput = document.createElement("input"); // text
  //button.edit
  var editButton = document.createElement("button");
 
  //button.delete
  var deleteButton = document.createElement("button");
  
      //Each element needs modifying
  
  checkBox.type = "checkbox";
  editInput.type = "text";

  editButton.innerText = "Edit";
  editButton.className = "edit";

  deleteButton.innerText = "Delete";
  deleteButton.className = "delete";
  
  label.innerText = taskString;
  area.innerText = areaString;
  console.log(label.value);
  let id=llista.getLastId();
  let task = new Task(id,1,taskString,area.value);
  llista.newTask(task);
  listItem.id=id
  // each element needs appending
  listItem.appendChild(checkBox);
  listItem.appendChild(label);
  listItem.appendChild(area);
  listItem.appendChild(editInput);
  listItem.appendChild(editButton);
  listItem.appendChild(deleteButton);

  return listItem;
}
var tasks = [];
var comm = [];
// Add a new task
var addTask = function() {
  console.log("Add task...");
  //Create a new list item with the text from #new-task:
  
  var listItem = createNewTaskElement(taskInput.value, areaImput.value,llista);

  // let value=taskInput.value;
  // let area=areaImput.value;

  // tasks.push(taskInput.value);
  // comm.push(areaImput.value);
  // localStorage.setItem('tasks', JSON.stringify(tasks));
  // localStorage.setItem('comm', JSON.stringify(comm));
  // localStorage.setItem("tasca", taskInput.value );
  // localStorage.setItem("coment", areaImput.value );
  
  //Append listItem to incompleteTasksHolder
  incompleteTasksHolder.appendChild(listItem);
  bindTaskEvents(listItem, taskCompleted);  
  
  taskInput.value = "";  
  areaImput.value = "";
}


// var findTask=function(valor){


//   console.log("find task...")
//   const listItem = document.getElementById(valor);
//   let encontradas = llista.tasks.filter(task=>task.id===(valor));
// 	for ( valor of valors ){
// 		if ( task.textContent === value ){
// 			return task;
// 		}
// 	}
// 	return null;
// }


// var searchTask=function(){
// 	if ( searchTaskInput.value.length == 0 ) return;
// 	searchValue = searchTaskInput.value

// 	taskFound = findTask(searchValue) 
// 	if ( taskFound ) {
// 		taskParent = taskFound.parentNode
// 		taskParent.style.backgroundColor = "#FFC300"
// 	}
// 	else{
// 		alert("No se ha encontrado la tarea....")
// 	}
// 	searchTaskInput.value = "";	
	
// }







// Edit an existing task
var editTask = function(id) {
  console.log("Edit Task...");

    
    console.log(this);
    var listItem = document.getElementById(id);


  var editInput = listItem.querySelector("input[type=text]")
  var areaImput = listItem.querySelector("textarea")

  var label = listItem.querySelector("label");

  let task = llista.tasks.find(task=>task.id === id*1);
  let index = llista.tasks.indexOf(task);
  llista.tasks[index].titol = editInput.value
  llista.tasks[index].comentari = areaImput.value
  llista.desarLocalStorage();


  var containsClass = listItem.classList.contains("editMode");
    //if the class of the parent is .editMode 
  if(containsClass) {
      //switch from .editMode 
      //Make label text become the input's value
    label.innerText = editInput.value;
    
    

  } else {
      //Switch to .editMode
      //input value becomes the label's text
    editInput.value = label.innerText;
    
    
  }
  
    // Toggle .editMode on the parent
  listItem.classList.toggle("editMode");
  
 
}


// Delete an existing task
var deleteTask = function(id) {
  console.log("Delete task...");
  const listItem = document.getElementById(id);
  var ul = listItem.parentNode;
  //Remove the parent list item from the ul
  ul.removeChild(listItem);

  let newLlista = llista.tasks.filter(task=>task.id!==(id*1));
  llista.tasks=newLlista;
  llista.desarLocalStorage();


}

// Mark a task as complete 
var taskCompleted = function(id) {
  
  console.log("Task complete...");
  //Append the task list item to the #completed-tasks
  const listItem = document.getElementById(id);
  completedTasksHolder.appendChild(listItem);
  bindTaskEvents(listItem, taskIncomplete);
  let task = llista.tasks.find(task=>task.id === id*1);
  let index = llista.tasks.indexOf(task);
  llista.tasks[index].todo = !llista.tasks[index].todo
  llista.desarLocalStorage();

}

// Mark a task as incomplete
var taskIncomplete = function(id) {
  console.log("Task Incomplete...");
  // When checkbox is unchecked
  // Append the task list item #incomplete-tasks
  const listItem = document.getElementById(id);
  incompleteTasksHolder.appendChild(listItem);
  bindTaskEvents(listItem, taskCompleted);
  let task = llista.tasks.find(task=>task.id === id*1);
  let index = llista.tasks.indexOf(task);
  llista.tasks[index].todo = !llista.tasks[index].todo
  llista.desarLocalStorage();
}

var bindTaskEvents = function(taskListItem, checkBoxEventHandler) {
  console.log("Bind list item events");
  //select taskListItem's children
  var checkBox = taskListItem.querySelector("input[type=checkbox]");
  var editButton = taskListItem.querySelector("button.edit");
  var deleteButton = taskListItem.querySelector("button.delete");
  
  //bind editTask to edit button
  editButton.addEventListener("click",e=>{

    let elementId = e.target.parentNode.id;
    editTask(elementId);
  });
  
  //bind deleteTask to delete button
    deleteButton.addEventListener("click",e=>{
    let elementId = e.target.parentNode.id;
    deleteTask(elementId);
  });
  
  //bind checkBoxEventHandler to checkbox
  checkBox.addEventListener("change",e=>{
    let elementId = e.target.parentNode.id;
    checkBoxEventHandler(elementId);
  });
}

var ajaxRequest = function() {
  console.log("AJAX Request");
}

// Set the click handler to the addTask function
//addButton.onclick = addTask;

	addButton.addEventListener("click", addTask);



// Cycle over the incompleteTaskHolder ul list items
for(var i = 0; i <  incompleteTasksHolder.children.length; i++) {
    // bind events to list item's children (taskCompleted)
  bindTaskEvents(incompleteTasksHolder.children[i], taskCompleted);
}
// Cycle over the completeTaskHolder ul list items
for(var i = 0; i <  completedTasksHolder.children.length; i++) {
    // bind events to list item's children (taskIncompleted)
  bindTaskEvents(completedTasksHolder.children[i], taskIncomplete); 

}







}
