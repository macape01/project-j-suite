import { RenderedTicketProps } from "../../../interfaces/renderedTicket";
import styles from "./styles.module.scss";

const Ticket = ({
  ticket,
  description,
  id,
  title,
  asset,
  assigned,
  esborrarTasca,
  editar,
}) => {
  return (
    <tr className={styles.ticket}>
      <td>{id}</td>
      <td>{title}</td>
      <td>{description}</td>
      <td>{asset}</td>
      <td>{assigned}</td>
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
          onClick={() => editar(ticket)}
        >
          Editar
        </button>
      </td>
    </tr>
  );
};
export default Ticket;
