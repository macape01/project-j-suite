import styles from "./styles.module.scss";
import { BrowserRouter as Router, Routes, Route, Link } from "react-router-dom";
const Sidebar = () => {
  return (
    <aside className={styles.sidebar}>
      <ul>
        <li>
          <Link to="/">Home</Link>
        </li>
        <li>
          <Link to="/tickets">Tickets</Link>
        </li>
        <li>
          <Link to="/boards">Boards</Link>
        </li>
        <li>
          <Link to="/messages">Messages</Link>
        </li>
      </ul>
    </aside>
  );
};
export default Sidebar;
