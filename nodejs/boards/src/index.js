const { obtenirDades } = require("./js/asyncData");
const { ValidUser } = require("./js/validaUserform");


obtenirDades()
.then(data=>{
    console.log("data",data)
    ValidUser(data);
})
.catch(e=>{
    console.log("Cagaste")
})