export class UsuarisList {

    usuaris;

    constructor() {
    
        this.usuaris = this.obtenirDades();
        //this.obtenirDades().then ((data) =>  this.users=data );
    }

    cercaUser(id) {
 
      for (let i of this.usuaris)
      {
          if (i.id_usuari == id)
              return i.username;
      }
      return "Ningún usuari"
    }

    cercaUserAuthID(username) {
 
      for (let i of this.usuaris)
      {
          if (i.username == username)
              return i.id_usuari;
      }
      return "Ningún usuari"
    }

    addUser(user) {
      this.usuaris.push(user);
      this.SaveLocalStorage();
    }
    SaveLocalStorage() {
      localStorage.setItem('usuaris',JSON.stringify(this.usuaris));
    }
    LoadLocalStorage() {
      this.usuaris = ( localStorage.getItem('usuaris') )
                      ? JSON.parse( localStorage.getItem('usuaris') )
                      : [];
    }

    obtenerUsuaris()
    {
      return this.usuaris
    }

    obtenirDades()
    {
    
        /* let data1 = await fetch('https://biblioteca-9f853-default-rtdb.europe-west1.firebasedatabase.app/usuaris.json')
        data1 = await data1.json(); */
        
        let data1 = [ {
            "id_usuari" : 0,
            "username" : "armand",
            "password" : "maletin",
            "id_role" : 0
          }, {
            "id_usuari" : 1,
            "username" : "pep",
            "password" : "maletin",
            "id_role" : 1
          }, {
            "id_usuari" : 2,
            "username" : "jordi",
            "password" : "maletin",
            "id_role" : 3
          }, {
            "id_usuari" : 3,
            "username" : "alicia",
            "password" : "maletin",
            "id_role" : 2
          }, {
            "id_usuari" : 4,
            "username" : "cristina",
            "password" : "maletin",
            "id_role" : 0
          } ];
        return data1;
    }

}