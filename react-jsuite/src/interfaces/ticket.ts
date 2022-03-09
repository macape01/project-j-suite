
export interface TicketProps{
    id:number,
    title:string,
    description:string,
    asset_id:number,
    assigned_id:number,
    creatorId?:number,
    createdDate?:Date,
    updatedDate?:Date,
    deleted?:boolean,
    checked?:boolean,
}