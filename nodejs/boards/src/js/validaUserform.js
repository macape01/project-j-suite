import { Board } from "./boards";
import { generateHtml } from "./structboard";
import { generateHtml2 } from "./structValidauser";


export function ValidUser(data){
    var html = document.createElement("div");
    html.id = "crear";
    html.innerHTML = generateHtml2();
    document.body.append(html);




    const user = document.getElementById("user");
    const pass = document.getElementById("password");
    const b = document.getElementById("boton");
    b.onclick = (event)=>{

        document.body.innerHTML="";
        Board(data);   

    
    }
}


