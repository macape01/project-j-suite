import { useState } from "react";
import Message from "./message";
import styles from "./styles.module.scss";

const Messages = ({messagesArray,userArray,esborrar,forEdit}) => {
  console.log(messagesArray)

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
      {
        messagesArray.map((mens)=>{
          let user = userArray.find(user=>user.id === mens.author_id);
          return (
            <Message
              id={mens.id}
              forEdit={forEdit}
              delMessage={esborrar}
              message={mens.message}
              chatId={mens.chat_id}
              author={user.username}
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