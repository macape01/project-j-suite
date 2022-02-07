export class TicketsList {
    tickets;
    constructor(data) {
        this.tickets = data;
        
    }
    nouTicket(ticket) {
        this.tickets.push(ticket);
        this.desarLocalStorage();
    }
    async setNewTicket(ticket,id) {
        //localStorage.setItem('tickets',JSON.stringify(this.tickets));
        try {

            const res = await fetch(`https://project-j-suite-default-rtdb.europe-west1.firebasedatabase.app/tickets/${id}.json`,
            {
                method: 'PUT',
                headers: {
                'Content-Type': 'application/json'
            },
                body: JSON.stringify(ticket)
            })
            await this.tickets.push(ticket);
            
        }
        catch (error) {
            console.log("error al afegir un ticker")
        }
    }
    carregarLocalStorage() {
        this.tickets = ( localStorage.getItem('tickets') )
                        ? JSON.parse( localStorage.getItem('tickets') )
                        : [];
    }
    getLastId() {
        let id = this.tickets.length > 0 ? this.tickets[this.tickets.length-1].id : 0;
        return id;
    }
    updateList(newList){
        this.tickets = newList;
        this.desarLocalStorage();
    }
}