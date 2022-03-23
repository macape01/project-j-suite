import { useEffect, useState } from "react";
import { nanoid } from "nanoid";
import Messages from "../components/chatapp";
import Message from "../components/chatapp/message";
import Form from "../components/chatapp/form";


const MessageForm = ({
  messagesArray,
  userArray,
  chatArray,
}) => {
  const [mens, setMessage] = useState({
    author_id:"",
    message:"",
    chat_id:""
  });
  const [llistamissatges, setMessagesinArray] = useState([...messagesArray]);
  const [modeEdicio, setModeEdicio] = useState(false);
  const [id, setId] = useState("");
  const [error, setError] = useState(null);

  const forEdit = (item) => {
    setModeEdicio(true);
    setMessage(item.message);
    setId(item.id);
  };

  const getLastId = () => {
    return llistamissatges.length > 0
      ? llistamissatges[llistamissatges.length - 1].id
      : 0;
  };

  const editMessage = (e) => {
    e.preventDefault();

    const arrayModified = llistamissatges.map((v) => {
      return v.id === id ? { id: id, message: mens, chat_id: v.chat_id, author_id: v.author_id, published: v.published} : v;
    });

    console.log(arrayModified);
    setMessagesinArray(arrayModified);
    setId("");
    setMessage("");
    setModeEdicio(false);
    setError(null);
  };

  const delMessage = (id) => {

    const arrayDeleted = llistamissatges.filter((v) => {
      return v.id !== id;
    });
    console.log(arrayDeleted);
    setMessagesinArray(arrayDeleted);
  };

  const putMessage = (e) => {
    e.preventDefault();
/* 
    if (!mens.trim()) {
      setError("Introdueix algun text");
      return;
    } */
    setMessage("");
    setError(null);

    setMessagesinArray([
      ...llistamissatges,
      {
        ...mens,
        id: getLastId() + 1,
        published:new Date().toLocaleDateString('es-EU')
      }
    ]);
  };

  return (
    <div className="container mt-5">
      <h1 className="text-center">CRUD APP</h1>
      <hr />
      <div className="row">
        <div className="col-8">
          <h4 className="text-center">Llista de Missatges</h4>
          <br></br>
          <Messages
            messagesArray={llistamissatges}
            userArray={userArray}
            delMessage={delMessage}
            forEdit={forEdit}
          />
          <br></br>
        </div>

        <div className="col-4">
          <h4 className="text-center">
            {modeEdicio ? "Editar Missatge" : "Afegir Missatge"}
          </h4>
          <Form
            modeEdicio={modeEdicio}
            editMessage={editMessage}
            putMessage={putMessage}
            error={error}
            setMessage={setMessage}
            state={mens}
            userArray={userArray}
            chatArray={chatArray}
          />
        </div>
      </div>
    </div>
  );
};
export default MessageForm;
