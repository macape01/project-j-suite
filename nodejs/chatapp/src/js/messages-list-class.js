export class MessageList {
    constructor() {
        this.LoadLocalStorage();
    }
    NewText(message) {
        this.Messages.push(message);
        this.SaveLocalStorage();
    }
    SaveLocalStorage() {
        localStorage.setItem('messages',JSON.stringify(this.Messages));
    }
    LoadLocalStorage() {
        this.Messages = ( localStorage.getItem('messages') )
                        ? JSON.parse( localStorage.getItem('messages') )
                        : [];
    }
    removeMessage(idmens){
        let message = this.Messages.find(message=> message.id === idmens)
        let index = this.Messages.indexOf(message);
        this.Messages.splice(index,1);
        this.SaveLocalStorage();
    }
    editMessage(idmens, newmens){
        let messageid = this.Messages.find(message=> message.id === idmens)
        let index = this.Messages.indexOf(messageid);
        this.Messages[index].message=newmens;
        this.SaveLocalStorage();
    }
    cercaMissatgeID(id) {
        for (let i of this.Messages)
        {
            if (i.id == id)
                return i.id;
        }
        return "ID Buida"    
    }
    cercaMissatgeAuthID(id) {
        let message=this.Messages.find(message=>message.author_id==id);
        return ( message && message.author_id) ? message.author_id : "Autor ID Buida";
    }
    cercaData(data) {
        for (let i of this.Messages)
        {
            if (i.created == data)
                return i.created;
        }
        return "Data Buit"
    }
    cercaMissatge(missatge) {
        for (let i of this.Messages)
        {
            if (i.message == missatge)
                return i.message;
        }
        return "Missatge Buit"
    }
    cercaUser(user) {
        for (let i of this.Messages)
        {
            if (i.privateuser_id == user)
                return i.privateuser_id;
        }
        return "Usuario buit"
    }
    cercaGrup(grup) {
        for (let i of this.Messages)
        {
            if (i.publicgroup_id == grup)
                return i.publicgroup_id;
        }
        return "Grup Buit"
    }
    getLastId() {
        let id = this.Messages.length > 0 ? this.Messages[this.Messages.length-1].id : 0;
        return id;
    }
}
