import React from "react";

const Form = ({
  modeEdicio,
  editarTasca,
  afegirTasca,
  error,
  setTicket,
  ticket,
  userArray,
  assetArray,
}) => {
  return (
    <form onSubmit={modeEdicio ? editarTasca : afegirTasca}>
      <span className="text-danger">{error} </span>
      <input
        type="text"
        className="form-control mb-2"
        placeholder="Títol"
        onChange={(e) => setTicket({ ...ticket, title: e.target.value })}
        value={ticket.title ?? ""}
      />
      <input
        type="text"
        className="form-control mb-2"
        placeholder="Description"
        onChange={(e) => setTicket({ ...ticket, description: e.target.value })}
        value={ticket.description ?? ""}
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
  );
};

export default Form;
