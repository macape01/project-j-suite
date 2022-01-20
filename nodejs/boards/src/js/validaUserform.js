import { Board } from "./boards";
import { generateHtml } from "./structboard";
import { generateHtml2 } from "./structValidauser";


export function ValidUser(){
    var html = document.createElement("div");
    html.id = "crear";
    html.innerHTML = generateHtml2();
    document.body.append(html);




    const user = document.getElementById("user");
    const pass = document.getElementById("password");
    const b = document.getElementById("boton");
        b.onclick = (event)=>{
        localStorage.setItem("usuari",user.value);
        localStorage.setItem("contraseña",pass.value);
        document.body.innerHTML="";

        Board();   

    
    }
}


export function Boards(){
    if ( !document.getElementById("crear2")) {
        var html = document.createElement("div");
        html.id = "crear2";
        html.innerHTML = generateHtml();
        document.body.append(html);
    }
    return;
}
