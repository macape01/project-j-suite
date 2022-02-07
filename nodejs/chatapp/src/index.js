import { AppTotal } from "./apptotal";
import { obtenirDades } from "./js/asynccall";

obtenirDades().then((data) =>{
    console.log(data)
    AppTotal(data)
})
.catch(e=>{
    console.log("no funciona")
})