export class Task {
    constructor(id,id_autor,titol,comentari)
     {
        this.id = id;
        this.id_autor = id_autor;
        this.data = this.generarData();
        this.titol = titol;
        this.comentari=comentari; 
        this.todo = false;
 
     }
     generarData() {
        return new Date();
     }
 }     

