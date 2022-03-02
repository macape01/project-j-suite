
export interface TicketProps{
    id:number,
    title:string,
    description:string,
    assetId:number,
    assignedId:number,
    creatorId?:number,
    createdDate?:Date,
    updatedDate?:Date,
    deleted?:boolean,
    checked?:boolean,
}