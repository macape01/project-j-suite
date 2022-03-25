import { useState } from "react";
import Message from "./message";
import styles from "./styles.module.scss";

const Messages = ({messagesArray,userArray}) => {
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
        </tr>
      {
        messagesArray.map(({id,message,chat_id,author_id,published})=>{
          let user = userArray.find(user=>user.id === author_id);
          return (
            <Message
              id={id}
              message={message}
              chatId={chat_id}
              author={user.username}
              published={published}
            />
          );
        })
      }
      </tbody>
    </table>
  );
};
export default Messages;