import Tasks from "..";

const Task = ({id,title,completion,author,esborrarTasca,editar,task}) => {
  return (
    <tr>
      <td>{id}</td>
      <td>{title}</td>
      <td>{completion}</td>
      <td>{author}</td>
      <td>
        <button
          className="btn btn-sm btn-danger float-right mx-2"
          onClick={() => esborrarTasca(id)}
        >
          Eliminar
        </button>
      </td>
      <td>
        <button
          className="btn btn-sm btn-warning float-right"
          onClick={() => editar(task)}
        >
          Editar
        </button>
      </td>
    </tr> 
  );
};
export default Task;
