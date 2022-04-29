import { useState } from "react";
import Message from "./message";
import styles from "./styles.module.scss";

const Messages = ({ uid, messagesArray, userArray, esborrar, forEdit, user }) => {
  console.log("MESSAGES",messagesArray);
  console.log("USSER",user)
  return (
    <table className={`table table-bordered table-striped ${styles.messages}`}>
      <tbody>
        <tr>
          <th>Id</th>
          <th>Message</th>
          <th>Chat_id</th>
          <th>Author</th>
          <th>Published</th>
          <th>Editar</th>
          <th>Borrar</th>
        </tr>
        {/* Como un usuario solo deberia poder enviar mensajes a los chats a los cuales pertenece, siempre se comprueba si el mensaje pertenece al array de chats*/}
        {messagesArray
          .filter(m=> user && user.chats_array && user.chats_array.includes(m.chat_id))
          .map((mens) => {
          return (
            <Message
              mid={mens.mid}
              id={mens.id}
              forEdit={forEdit}
              delMessage={esborrar}
              message={mens.message}
              chatId={mens.chat_id}
              author={user.name}
              messageObject={mens}
              published={mens.published}
            />
          );
        })
      }
      </tbody>
    </table>
  );
};
export default Messages;