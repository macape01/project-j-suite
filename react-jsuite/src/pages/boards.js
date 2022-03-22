import React from "react";
import { useState } from "react";
import { nanoid } from "nanoid";
import Boards from "../components/boards";
import Task from "../components/boards/task";

const TaskForm = ({ noteArray, completionArray, userArray, taskArray }) => {
  const [tasca, setTasca] = useState("");
  const [tasques, setTasques] = useState([...taskArray]);
  const [modeEdicio, setModeEdicio] = useState(false);
  const [id, setId] = useState("");
  const [error, setError] = useState(null);

  const getLastId = () => {
    return tasques.length > 0 ? tasques[tasques.length - 1].id : 0;
  };
  const editar = (item) => {
    console.log(item);
    setModeEdicio(true);
    setTasca(item.title);
    setId(item.id);
  };
  const editarTasca = (e) => {
    console.log("edito");
    e.preventDefault();

    // if (!tasca.trim()) {
    //   console.log("Element buit");
    //   setError("Introdueix algun valor");
    //   return;
    // }
    const arrayEditat = tasques.map((v) => {
      return v.id === id ? { id: id, title: tasca } : v;
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
    debugger;
    e.preventDefault();

    // if (!tasca.trim()) {
    //   console.log("Element buit");
    //   setError("Introdueix algun valor");

    //   return;
    // }
    console.log(tasca);
    setTasca("");
    setError(null);

    setTasques([
      ...tasques,
      {
        ...tasca,
        id: getLastId() + 1,
        completion: "a",
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
          <table>
            <tbody>
              <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Completion</th>
                <th>Author</th>
              </tr>
              {tasques.map(({ id, author_id, completion_id, title }) => {
                let user = userArray.find((user) => user.id === author_id);
                let completion = completionArray.find(
                  (completion) => completion.id === completion_id
                );
                console.log("user", user);
                return (
                  <Task
                    id={id}
                    title={title}
                    author_id={author_id}
                    completion_id={completion?.name}
                  />
                );
              })}
            </tbody>
          </table>
          ;
          <ul className="list-group">
            {tasques.length === 0 ? (
              <li className="list-group-item">No hi ha tasques actives</li>
            ) : (
              tasques.map((v) => {
                return (
                  <li key={v.id} className="list-group-item">
                    <span className="lead">{v.title}</span>
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
              placeholder="Description"
              onChange={(e) => setTasca({ ...tasca, title: e.target.value })}
              value={tasca.title}
            />
            <select
              type="text"
              className="form-control mb-2"
              placeholder="Afegeix Tasca"
              onChange={(e) => {
                setTasca({ ...tasca, assigned_id: e.target.value * 1 });
              }}
            >
              <option selected hidden></option>
              {userArray.map((user, idx) => {
                return (
                  <option value={user.id} key={idx}>
                    {user.username}
                  </option>
                );
              })}
            </select>

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
export default TaskForm;
