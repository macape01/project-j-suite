

export function generateHtml(tasks){
  let todo='';
  let completed='';

  // Creem les opcions del select, a partir de les dades
  const todoTasks = tasks.filter(task => task.todo !== true);
  console.log("toodo",todoTasks)
  const completedTasks = tasks.filter(task=> task.todo === true);

  for (let task of todoTasks)  {
    todo += ` <li id="${task.id}"><input type="hidden" value="${task.author_id}"/><input type='checkbox'><label>${task.titol}</label><textarea>${task.comentari}</textarea><input type="text"><button class='edit'>Edit</button><button class='delete' id="delete-button">Delete</button></li>`
  }

  for (let task of completedTasks)  {
    completed += ` <li id="${task.id}"><input type="hidden" value="${task.author_id}"/><input type='checkbox' checked><label>${task.titol}</label><textarea>${task.comentari}</textarea><input type="text"><button class='edit'>Edit</button><button class='delete' id="delete-button">Delete</button></li>`
  }
  
	var html = `
  <body>
    <div class="container">

    <p>
    <label class="label-title" for="search-task">Buscar</label><input required id="search-task" type="text"><button id="buttonSearch">Buscar</button>
    </p>

      <p>
        <label for="new-task">Add Item</label><input id="new-task" type="text"><button>Add</button>
        <textarea id="area"></textarea>
      </p>
      
      <h3>Todo</h3>
      <ul id='incomplete-tasks'>
        ${todo}
      </ul>

      <h3>Completed</h3>
      <ul id="completed-tasks">
        ${completed}
      </ul>

    </div>

    <script type="text/javascript" src="app.js"></script>

  </body>

	`
    return html
}