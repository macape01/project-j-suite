import React, { useEffect } from "react";
import { useState } from "react";
import { nanoid } from "nanoid";
import Tickets from "../components/tickets";
import Ticket from "../components/tickets/ticket";
import "./tickets.scss";
import Form from "../components/form";

const TicketForm = ({
  ticketArray,
  assetArray,
  userArray,
  commentArray,
  statusArray,
}) => {
  const [ticket, setTicket] = useState({});
  const [tickets, setTickets] = useState([...ticketArray]);
  const [modeEdicio, setModeEdicio] = useState(false);
  const [id, setId] = useState("");
  const [error, setError] = useState(null);

  const getLastId = () => {
    return tickets.length > 0 ? tickets[tickets.length - 1].id : 0;
  };

  const editar = (item) => {
    console.log(item);
    setModeEdicio(true);
    setTicket(item);
    setId(item.id);
  };

  const editarTasca = (e) => {
    console.log("edito");
    e.preventDefault();
    let arrayEditat = [...tickets];
    tickets.forEach((t, idx) => {
      if (t.id === ticket.id) {
        arrayEditat[idx] = ticket;
      }
    });

    console.log(arrayEditat);
    setTickets(arrayEditat);
    setId(false);
    setTicket("");
    setModeEdicio(false);
    setError(null);
  };
  const esborrarTasca = (id) => {
    console.log(id);

    const arrayFiltrat = tickets.filter((v) => {
      return v.id !== id;
    });

    setTickets(arrayFiltrat);
  };

  const afegirTasca = (e) => {
    e.preventDefault();
    if (Object.keys(ticket).length > 0) {
      setError(null);

      setTickets([
        ...tickets,
        {
          ...ticket,
          id: getLastId() + 1,
        },
      ]);
      return;
    }
    setError("Cagaste");
  };

  useEffect(() => {
    console.log("tickets", tickets);
  }, [tickets]);

  return (
    <div className="container mt-5">
      <h1 className="text-center">CRUD APP</h1>
      <hr />
      <div className="row">
        <div className="col-8">
          <h4 className="text-center">Llista de Tasques</h4>
          <br></br>
          <Tickets
            ticketArray={tickets}
            assetArray={assetArray}
            userArray={userArray}
            esborrarTasca={esborrarTasca}
            editar={editar}
          />
          <br></br>
        </div>

        <div className="col-4">
          <h4 className="text-center">
            {modeEdicio ? "Editar Tasca" : "Afegir Tasca"}
          </h4>
          <Form
            modeEdicio={modeEdicio}
            editarTasca={editarTasca}
            afegirTasca={afegirTasca}
            error={error}
            setTicket={setTicket}
            ticket={ticket}
            userArray={userArray}
            assetArray={assetArray}
          />
        </div>
      </div>
    </div>
  );
};
export default TicketForm;
