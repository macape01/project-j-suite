import React from "react";
import { useState } from "react";
import { nanoid } from "nanoid";
import Tickets from "../components/tickets";

const TicketForm = ({
  ticketArray,
  assetArray,
  userArray,
  commentArray,
  statusArray,
}) => {
  const [tasca, setTasca] = useState("");
  const [tasques, setTasques] = useState([]);
  const [modeEdicio, setModeEdicio] = useState(false);
  const [id, setId] = useState("");
  const [error, setError] = useState(null);

  const editar = (item) => {
    console.log(item);
    setModeEdicio(true);
    setTasca(item.nomTasca);
    setId(item.id);
  };
  const editarTasca = (e) => {
    console.log("edito");
    e.preventDefault();

    if (!tasca.trim()) {
      console.log("Element buit");
      setError("Introdueix algun valor");
      return;
    }
    const arrayEditat = tasques.map((v) => {
      return v.id === id ? { id: id, nomTasca: tasca } : v;
    });

    console.log(arrayEditat);
    setTasques(arrayEditat);
    setId("");
    setTasca("");
    setModeEdicio(false);
    setError(null);
  };
  const esborrarTasca = (id) => {
    console.log(id);

    const arrayFiltrat = tasques.filter((v) => {
      return v.id !== id;
    });

    setTasques(arrayFiltrat);
  };

  const afegirTasca = (e) => {
    e.preventDefault();

    if (!tasca.trim()) {
      console.log("Element buit");
      setError("Introdueix algun valor");

      return;
    }
    console.log(tasca);
    setTasca("");
    setError(null);

    setTasques([
      ...tasques,
      {
        id: nanoid(),
        nomTasca: tasca,
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
          <Tickets
            commentArray={commentArray}
            statusArray={statusArray}
            assetArray={assetArray}
            userArray={userArray}
            ticketArray={ticketArray}
          />
          ;
          <ul className="list-group">
            {tasques.length === 0 ? (
              <li className="list-group-item">No hi ha tasques actives</li>
            ) : (
              tasques.map((v) => {
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
          </ul>
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
              placeholder="Afegeix Tasca"
              onChange={(e) => setTasca(e.target.value)}
              value={tasca}
            />

            {modeEdicio ? (
              <button className="btn btn-warning btn-block" type="submit">
                Editar
              </button>
            ) : (
              <button className="btn btn-dark btn-block" type="submit">
                Afegir
              </button>
            )}
          </form>
        </div>
      </div>
    </div>
  );
};
export default TicketForm;
