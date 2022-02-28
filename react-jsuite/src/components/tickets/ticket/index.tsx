import { TicketProps } from "../../../interfaces/ticket";
import styles from "./styles.module.scss";

const Ticket = (props:TicketProps) => {
  return (
    <div className={styles.ticket}>
      <p>This is a Ticket</p>
    </div>
  );
};
export default Ticket;
