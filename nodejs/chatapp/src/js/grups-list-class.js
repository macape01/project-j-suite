export class GrupsList {
    constructor() {
        this.LoadLocalStorage();
    }
    NewGroup(grupnou) {
        this.grups.push(grupnou);
        this.SaveLocalStorage();
    }
    SaveLocalStorage() {
        localStorage.setItem('grup',JSON.stringify(this.grups));
    }
    LoadLocalStorage() {
        // this.grups = ( localStorage.getItem('grup') )
        //                 ? JSON.parse( localStorage.getItem('grup') )
        //                 : [];

        
        this.grups = [ {
            "id_grup" : 0,
            "name" : "Los Mufasas"
          }, {
            "id_grup" : 1,
            "name" : "Sacalapaca"
          }, {
            "id_grup" : 2,
            "name" : "Que tal"
          }, {
            "id_grup" : 3,
            "name" : "Deures Mates"
          }, {
            "id_grup" : 4,
            "name" : "Club Futbol"
          } ];
    }
    cercaGrup(id) {
 
      for (let i of this.grups)
      {
          if (i.id_grup == id)
              return i.name;
      }
      return "Ningún grup"
    }

}
