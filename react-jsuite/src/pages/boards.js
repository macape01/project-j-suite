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
  const [uid,setUid] =  useState(null)
  let navigate = useNavigate()
  useEffect(()=>{
    if ( auth.currentUser === null){
      navigate("/login", { replace: true });
    }else{
      setUid(auth.currentUser.uid)
    }
  })

  const taskCollectionRef = collection(db,'Tasks')

  const usersCollectionRef = collection(db,'Users')

  const q = query(taskCollectionRef,orderBy('title','asc'));

  const q2 = query(usersCollectionRef,orderBy('uid','asc'));


  useEffect(()=>{
    const snapshotTaskRef=onSnapshot(q,(snapshot)=>{
      const newDades = snapshot.docs.map((v) => {
        return {...v.data(),id:v.id}
      })
      console.log("a",newDades)
      setTasques(newDades)
      setFilteredTasks(newDades)

    })
    const snapshotUserRef = onSnapshot(q2,(snapshot)=>{
      const newDades = snapshot.docs.map(doc => {
        return {...doc.data(),id:doc.id}
      })
      console.log("dades",newDades)
      setUsers(newDades)
    })
    return () => {
      snapshotUserRef();
      snapshotTaskRef();
    }
  },[])

  
  const [tasques, setTasques] = useState([]);
  const [filteredTasks, setFilteredTasks] = useState([...tasques]);
  const [modeEdicio, setModeEdicio] = useState(false);
  const [error, setError] = useState(null);
  const [users, setUsers] = useState([]);

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
  const changeFilter = (value) =>{
    debugger
    if ( value === "" ){
      setFilteredTasks([...tasques])
      return
    }
    let newTickets = tasques.filter(v=>v.title.includes(value))
    console.log("newt",newTickets)
    console.log("value",value)
    setFilteredTasks([...newTickets])
  }


  return (
    <div className="container mt-5">
      <h1 className="text-center">CRUD APP</h1>
      <div className="row">
        <div className="col-8">
          <h4 className="text-center">Llista de Tasques</h4>
          <br></br>
          <Tasks
            uid={uid}
            taskArray={filteredTasks}
            userArray={users}
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
            changeFilter={changeFilter}
            editar={editarTasca}
            afegir={afegirTasca}
            error={error}
            setState={setTasca}
            state={tasca}
            userArray={users}
            completionArray={completionArray}
          />
        </div>
      </div>
    </div>
  );
};
export default TaskForm;
