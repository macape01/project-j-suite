const { HandleForm } = require("./formulario");
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap';
import 'bootstrap/js/dist/modal';
import { obtenirDades } from './asyncData';
import './css/modal.css';
/* import "./bootstrap.min.css";
import "./bootstrap.bundle.min"
import "./bootstrap.min" */
obtenirDades()
.then(data=>{
    console.log("data",data)
    HandleForm(data);
})
.catch(e=>{
    console.log("Cagaste")
})


