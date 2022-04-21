import { useState } from "react";
import Message from "./message";
import styles from "./styles.module.scss";

const Messages = ({ uid, messagesArray, userArray, esborrar, forEdit }) => {
  console.log(messagesArray);

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
        {messagesArray
          .filter(m=>m.author_id === uid)
          .map((mens) => {
          console.log("mens", mens);
          let user = userArray.find((user) => user.uid === mens.author_id);
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