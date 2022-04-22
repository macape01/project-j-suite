import React from "react";

const Form = ({
  modeEdicio,
  editar,
  afegir,
  error,
  setState,
  state,
  userArray,
  completionArray,
  uid,
  changeFilter

}) => {
  return (
    <form onSubmit={modeEdicio ? editar : afegir}>
      <span className="text-danger">{error} </span>
      <div className="form-group mb-4">
        <label >Busca una taska: </label>
        <input 
          className="form-control mb-2"
          onChange={e=>changeFilter(e.target.value)} 
          type={"text"} 
          placeholder="Introdueix el nom d'un ticket"
          />
      </div>
      <input
        type="text"
        className="form-control mb-2"
        placeholder="Títol"
        onChange={(e) => setState({ ...state, title: e.target.value })}
        value={state.title}
      />
      <select
        type="text"
        className="form-control mb-2"
        value={state.author_id}
        onChange={(e) => {
          setState({ ...state, author_id: e.target.value});
        }}
      >
        <option selected hidden></option>
        {userArray.map((user, idx) => {
          return (
            <option value={user.uid} key={idx}>
              {user.name}
            </option>
          );
        })}
      </select>
      <select
        type="text"
        className="form-control mb-2"
        value={state.completion_id}
        onChange={(e) => {
          setState({ ...state, completion_id: e.target.value * 1 });
        }}
      >
        <option selected hidden>
          Escull estat
        </option>
        <option selected hidden></option>
        {completionArray.map((completion, idx) => {
          return (
            <option value={completion.id} key={idx}>
              {completion.name}
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
