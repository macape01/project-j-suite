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
      return "Ninguna id usuari"
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

    getLastId() {
      let id = this.usuaris.length > 0 ? this.usuaris[this.usuaris.length-1].id_usuari : 0;
      return id;
    }

    async setUsers(user,id) {

      try {
          this.usuaris.push(user);
          const res= await fetch('https://project-j-suite-default-rtdb.europe-west1.firebasedatabase.app/usuaris/'+id+'.json',
              { 
                  method: 'PUT',
                  headers: {
                      'Content-Type': 'application/json'
                  },
                  body: JSON.stringify(user)
              })
          location.reload();
      }

      catch (error) {
      }
  }

    obtenerUsuaris()
    {
      return this.usuaris
    }
}