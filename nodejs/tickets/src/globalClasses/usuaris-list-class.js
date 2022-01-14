export class UsersList {

    users;

    constructor() {

   
        this.users = this.obtenirDades();
        //this.obtenirDades().then ((data) =>  this.users=data );


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