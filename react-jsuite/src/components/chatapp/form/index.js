import React from "react";

const Form = ({
  modeEdicio,
  editMessage,
  putMessage,
  error,
  setMessage,
  state,
  userArray,
  chatArray
}) => {
  return (
    <form onSubmit={modeEdicio ? editMessage : putMessage}>
      <span className="text-danger">{error} </span>
      <select
        type="text"
        className="form-control mb-2"
        value={state.author_id}
        onChange={(e) => {
          setMessage({ ...state, author_id: e.target.value * 1 });
        }}
      >
        <option selected hidden>
        </option>
        {userArray.map((user, idx) => {
          return (
            <option value={user.id} key={idx}>
              {user.username}
            </option>
          );
        })}
      </select>
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
        <option selected hidden>
        </option>
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
