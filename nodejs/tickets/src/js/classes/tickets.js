export class Ticket {
    
    constructor(id,nom,desc,assetId,assignedId){
        this.id = id;
        this.nom = nom;
        this.assetId = assetId;
        this.assignedId = assignedId;
        this.desc= desc;
        this.createdDate = this.getDate();
        this.updatedDate = this.getDate();
        this.deleted = false;
        this.checked = false;
    }
    getDate(){
        let date = new Date();
        return date;
    }
    setDeleted(del){
        this.deleted = del;
    }
    setTicketCheck(check){
        this.checked = check;
    }
}