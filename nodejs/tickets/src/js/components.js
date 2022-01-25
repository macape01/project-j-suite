import '../css/components.css';

export const createTicketForm = (assetsList,usersList) => {
 
    let assigned='';
    let assets='';
    // Creem les opcions del select, a partir de les dades
    assetsList.forEach( (asset, index) => {
        assets += `<option value=${asset.id_asset}>${asset.location} ${asset.model}</option>`;
    });
    usersList.forEach( (user, index) => {
        assigned += `<option value=${user.id_usuari}>${user.username}</option>`;
    });
  
    let html=`
    <form id="form">
        <label for="name">Name</label>
        <input id="name" type="text" name="name">
        <label for="descripcion">Description</label>
        <input id="desc" type="text" name="description">
        <select name="assignation" id="assigned">
            ${ assigned }
        </select>
        <select name="assets" id="assets">
            ${ assets }
        </select>
        <button id="createButton" type="submit">Crear incidència</button>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
            <label class="form-check-label" for="flexSwitchCheckDefault">Ocultar</label>
        </div>
        <input type="text" id="filter" placeholder="Descripcio" />
        <button id="open-filter">Filtrar</button>
    </form>
    `

    return html
}

export const createTicketHtml = (ticketsList) => {

    var tickets = '';
    // Creem les opcions del select, a partir de les dades
    ticketsList.forEach( (ticket, index) => {
        console.log(ticket);
        tickets += `
        <tr id="${ticket.id}" class="ticket">
            <td><input class=" checkk" type="checkbox" ></td>
            <td>${ticket.id}</td>
            <td>${ticket.nom}</td>
            <td>${ticket.desc}</td>
            <td>${ticket.assignedId}</td>
            <td>${ticket.assetId}</td>
            <td>
                <button class="button edit">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </button>
                <button class="button delete"><i class="fa fa-trash" aria-hidden="true"></i></button>
                <form id="edit-form" style="display:none;">
                    <label>Editar nom</label>
                    <input id="update-nom" value="${ticket.nom}" type="text"/>
                    <label>Editar descripció</label>
                    <input id="update-desc" value="${ticket.desc}" type="text"/>
                    <label>Editar persona assignada</label>
                    <input id="update-assigned" value="${ticket.assignedId}" type="number"/>
                    <button id="update-button">Update</button>
                </form>
            </td>
        </tr>
        `;
    });
  
    let html=`
  
    <table id="tickets-list">
        <tr class="tickets-header">
            <th class="title">Done</th>
            <th class="title">Id</th>
            <th class="title">Name</th>
            <th class="title">Description</th>
            <th class="title">Assigned Id</th>
            <th class="title">Asset Id</th>
            <th class="title">Tools</th>
        </tr>
        ${ tickets }
    </table>
    `

    return html
}

