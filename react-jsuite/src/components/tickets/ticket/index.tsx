import { RenderedTicketProps } from "../../../interfaces/renderedTicket";
import styles from "./styles.module.scss";

const Ticket = ({description,id,title,asset,assigned}:RenderedTicketProps) => {
  return (
    <tr className={styles.ticket}>
      <td>{id}</td>
      <td>{title}</td>
      <td>{description}</td>
      <td>{asset}</td>
      <td>{assigned}</td>
    </tr>
  );
};
export default Ticket;
