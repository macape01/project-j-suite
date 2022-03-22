import React from "react";
import { useState } from "react";
import { nanoid } from "nanoid";
import Tickets from "../components/tickets";
import Ticket from "../components/tickets/ticket";

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
    debugger;
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

  return (
    <div className="container mt-5">
      <h1 className="text-center">CRUD APP</h1>
      <hr />
      <div className="row">
        <div className="col-8">
          <h4 className="text-center">Llista de Tasques</h4>
          <br></br>
          <table className={`table table-bordered table-striped `}>
            <tbody>
              <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Description</th>
                <th>Asset</th>
                <th>Assigned</th>
                <th colSpan={2}>Options</th>
              </tr>
              {tickets.map((ticket) => {
                let asset = assetArray.find(
                  (asset) => asset.id === ticket.asset_id
                );
                let user = userArray.find(
                  (user) => user.id === ticket.assigned_id
                );
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
          <br></br>
        </div>

        <div className="col-4">
          <h4 className="text-center">
            {modeEdicio ? "Editar Tasca" : "Afegir Tasca"}
          </h4>
          <form onSubmit={modeEdicio ? editarTasca : afegirTasca}>
            <span className="text-danger">{error} </span>
            <input
              type="text"
              className="form-control mb-2"
              placeholder="Títol"
              onChange={(e) => setTicket({ ...ticket, title: e.target.value })}
              value={ticket.title}
            />
            <input
              type="text"
              className="form-control mb-2"
              placeholder="Description"
              onChange={(e) =>
                setTicket({ ...ticket, description: e.target.value })
              }
              value={ticket.description}
            />
            <select
              type="text"
              className="form-control mb-2"
              value={ticket.assigned_id}
              onChange={(e) => {
                setTicket({ ...ticket, assigned_id: e.target.value * 1 });
              }}
            >
              <option selected hidden>
                Escull una persona asignada
              </option>
              {userArray.map((user, idx) => {
                return (
                  <option value={user.id} key={idx}>
                    {user.username}
                  </option>
                );
              })}
            </select>
            <select
              type="text"
              className="form-control mb-2"
              value={ticket.asset_id}
              onChange={(e) => {
                setTicket({ ...ticket, asset_id: e.target.value * 1 });
              }}
            >
              <option selected hidden>
                Escull un asset asignat
              </option>
              {assetArray.map((asset, idx) => {
                return (
                  <option value={asset.id} key={idx}>
                    {asset.model}
                  </option>
                );
              })}
            </select>
            {modeEdicio ? (
              <>
                <button className="btn btn-warning btn-block" type="submit">
                  Editar
                </button>
              </>
            ) : (
              <>
                <button className="btn btn-dark btn-block" type="submit">
                  Afegir
                </button>
              </>
            )}
          </form>
        </div>
      </div>
    </div>
  );
};
export default TicketForm;
