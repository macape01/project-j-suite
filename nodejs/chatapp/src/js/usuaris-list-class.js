export class UsuarisList {

    usuaris;

    constructor(data) {
      this.usuaris = data;
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
}