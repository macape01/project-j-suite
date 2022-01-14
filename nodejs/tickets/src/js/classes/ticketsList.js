export class TicketsList {
    tickets;
    constructor() {
        this.carregarLocalStorage();
    }
    nouTicket(ticket) {
        this.tickets.push(ticket);
        this.desarLocalStorage();
    }
    desarLocalStorage() {
        localStorage.setItem('tickets',JSON.stringify(this.tickets));
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