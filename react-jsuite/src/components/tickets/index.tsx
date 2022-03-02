import { TicketsProps } from "../../interfaces/tickets";
import styles from "./styles.module.scss";
import Ticket from "./ticket";

const Tickets = ({ticketArray,assetArray,userArray}:TicketsProps) => {
  console.log(ticketArray)
  return (
    <table className={styles.tickets}>
      <tbody>
      <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Description</th>
        <th>Asset</th>
        <th>Assigned</th>
      </tr>
      {
        ticketArray.map(({id,assetId,assignedId,description,title})=>{
          let asset = assetArray.find(asset=>asset.id === assetId);
          let user = userArray.find(user=>user.id === assignedId);
          return (
            <Ticket
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
