const Message = ({mid,id,message,chatId,author,published,delMessage,forEdit,messageObject}) => {
  return (
    <tr>
      <td>{mid}</td>
      <td>{message}</td>
      <td>{chatId}</td>
      <td>{author}</td>
      <td>{published}</td>
      <td>
        <button
          className="btn btn-sm btn-danger float-right mx-2"
          onClick={() => delMessage(id)}
        >
          Eliminar
        </button>
      </td>
      <td>
        <button
          className="btn btn-sm btn-warning float-right"
          onClick={() => forEdit(messageObject)}
        >
          Editar
        </button>
      </td>
    </tr>
  );
};
export default Message;
