export class UsersList {

    users;

    constructor(data) {
        this.users = data;
        //this.obtenirDades().then ((data) =>  this.users=data );

    }


    

}

/* export class UsersList {

  users;

  constructor() {
    this.obtenirDades().then ((data) =>  this.users=data );
  }

  async obtenirDades()
  {
    try{
      console.log(process.env.USERS_DATA)
      data = await fetch(process.env.USERS_DATA);
      data = await data.json();
      return data;
    }
    catch{
      console.log("... la hemos")
      return "null"
    }
  }

  

} */