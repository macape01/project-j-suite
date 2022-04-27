import Tasks from "..";


const Task = ({id,title,completion,author,ticket,esborrarTasca,editar,task}) => {
  console.log("sisoy elticket que buscas",ticket);
  return (
    <tr>
      <td>{id}</td>
      <td>{title}</td>
      <td>{completion}</td>
      <td>{author}</td>
      <td>{ticket}</td>
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
