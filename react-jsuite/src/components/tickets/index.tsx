import { TicketsProps } from "../../interfaces/tickets";
import styles from "./styles.module.scss";
import Ticket from "./ticket";

const Tickets = ({ticketArray,assetArray,userArray}:TicketsProps) => {
  return (
    <div className={styles.tickets}>
      {
        ticketArray.map((ticket,index)=>{
          let asset = assetArray.find(asset=>asset.id === ticket.assetId);
          let user = userArray.find(user=>user.id === ticket.assignedId);
          return <Ticket id={ticket.id} title={ticket.title} description={ticket.description} asset={asset} assigned={user} assetId={ticket.assetId} assignedId={ticket.assignedId} />
        })
      }
    </div>
  );
};
export default Tickets;
