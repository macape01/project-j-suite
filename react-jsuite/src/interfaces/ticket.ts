import { AssetProps } from "./asset";
import { UserProps } from "./user";

export interface TicketProps{
    id:number,
    title:string,
    description:string,
    assetId:number,
    asset?:AssetProps,
    assigned?:UserProps,
    assignedId:number,
    creatorId?:number,
}