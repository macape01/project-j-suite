import { useState } from "react";
import styles from "./styles.module.scss";
import Ticket from "./ticket";

const Tickets = ({
  ticketArray,
  assetArray,
  userArray,
  commentArray,
  statusArray,
  esborrarTasca,
  editar,
}) => {
  console.log(ticketArray);

  return (
    <table className={`table table-bordered table-striped ${styles.tickets} `}>
      <tbody>
        <tr>
          <th>Id</th>
          <th>Title</th>
          <th>Description</th>
          <th>Asset</th>
          <th>Assigned</th>
          <th colSpan={2}>Options</th>
        </tr>
        {ticketArray.map((ticket) => {
          let asset = assetArray.find((asset) => asset.id === ticket.asset_id);
          let user = userArray.find((user) => user.id === ticket.assigned_id);
          console.log("user", user);
          return (
            <Ticket
              id={ticket.id}
              title={ticket.title}
              description={ticket.description}
              asset={asset?.model}
              assigned={user?.username}
              esborrarTasca={esborrarTasca}
              editar={editar}
              ticket={ticket}
            />
          );
        })}
      </tbody>
    </table>
  );
};
export default Tickets;
