const { HandleForm } = require("./formulario");
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap';
import 'bootstrap/js/dist/modal';
import './css/modal.css';
import { obtenirDades } from './asyncData';

obtenirDades()
.then(data=>{
    console.log("data",data)
    HandleForm(data);
})
.catch(e=>{
    console.log("Cagaste")
})


