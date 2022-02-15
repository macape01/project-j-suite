export class Task {
    constructor(id,id_autor,data,titol,comentari,todo)
     {
        this.id = id;
        this.id_autor = id_autor;
        this.data = data;
        this.titol = titol;
        this.comentari=comentari; 
        this.todo = todo;
     }
     generarData() {
        return new Date();
     }
 }     

