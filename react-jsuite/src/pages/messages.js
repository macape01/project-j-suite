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
  const [message, setMessage] = useState({
    author_id:"",
    message:"",
    chat_id:""
  });
  const [llistamissatges, setLlistaMissatges] = useState([...messagesArray]);
  const [modeEdicio, setModeEdicio] = useState(false);
  const [id, setId] = useState("");
  const [error, setError] = useState(null);

  const forEdit = (item) => {
    console.log("cosas de",item)
    setModeEdicio(true);
    setMessage(item);
    setId(item.id);
  };

  const getLastId = () => {
    return llistamissatges.length > 0
      ? llistamissatges[llistamissatges.length - 1].id
      : 0;
  };

  const editMessage = (e) => {
    console.log("edito");
    e.preventDefault();
    let arrayEditat = [...llistamissatges];
    llistamissatges.forEach((t, idx) => {
      if (t.id === message.id) {
        arrayEditat[idx] = message;
      }
    });

    setLlistaMissatges(arrayEditat);
    setId(false);
    setMessage({
      user_id: "",
      message: "",
      chat_id: ""
    });
    setModeEdicio(false);
    setError(null);
  };
  const delMessage = (id) => {

    const arrayDeleted = llistamissatges.filter((v) => {
      return v.id !== id;
    });
    console.log(arrayDeleted);
    setLlistaMissatges(arrayDeleted);
  };

  const putMessage = (e) => {
    e.preventDefault();
    let value = Object.values(message).find((t) => {
      if (t === "" || t === null) return true;
    });

    if (value !== undefined) {
      setError("Cagaste");
      return;
    }
    setError(null);

    setLlistaMissatges([
      ...llistamissatges,
      {
        ...message,
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
            modeEdicio={modeEdicio}
            editMessage={editMessage}
            putMessage={putMessage}
            error={error}
            setMessage={setMessage}
            state={message}
            userArray={userArray}
            chatArray={chatArray}
          />
        </div>
      </div>
    </div>
  );
};
export default MessageForm;
