import { RenderedTicketProps } from "../../../interfaces/renderedTicket";
import styles from "./styles.module.scss";

const Ticket = ({
  ticket,
  description,
  id,
  tid,
  title,
  asset,
  assigned,
  esborrarTasca,
  editar,
  status,
  comments,
}) => {
  console.log("coomments", comments.length);
  console.log("coommentsfasfass", comments);
  return (
    <tr className={styles.ticket}>
      <input type={"hidden"} value={id}></input>
      <td>{tid}</td>
      <td>{title}</td>
      <td>{description}</td>
      <td>{asset}</td>
      <td>{assigned}</td>
      <td>{status}</td>
      <td>
        {comments.length > 0 ? (
          <select className="form-control mb-2">
            <option hidden selected>
              Comments
            </option>
            ;
            {comments.map((comment, idx) => {
              return (
                <option disabled value={comment.id} key={idx}>
                  {comment.msg}
                </option>
              );
            })}
          </select>
        ) : (
          <p style={{ textAlign: "center", width: "100%", height: "100%" }}>
            ---
          </p>
        )}
      </td>
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
          onClick={() => editar(ticket, comments)}
        >
          Editar
        </button>
      </td>
    </tr>
  );
};
export default Ticket;
