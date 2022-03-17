
const Task = ({id,title,completion,author}) => {
  return (
    <tr>
      <td>{id}</td>
      <td>{title}</td>
      <td>{completion}</td>
      <td>{author}</td>
    </tr>
  );
};
export default Task;
