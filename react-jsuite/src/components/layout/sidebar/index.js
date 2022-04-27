import styles from "./styles.module.scss";
import { BrowserRouter as Router, Routes, Route, Link } from "react-router-dom";
import { useContext } from "react";
import { UserContext } from "../../../UserContext";
import { getAuth } from "firebase/auth";
const Sidebar = ({right}) => {
  const auth = getAuth()
  const {setMessage } = useContext(UserContext);
  return (
    <aside className={right ? styles.sidebarRight : styles.sidebar}>
      <ul>
        <li>
          <Link to="/">Home</Link>
        </li>
        {!auth.currentUser && (
          <li>
            <Link to="/login">Login</Link>
          </li>
        )}
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