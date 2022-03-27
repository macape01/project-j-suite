import React from "react";

const Form = ({
  modeEdicio,
  editar,
  afegir,
  error,
  setState,
  setCommentArray,
  state,
  userArray,
  assetArray,
  statusArray,
  commentArray,
}) => {
  return (
    <form onSubmit={modeEdicio ? editar : afegir}>
      <span className="text-danger">{error} </span>
      <input
        type="text"
        className="form-control mb-2"
        placeholder="Títol"
        onChange={(e) => setState({ ...state, title: e.target.value })}
        value={state.title}
      />
      <input
        type="text"
        className="form-control mb-2"
        placeholder="Description"
        onChange={(e) => setState({ ...state, description: e.target.value })}
        value={state.description}
      />
      <select
        type="text"
        className="form-control mb-2"
        value={state.assigned_id}
        onChange={(e) => {
          setState({ ...state, assigned_id: e.target.value * 1 });
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
        value={state.asset_id}
        onChange={(e) => {
          setState({ ...state, asset_id: e.target.value * 1 });
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
      <select
        type="text"
        className="form-control mb-2"
        value={state.status_id}
        onChange={(e) => {
          setState({ ...state, status_id: e.target.value * 1 });
        }}
      >
        <option selected hidden>
          Escull un status
        </option>
        {statusArray.map((status, idx) => {
          return (
            <option value={status.id} key={idx}>
              {status.name}
            </option>
          );
        })}
      </select>
      {modeEdicio && (
        <>
          <label>Estos son los comments</label>
          <select value={"a"} className="form-control mb-2">
            {commentArray
              .filter((c) => c.ticket_id === state.tid)
              .map((comment, idx) => {
                return (
                  <option selected disabled value={comment.id} key={idx}>
                    {comment.msg}
                  </option>
                );
              })}
          </select>
          <input
            type="text"
            className="form-control mb-2"
            placeholder="Comment"
            onBlur={(e) =>
              setCommentArray([
                ...commentArray,
                {
                  id: 3,
                  author_id: 5,
                  ticket_id: state.id,
                  msg: e.target.value,
                  created: "22/2/2",
                },
              ])
            }
          />
        </>
      )}
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
