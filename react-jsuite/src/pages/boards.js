import React, { useEffect } from "react";
import { useState } from "react";
import { nanoid } from "nanoid";
import Boards from "../components/boards";
import Task from "../components/boards/task";
import Form from "../components/boards/form";
import Tasks from "../components/boards";
import {db} from '../firebase'
import { collection, doc, orderBy, query, where, getDocs, addDoc, serverTimestamp, deleteDoc, setDoc, onSnapshot} from "firebase/firestore"
import { getAuth } from "firebase/auth";
import { useNavigate } from "react-router-dom";



const TaskForm = ({ noteArray, completionArray, userArray, taskArray }) => {
  const auth = getAuth()

  let navigate = useNavigate()
  useEffect(()=>{
    if ( auth.currentUser === null){
      navigate("/login", { replace: true });
    }
  })

  const taskCollectionRef = collection(db,'Tasks')
  const q = query(taskCollectionRef,orderBy('title','asc'));

  useEffect(()=>{
    onSnapshot(q,(snapshot)=>{
      const newDades = snapshot.docs.map((v) => {
        return {...v.data(),id:v.id}
      })
      console.log("a",newDades)
      setTasques(newDades)
    })

  },[])

  
  const [tasques, setTasques] = useState([]);
  const [modeEdicio, setModeEdicio] = useState(false);
  const [error, setError] = useState(null);

  const [tasca, setTasca] = useState({
    title: "",
    completion_id: "",
    author_id: "",
  });

  const editar = (item) => {
    setModeEdicio(true);
    setTasca(item);
  };
  const editarTasca = (e) => {
    console.log("edito");
    e.preventDefault();

    setDoc(doc(db,'Tasks',tasca.id),{
      ...tasca,
      time: serverTimestamp()
    })


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

    deleteDoc(doc(db,'Tasks',id))
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

    addDoc(taskCollectionRef,
      {
        ...tasca,
        time:serverTimestamp()
      }
    )

    setTasca({
      id:"",
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
