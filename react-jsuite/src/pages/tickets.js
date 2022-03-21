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

  const editar = (item) => {
    console.log(item);
    setModeEdicio(true);
    setTicket(item.nomTasca);
    setId(item.id);
  };
  const editarTasca = (e) => {
    console.log("edito");
    e.preventDefault();

    if (!ticket.trim()) {
      console.log("Element buit");
      setError("Introdueix algun valor");
      return;
    }
    const arrayEditat = tickets.map((v) => {
      return v.id === id ? { id: id, nomTasca: ticket } : v;
    });

    console.log(arrayEditat);
    setTickets(arrayEditat);
    setId("");
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

    if (!ticket.trim()) {
      console.log("Element buit");
      setError("Introdueix algun valor");

      return;
    }
    console.log(ticket);
    setTicket("");
    setError(null);

    setTickets([
      ...tickets,
      {
        id: nanoid(),
        nomTasca: ticket,
      },
    ]);
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
              </tr>
              {tickets.map(
                ({ id, asset_id, assigned_id, description, title }) => {
                  let asset = assetArray.find((asset) => asset.id === asset_id);
                  let user = userArray.find((user) => user.id === assigned_id);
                  return (
                    <Ticket
                      id={id}
                      title={title}
                      description={description}
                      asset={asset?.model}
                      assigned={user?.username}
                    />
                  );
                }
              )}
            </tbody>
          </table>
          {/* <ul className="list-group">
            {tickets.length === 0 ? (
              <li className="list-group-item">No hi ha tickets actives</li>
            ) : (
              tickets.map((v) => {
                return (
                  <li key={v.id} className="list-group-item">
                    <span className="lead">{v.nomTasca}</span>
                    <button
                      className="btn btn-sm btn-danger float-right mx-2"
                      onClick={() => esborrarTasca(v.id)}
                    >
                      Esborrar
                    </button>
                    <button
                      className="btn btn-sm btn-warning float-right"
                      onClick={() => editar(v)}
                    >
                      Editar
                    </button>
                  </li>
                );
              })
            )}
          </ul> */}
          <br></br>
        </div>

        <div className="col-4">
          <h4 className="text-center">
            {modeEdicio ? "Editar Tasca" : "Afegir Tasca"}
          </h4>
          <form onSubmit={modeEdicio ? editarTasca : afegirTasca}>
            <span className="text-danger">{error} </span>
            {modeEdicio ? (
              <>
                <input
                  type="text"
                  className="form-control mb-2"
                  placeholder="Editar Tasca"
                  onChange={(e) => setTicket(e.target.value)}
                  value={ticket}
                />
                <button className="btn btn-warning btn-block" type="submit">
                  Editar
                </button>
              </>
            ) : (
              <>
                <input
                  type="text"
                  className="form-control mb-2"
                  placeholder="Títol"
                  onChange={(e) =>
                    setTicket({ ...ticket, title: e.target.value })
                  }
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
                  placeholder="Afegeix Tasca"
                  onChange={(e) =>
                    setTicket({ ...ticket, assigned: e.target.value })
                  }
                  value={ticket.assigned}
                >
                  {userArray.map((user, idx) => {
                    console.log("tsa", user);
                    return <option key={idx}>{user.username}</option>;
                  })}
                </select>
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
