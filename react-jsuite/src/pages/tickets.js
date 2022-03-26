import React, { useEffect } from "react";
import { useState } from "react";
import { nanoid } from "nanoid";
import Tickets from "../components/tickets";
import Ticket from "../components/tickets/ticket";
import "./tickets.scss";
import Form from "../components/tickets/form";
import {db} from '../firebase'
import { collection, doc, orderBy, query, where, getDocs, addDoc, serverTimestamp, deleteDoc, setDoc, onSnapshot} from "firebase/firestore"

const TicketForm = ({
  ticketArray,
  assetArray,
  userArray,
  commentArray,
  statusArray,
}) => {
  const ticketCollectionRef = collection(db,'Tickets')
  
  const q = query(ticketCollectionRef,orderBy('id','desc'));

  useEffect(()=>{
    onSnapshot(q,(snapshot)=>{
      const newDades = snapshot.docs.map(doc => {
        return {...doc.data(),id:doc.id}
      })
      setTickets(newDades)
    })

  },[])

  const [newCommentArray, setCommentArray] = useState([...commentArray]);

  const [ticket, setTicket] = useState({
    title: "",
    description: "",
    asset_id: "",
    assigned_id: "",
    status_id: "",
    comments: [],
  });
  const [tickets, setTickets] = useState([...ticketArray]);
  const [modeEdicio, setModeEdicio] = useState(false);
  const [id, setId] = useState("");
  const [error, setError] = useState(null);

  const getLastId = () => {
    return tickets.length > 0 ? tickets[tickets.length - 1].id : 0;
  };

  const editar = (item) => {
    let comments = newCommentArray.filter((c) => c.ticket_id === item.id * 1);
    setModeEdicio(true);
    setTicket({ ...item, comments });
    setId(item.id);
  };

  const editarTasca = (e) => {
    console.log("edito");
    e.preventDefault();
    let arrayEditat = [...tickets];
    tickets.forEach((t, idx) => {
      if (t.id === ticket.id) {
        arrayEditat[idx] = ticket;
      }
    });

    setDoc(doc(db,'Tickets',ticket.id),{
      ...ticket,
      time: serverTimestamp()
    })

    setTickets(arrayEditat);
    setId(false);
    setTicket({
      title: "",
      description: "",
      asset_id: "",
      assigned_id: "",
      status_id: "",
    });
    setModeEdicio(false);
    setError(null);
  };
  const esborrarTasca = (id) => {
    const arrayFiltrat = tickets.filter((v) => {
      return v.id !== id;
    });

    setTickets(arrayFiltrat);

    deleteDoc(doc(db,'Tickets',id))
  };

  const afegirTasca = (e) => {
    e.preventDefault();
    let value = Object.values(ticket).find((t) => {
      if (t === "" || t === null) return true;
    });

    if (value !== undefined) {
      setError("Cagaste");
      return;
    }
    setError(null);

    setTickets([
      ...tickets,
      {
        ...ticket,
        id: getLastId() + 1,
      },
    ]);

    addDoc(ticketCollectionRef,
      {
        ...ticket,
        time:serverTimestamp(),
        id:getLastId()+1
      }
    )

    setTicket({
      title: "",
      description: "",
      asset_id: "",
      assigned_id: "",
      status_id: "",
    });
  };


  return (
    <div className="container mt-5">
      <h1 className="text-center">CRUD APP</h1>
      <hr />
      <div className="row">
        <div className="col-8">
          <h4 className="text-center">Llista de Tickets</h4>
          <br></br>
          <Tickets
            commentArray={newCommentArray}
            ticketArray={tickets}
            assetArray={assetArray}
            userArray={userArray}
            statusArray={statusArray}
            esborrarTasca={esborrarTasca}
            editar={editar}
          />
          <br></br>
        </div>

        <div className="col-4">
          <h4 className="text-center">
            {modeEdicio ? "Editar Tasca" : "Afegir Tasca"}
          </h4>
          <Form
            setCommentArray={setCommentArray}
            modeEdicio={modeEdicio}
            editar={editarTasca}
            afegir={afegirTasca}
            error={error}
            setState={setTicket}
            state={ticket}
            userArray={userArray}
            assetArray={assetArray}
            statusArray={statusArray}
            commentArray={newCommentArray}
          />
        </div>
      </div>
    </div>
  );
};
export default TicketForm;
