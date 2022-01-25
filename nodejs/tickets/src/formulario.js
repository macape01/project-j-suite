import  "./styles.css";
import { createTicketForm,createTicketHtml } from "./js/components";
import { TicketsList } from "./js/classes/ticketsList";
import { UsersList } from "./globalClasses/usuaris-list-class";
import { AssetsList } from "./js/classes/assets-list-class";
import { Ticket } from "./js/classes/tickets";
import "./js/classes/modalElement";

/* function BorrarLlista(llista){
    document.removeChild()
} */

export function HandleForm(){
    var cos= document.createElement('div');
    cos.id="creacio"
    
    let assetsList = new AssetsList();
    let assets = assetsList.assets;
    
    let userList = new UsersList();
    let users = userList.users;
    var modal = document.getElementById("e-modal");
    console.log(modal)
    
    cos.innerHTML=createTicketForm(assets,users);
    document.body.append(cos);
    
    let ticketsList = new TicketsList();



    PrintTicketList(ticketsList);
    
    const button = document.getElementById("createButton");
    const filterButton = document.getElementById("open-filter");
    const filterInput = document.getElementById("filter");
    var deleteButtons = document.getElementsByClassName("delete");
    var editButtons = document.getElementsByClassName("edit");
    var checkBoxes = document.getElementsByClassName("checkk");
    
    filterButton.addEventListener("click",(e)=>{
        e.preventDefault();
        let value = filterInput.value;
        FilterTicketList(ticketsList,value);
        
    })
    button.addEventListener("click",(e)=>{
        e.preventDefault();
        var id = ticketsList.getLastId() +1;
        const name = document.getElementById("name").value;
        const desc = document.getElementById("desc").value;
        const assigned = document.getElementById("assigned").value;
        const asset = document.getElementById("assets").value;
        var newTicket = new Ticket(id,name,desc,asset,assigned);
        ticketsList.nouTicket(newTicket);
        PrintTicketList(ticketsList);
        window.location.reload();

    })
    for (let index = 0; index < deleteButtons.length; index++) {
        const element = deleteButtons[index];
        element.addEventListener("click",(e)=>{
            e.preventDefault();
            let ticket = element.parentNode.parentNode;
            let id = ticket.id;
            HandleDelete(ticketsList,ticket,id);
        })
        
    }
    for (let index = 0; index < checkBoxes.length; index++) {
        const element = checkBoxes[index];
        element.addEventListener("click",(e)=>{
            let elementState = element.checked;
            let ticket = element.parentNode.parentNode;
            let id = ticket.id;
            HandleCheck(ticketsList,id,elementState);
        })
        
    }
    for (let index = 0; index < editButtons.length; index++) {
        const element = editButtons[index];
        element.addEventListener("click",(e)=>{
            let ticket = element.parentNode.parentNode;
            let id = ticket.id;
            HandleEdit(ticketsList,id);
        })
        
    }
}

function HandleEdit(ticketsList,id){
    var form = document.getElementById("edit-form");
    var button = document.getElementById("update-button");
    var name = document.getElementById("update-nom");
    var desc = document.getElementById("update-desc");
    var assigned = document.getElementById("update-assigned");
    form.style.display="block";

    button.addEventListener("click",(e)=>{
        let newTicketList = ticketsList.tickets;
        let ticketObject = newTicketList.find(ticketObj=>ticketObj.id === parseInt(id));
        ticketObject.editTicket(name.value,desc.value,assigned.value);
        ticketsList.updateList(newTicketList);
    })
    console.log(modal)
    
    
}
function FilterTicketList(ticketsList,filter){
    console.log("filter",filter)
    let pattern = new RegExp(filter);
    
    var el = document.getElementById("llista")
    if (el) el.remove();
    var cos= document.createElement('div');
    cos.id="llista"
    let tickets = ticketsList.tickets.filter(ticket => ticket.nom.match(pattern) && !ticket.deleted);
    cos.innerHTML+=createTicketHtml(tickets);
    const container = document.getElementById("creacio");
    container.append(cos);
}

function PrintTicketList(ticketsList){
    console.log("filter",filter)
    var el = document.getElementById("llista")
    if (el) el.remove();
    var cos= document.createElement('div');
    cos.id="llista"
    let tickets = ticketsList.tickets.filter(ticket => !ticket.deleted);
    cos.innerHTML+=createTicketHtml(tickets);
    const container = document.getElementById("creacio");
    container.append(cos);
}



function HandleDelete(ticketsList,ticket,id){
    console.log("id",id)
    let newTicketList = ticketsList.tickets;
    let ticketObject = newTicketList.find(ticketObj=>ticketObj.id === parseInt(id));
    console.log("list",Object.getOwnPropertyNames(ticketObject))
    ticket.remove();
    ticketObject.deleted = true;
    console.log(ticketObject.deleted)
    ticketsList.updateList(newTicketList);
}

function HandleCheck(ticketsList,id,elementState){
    let newTicketList = ticketsList.tickets;
    let ticketObject = newTicketList.find(ticketObj=>ticketObj.id === parseInt(id));
    ticketObject.checked = true;
    console.log(ticketObject.checked)
    ticketsList.updateList(newTicketList);
}