import styles from "./styles.module.scss";
import IconRow from "./iconRow";
import { UserContext } from "../../../UserContext";
import { useContext } from "react";
const Header = () => {
  const state = useContext(UserContext)
  const {user, message} = state;
  return (
    <header className={styles.header}>
      <div className={styles.logo}>LOGO</div>
      {user && <h2 className="text-success">Autenticat com a usuari: <span className="text-primary">{user}</span></h2>}
      {message && <div className="alert alert-danger">{message}</div>}
      <IconRow logout={user ? true : false} />
    </header>
  );
};
export default Header;
