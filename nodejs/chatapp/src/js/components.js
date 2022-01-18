export const creaHTMLFormulariAfegir = (user,grup,usuarisList, grupsList, messageList) => {
 

    console.log(messageList)
    let opcionsusers='';
    let opcionsgrups='';

    usuarisList.forEach( (i) => {

        opcionsusers += "<option value='" + i.id_usuari + "'>"+ i.username +"</option>";
    });

    grupsList.forEach( (i) => {

        opcionsgrups += "<option value='" + i.id_grup + "'>"+ i.name +"</option>";
    });

    let html=`
                <form class="formmiss">
                    <div class="usuarisgrups">   
                        <div id="privopub">
                            <label for="users" class="form-label">Vols enviar un missatge...</label>
                            <button id="priv" type="button" value="add" class="btn btn-warning">Privat (Usuari en concret)</button>
                            <button id="pub" type="button" class="btn btn-warning">Public (Grup de Chatapp)</button>
                        </div>
                        <div id="userlists" class="users" style="display: none;">
                            <label for="users" class="form-label">Usuari</label>
                            <select id="users" class="form-select" name="users">
                        
                            ${ opcionsusers }
                        
                            </select>
                        </div>
                        <div id="groupslists" class="grups" style="display: none;">
                            <label for="grups" class="form-label">Grups</label>
                            <select id="grups" class="form-select" name="grups">
                        
                            ${ opcionsgrups }
                        
                            </select>
                        </div>
                    </div>
                    <div class="chat">
                        <div class="text">
                            <textarea class="form-control" name="text" id="text" rows="3"></textarea>
                        </div>
                        <div class="enviarmissatge">
                            <button id="enviarmissatge" type="button" class="btn btn-warning">Enviar missatge</button>
                        </div>
                        <div class="llistamens">
                            <button id="veuremens" type="button" class="btn btn-warning">Veure historial de missatges</button>
                            <button id="volveralmenu" type="button" class="btn btn-warning">Netejar</button>
                        </div>
                        <div class="nameregis>
                            <label for="name">User name: <input type="text" id="username"></label><br>
                            <label for="password">Password: <input type="text" id="password "></label>
                            <button id="savenam">login</button>
                        </div>
                    </div>
                </form>
                <table id="historial" class="historial" style="display: none;">
                    <tr class="titolhist">
                        <th>ID Missatge</th>
                        <th>Autor ID</th>
                        <th>Missatge</th>
                        <th>Usuari</th>
                        <th>Grup</th>
                        <th>Data Missatge</th>
                        <th>Opcions</th>
                    </tr>

            `
            messageList.Messages.forEach(message => {
                let cada_mensid = messageList.cercaMissatgeID(message.id);
                let cada_autormensid = messageList.cercaMissatgeAuthID(message.author_id);
                let cada_mens = messageList.cercaMissatge(message.message);
                let cada_usuari = messageList.cercaUser(message.privateuser_id);
                let cada_grup = messageList.cercaGrup(message.publicgroup_id);
                let cada_data = messageList.cercaData(message.created);

                html +=`
                    <tr class="cadahis">
                        <td>${cada_mensid}</td>
                        <td>${cada_autormensid}</td>
                        <td>${cada_mens}</td>
                        <td>${cada_usuari} </td>
                        <td>${cada_grup}</td>
                        <td>${cada_data}</td>
                        <td>
                            <button><i class="fa fa-eye"></i></button>
                            <button><i class="fa fa-edit"></i></button>
                            <button><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                        `
            });
            html+=`</table>`
            
    return html
}