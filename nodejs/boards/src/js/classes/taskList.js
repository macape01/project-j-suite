export class taskList {
 

    constructor(){
        this.carregarLocalStorage();
    }

    newTask(task){
        this.tasks.push(task);
        this.desarLocalStorage();
    }

    desarLocalStorage() {
        localStorage.setItem('tasks',JSON.stringify(this.tasks));
    }
    carregarLocalStorage() {
        this.tasks = ( localStorage.getItem('tasks') )
                        ? JSON.parse( localStorage.getItem('tasks') )
                        : [];
    }
    getLastId() {
        let id = this.tasks.length > 0 ? this.tasks[this.tasks.length-1].id+1 : 0;
        return id;
        }
}
