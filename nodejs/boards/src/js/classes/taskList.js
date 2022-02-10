export class taskList {
 

    constructor(data){
        this.tasks=data;
    }


    async newTask(task,id){




            try {
                this.tasks.push(task);
                const res= await fetch(`https://project-j-suite-default-rtdb.europe-west1.firebasedatabase.app/Boards/${id}.json`,
            
            {
            
                method: 'PUT',
                
                headers: {
                
                'Content-Type': 'aplication/json'
                
                },
            
                body: JSON.stringify(task)
            
            })
            
            }
            
            catch (error) {
                console.log("error, fallan cositas");
            }

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
