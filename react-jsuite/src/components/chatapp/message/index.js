const Message = ({id,message,chatId,author,published}) => {
  return (
    <tr>
      <td>{id}</td>
      <td>{message}</td>
      <td>{chatId}</td>
      <td>{author}</td>
      <td>{published}</td>
    </tr>
  );
};
export default Message;
