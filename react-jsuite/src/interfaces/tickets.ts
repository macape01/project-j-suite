import { AssetProps } from "./asset";
import { CommentProps } from "./comment";
import { StatusProps } from "./status";
import { TicketProps } from "./ticket";
import { UserProps } from "./user";
export interface TicketsProps {
    ticketArray:TicketProps[],
    assetArray:AssetProps[],
    userArray:UserProps[],
    statusArray:StatusProps[],
    commentArray:CommentProps[],
}