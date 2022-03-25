import React, { useEffect } from "react";
import { useState } from "react";
import { nanoid } from "nanoid";
import Boards from "../components/boards";
import Task from "../components/boards/task";
import Form from "../components/boards/form";
import Tasks from "../components/boards";

const TaskForm = ({ noteArray, completionArray, userArray, taskArray }) => {
  const [tasca, setTasca] = useState({
    title: "",
    author_id: "",
    completion_id: "",
  });
  const [tasques, setTasques] = useState([...taskArray]);
  const [modeEdicio, setModeEdicio] = useState(false);
  const [id, setId] = useState("");
  const [error, setError] = useState(null);

  const getLastId = () => {
    return tasques.length > 0 ? tasques[tasques.length - 1].id : 0;
  };

  const editar = (item) => {
    console.log("cosas");
    console.log(item);
    setModeEdicio(true);
    setTasca(item);
    setId(item.id);
  };
  const editarTasca = (e) => {
    console.log("edito");
    e.preventDefault();
    let arrayEditat = [...tasques];
    tasques.forEach((t, idx) => {
      if (t.id === tasca.id) {
        arrayEditat[idx] = tasca;
      }
    });

    setTasques(arrayEditat);
    setId(false);
    setTasca({
      title: "",
      author_id: "",
      completion_id: "",
    });
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
    let value = Object.values(tasca).find((t) => {
      if (t === "" || t === null) return true;
    });

    if (value !== undefined) {
      setError("Cagaste");
      return;
    }
    setError(null);

    setTasques([
      ...tasques,
      {
        ...tasca,
        id: getLastId() + 1,
      },
    ]);

    setTasca({
      title: "",
      author_id: "",
      completion_id: "",
    });
  };


  return (
    <div className="container mt-5">
      <h1 className="text-center">CRUD APP</h1>
      <hr />
      <div className="row">
        <div className="col-8">
          <h4 className="text-center">Llista de Tasques</h4>
          <br></br>
          <Tasks
            taskArray={tasques}
            userArray={userArray}
            completionArray={completionArray}
            esborrar={esborrarTasca}
            editar={editar}
          />
        </div>

        <div className="col-4">
          <h4 className="text-center">
            {modeEdicio ? "Editar Tasca" : "Afegir Tasca"}
          </h4>
          <Form
            modeEdicio={modeEdicio}
            editar={editarTasca}
            afegir={afegirTasca}
            error={error}
            setState={setTasca}
            state={tasca}
            userArray={userArray}
            completionArray={completionArray}
          />
        </div>
      </div>
    </div>
  );
};
export default TaskForm;
