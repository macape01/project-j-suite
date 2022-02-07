import "./css/home.grid.css";
import "./css/components.css";
//import "./css/reset.css";
import "./css/variables.css";
import "./css/layout.css";
import "./css/styles.css";
import "./css/formulari.css";
import header from "./html/header.html";
import footer from "./html/footer.html";
import { GrupsList } from "./js/grups-list-class.js";
import { MessageList } from "./js/messages-list-class";
import { Messages } from "./js/messages";
import { UsuarisList } from "./js/usuaris-list-class";
import { creaHTMLFormulariAfegir } from "./js/components.js";

export function AppTotal(data){

    let [usuarisData,grupData,messageData] = data;

    let usuarisList = new UsuarisList(usuarisData);
    let users = usuarisList.usuaris;
    let messageList = new MessageList(messageData);
    let grupsList = new GrupsList(grupData);
    let grups = grupsList.grups;

    var author_id= 0;

    let div = document.createElement('div');
    div.innerHTML=header
    document.body.append(div);

    let form= document.createElement('div');
        form.id="form"
        form.className="form"
        form.innerHTML=creaHTMLFormulariAfegir(users,grups,messageList)
        document.body.append(form);

    let div2 = document.createElement('div');
    div2.innerHTML=footer
    document.body.append(div2);

    document.getElementById("enviarmissatge").addEventListener('click',(event) => {
        console.debug("enviarmissatge")
        event.preventDefault();
        var username = document.getElementById("username").value;
        
        const id = messageList.getLastId()+1;
        var author_id= usuarisList.cercaUserAuthID(username);
        const message = document.getElementById("text").value;
        const created= new Date();
        var publicgroup_id = document.getElementById("grups").value;
        var privateuser_id = document.getElementById("users").value;
        if( document.getElementById("groupslists").style.display == 'none'){
            publicgroup_id=null
        }else if(document.getElementById("userlists").style.display == 'none'){
            privateuser_id=null
        }
        var newMessage = new Messages(id, author_id, message, created, publicgroup_id, privateuser_id);
        messageList.setMessages(newMessage,id);
        location.reload();
    })
    document.getElementById("priv").addEventListener('click',(event) => {
        event.preventDefault()
        document.getElementById("userlists").style.display = "block";
        document.getElementById("groupslists").style.display = "none";
    })
    document.getElementById("pub").addEventListener('click',(event) => {
        event.preventDefault()
        document.getElementById("groupslists").style.display = "block";
        document.getElementById("userlists").style.display = "none";
    })
    document.getElementById("savenam").addEventListener('click',(event) => {
        event.preventDefault()
        var username =  document.getElementById("username").value;
        var passwd =  document.getElementById("password ").value;
        var data = usuarisList.obtenerUsuaris();
        if(auth(data, username, passwd)){
            alert("Logeado "+username)
            localStorage.setItem('username', document.getElementById("username").value);
        }else{
            alert("No se encuentra el usuari con esa contraseña, lo vamos a registrar.")
            var newUser={
                'id_usuari':(data[data.length-1]['id_usuari']+1),
                'username':username,
                'password':passwd,
                "id_role":0}
            console.log(newUser)
            usuarisList.addUser(newUser)
            usuarisList.LoadLocalStorage();
            console.log(usuarisList.obtenerUsuaris())
            localStorage.setItem('username', document.getElementById("username").value);
        }
    })
    if(localStorage.getItem('username') != ""){
        document.getElementById("username").value = localStorage.getItem("username");
    }
    document.getElementById("veuremens").addEventListener('click',(event) => {
        event.preventDefault()
        document.getElementById("historial").style.display = "block";
        document.getElementById("filtre").style.display = "block";
    })
    document.getElementById("volveralmenu").addEventListener('click',(event) => {
        event.preventDefault()
        document.getElementById("historial").style.display = "none";
        document.getElementById("filtre").style.display = "none";
    })

    const elementsCollection = document.getElementsByClassName("deletetask");
    const elementsArray = [...elementsCollection];
    elementsArray.forEach(element=>element.addEventListener('click',(event) => {
        event.preventDefault()
        let message = element.parentNode.parentNode;
        let text = message.getElementsByTagName("td")[0];
        let mensid= text.innerText;
        message.remove();
        messageList.removeMessage(mensid*1);
    }))

    const elementsCollection2 = document.getElementsByClassName("edittask");
    const elementsArray2 = [...elementsCollection2];
    elementsArray2.forEach(element=>element.addEventListener('click',(event) => {
        event.preventDefault()
        let message = element.parentNode.parentNode;
        let id = message.getElementsByTagName("td")[0];
        let idmens= id.innerText;
        let text = message.getElementsByTagName("td")[2];
        let menscomplete= text.innerText;
        var newmens = prompt("Edita el teu missatge:", menscomplete);
        messageList.editMessage(idmens*1, newmens);
        location.reload();
    }))

    const elementsCollection3 = document.getElementsByClassName("seetask");
    const elementsArray3 = [...elementsCollection3];
    elementsArray3.forEach(element=>element.addEventListener('click',(event) => {
        event.preventDefault()
        let message = element.parentNode.parentNode;
        let text = message.getElementsByTagName("td")[2];
        let menscomplete= text.innerText;
        window.alert("Aqui tens el missatge complet: " + menscomplete);
    }))

    const filtre = document.getElementById("filt");
    filtre.addEventListener("keyup", myFilter);
    function myFilter() {
        var filter, table, tr, td, i, txtValue;
        filter = filtre.value.toUpperCase();
        table = document.getElementById("historial");
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[2];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }       
        }
    }

    function auth(data, user, passwd){
        var auth = false;

        data.forEach(us =>{
            if (us.username == user && us.password == passwd){
                console.log("ok")
                auth = true;
                author_id = us.id;
                return true;
            }
        })

        return auth
    }
}