import { AssetProps } from "./asset";
import { TicketProps } from "./ticket";
import { UserProps } from "./user";
export interface TicketsProps {
    ticketArray:TicketProps[],
    assetArray:AssetProps[],
    userArray:UserProps[],
}