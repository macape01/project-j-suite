import { useState } from "react";
import { TicketsProps } from "../../interfaces/tickets";
import styles from "./styles.module.scss";
import Ticket from "./ticket";

const Tickets = ({ticketArray,assetArray,userArray,commentArray,statusArray}:TicketsProps) => {
  console.log(ticketArray)
  const [ticketsArray,setTicketsArray] = useState([...ticketArray]);

  const removeTicket = () => {
    
  }
  return (
    <table className={`table table-bordered table-striped ${styles.tickets}`}>
      <tbody>
        <tr>
          <th>Id</th>
          <th>Title</th>
          <th>Description</th>
          <th>Asset</th>
          <th>Assigned</th>
        </tr>
      {
        ticketsArray.map(({id,asset_id,assigned_id,description,title})=>{
          let asset = assetArray.find(asset=>asset.id === asset_id);
          let user = userArray.find(user=>user.id === assigned_id);
          return (
            <Ticket
              onClick={removeTicket}
              id={id}
              title={title}
              description={description}
              asset={asset?.model}
              assigned={user?.username}
            />
          );
        })
      }
      </tbody>
    </table>
  );
};
export default Tickets;
