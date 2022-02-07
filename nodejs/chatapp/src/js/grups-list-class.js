export class GrupsList {

  grups;

  constructor(data) {
    this.grups = data;
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
