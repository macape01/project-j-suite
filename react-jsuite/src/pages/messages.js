import { useEffect, useState } from "react";
import { nanoid } from "nanoid";
import Messages from "../components/chatapp";
import Message from "../components/chatapp/message";
import Form from "../components/chatapp/form";
import {
  collection,
  doc,
  orderBy,
  query,
  where,
  getDocs,
  addDoc,
  serverTimestamp,
  deleteDoc,
  setDoc,
  onSnapshot,
} from "firebase/firestore";
import { db } from "../firebase";
import { getAuth } from "firebase/auth";
import { useNavigate } from "react-router-dom";

const MessageForm = ({ messagesArray, userArray, chatArray }) => {
  const auth = getAuth();
  const [uid, setUid] = useState(null);
  
  let navigate = useNavigate();
  
  const messageCollectionRef = collection(db, "Messages");
  const usersCollectionRef = collection(db, "Users");
  
  const q = query(messageCollectionRef, orderBy("mid", "asc"));
  const q2 = query(usersCollectionRef, orderBy("uid", "asc"));
  
  useEffect(() => {
    if (auth.currentUser === null) {
      navigate("/login", { replace: true });
    } else {
      setUid(auth.currentUser.uid);
    }
    const snapshotMessageRef = onSnapshot(q, (snapshot) => {
      const newDades = snapshot.docs.map((doc) => {
        return { ...doc.data(), id: doc.id };
      });
      console.log("newinfo", newDades);
      setLlistaMissatges(newDades);
      setFilteredMessages(newDades);
    });
    const snapshotUserRef = onSnapshot(q2, (snapshot) => {
      const newDades = snapshot.docs.map((doc) => {
        return { ...doc.data(), id: doc.id };
      });
      console.log("dades", newDades);
      setUsers(newDades);
    });
    return () => {
      snapshotUserRef();
      snapshotMessageRef();
    };
  }, []);

  const [users, setUsers] = useState([]);
  const [llistamissatges, setLlistaMissatges] = useState([]);
  const [filteredMessages, setFilteredMessages] = useState([...llistamissatges]);

  const [message, setMessage] = useState({
    author_id: "",
    message: "",
    chat_id: "",
  });
  const [modeEdicio, setModeEdicio] = useState(false);
  const [error, setError] = useState(null);

  const forEdit = (item) => {
    console.log("cosas de", item);
    setModeEdicio(true);
    setMessage(item);
  };

  const getLastId = () => {
    return llistamissatges.length > 0
      ? llistamissatges[llistamissatges.length - 1].mid * 1 + 1
      : 0;
  };

  const editMessage = (e) => {
    console.log("edito");
    e.preventDefault();

    setDoc(doc(db, "Messages", message.id), {
      ...message,
      published: new Date().toLocaleDateString("es-EU"),
    });

    setMessage({
      author_id: "",
      message: "",
      chat_id: "",
    });
    setModeEdicio(false);
    setError(null);
  };
  const delMessage = (id) => {
    console.log("id", id);
    deleteDoc(doc(db, "Messages", id));
  };

  const putMessage = (e) => {
    e.preventDefault();
    let value = Object.values(message).find((t) => {
      if (t === "" || t === null) return true;
    });
    if (value === "" || value === null) {
      setError("Cagaste");
      return;
    }
    setError(null);

    addDoc(messageCollectionRef, {
      ...message,
      mid: getLastId(),
      published: new Date().toLocaleDateString("es-EU"),
    });

    setMessage({
      author_id: "",
      message: "",
      chat_id: "",
    });
  };

  const changeFilter = (value) =>{
    if ( value === "" ){
      setFilteredMessages([...llistamissatges])
      return
    }
    let newLlistamissatges = llistamissatges.filter(v=>v.message.includes(value))
    console.log("newt",newLlistamissatges)
    console.log("value",value)
    setFilteredMessages([...newLlistamissatges])
  }

  return (
    <div className="container mt-5">
      <h1 className="text-center">CRUD APP</h1>
      <hr />
      <div className="row">
        <div className="col-8">
          <h4 className="text-center">Llista de Missatges</h4>
          <br></br>
          <Messages
            uid={uid}
            messagesArray={filteredMessages}
            userArray={users}
            esborrar={delMessage}
            forEdit={forEdit}
          />
          <br></br>
        </div>

        <div className="col-4">
          <h4 className="text-center">
            {modeEdicio ? "Editar Missatge" : "Afegir Missatge"}
          </h4>
          <Form
            changeFilter={changeFilter}
            uid={uid}
            modeEdicio={modeEdicio}
            editMessage={editMessage}
            putMessage={putMessage}
            error={error}
            setMessage={setMessage}
            state={message}
            userArray={users}
            chatArray={chatArray}
          />
        </div>
      </div>
    </div>
  );
};
export default MessageForm;
