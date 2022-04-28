import React from "react";

const Form = ({
  modeEdicio,
  editMessage,
  putMessage,
  error,
  setMessage,
  state,
  userArray,
  chatArray,
  changeFilter,
  uid,
}) => {
  return (
    <form onSubmit={modeEdicio ? editMessage : putMessage}>
      <span className="text-danger">{error} </span>
      <div className="form-group mb-4">
        <label >Busca un message: </label>
        <input 
          className="form-control mb-2"
          onChange={e=>changeFilter(e.target.value)} 
          type={"text"} 
          placeholder="Introdueix el nom d'un message"
          />
      </div>
      {/* <select
        type="text"
        className="form-control mb-2"
        value={state.author_id}
        onChange={(e) => {
          setMessage({ ...state, author_id: e.target.value });
        }}
      >
        <option selected hidden>
          Escull un autor
        </option>
        {userArray.map((user, idx) => {
          console.log("user", user);
          return (
            <option value={user.uid} key={idx}>
              {user.name}
            </option>
          );
        })}
      </select> */}
      <input
        type="text"
        className="form-control mb-2"
        placeholder="Escriu aqui..."
        onChange={(e) => setMessage({ ...state, message: e.target.value })}
        value={state.message}
      />
      <select
        type="text"
        className="form-control mb-2"
        value={state.chat_id}
        onChange={(e) => {
          setMessage({ ...state, chat_id: e.target.value * 1 });
        }}
      >
        <option selected hidden>Escull un chat</option>
        {chatArray.map((chat, idx) => {
          return (
            <option value={chat.id} key={idx}>
              {chat.name}
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
            Enviar
          </button>
        </>
      )}
    </form>
  );
};

export default Form;
