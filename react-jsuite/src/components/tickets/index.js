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

  return (
    <table className={`table table-bordered table-striped ${styles.tickets} `}>
      <tbody>
        <tr>
          <th>Id</th>
          <th>Title</th>
          <th>Description</th>
          <th>Asset</th>
          <th>Assigned</th>
          <th>Status</th>
          <th>Comments</th>
          <th colSpan={2}>Options</th>
        </tr>
        {ticketArray.map((ticket) => {
          console.log("ticket",ticket)
          let asset = assetArray.find((asset) => asset.id === ticket.asset_id);
          let user = userArray.find((user) => user.id === ticket.assigned_id);
          let status = statusArray.find(
            (status) => status.id === ticket.status_id
          );
          let comments = commentArray.filter(
            (comment) => comment.ticket_id === ticket.tid
          );
          console.log("user", user);
          return (
            <Ticket
              key={ticket.id}
              id={ticket.id}
              tid={ticket.tid}
              title={ticket.title}
              description={ticket.description}
              asset={asset?.model}
              assigned={user?.username}
              esborrarTasca={esborrarTasca}
              editar={editar}
              ticket={ticket}
              status={status.name}
              comments={comments}
            />
          );
        })}
      </tbody>
    </table>
  );
};
export default Tickets;
