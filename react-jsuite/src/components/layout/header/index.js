import styles from "./styles.module.scss";
import IconRow from "./iconRow";
import { UserContext } from "../../../UserContext";
import { useContext } from "react";
import { getAuth } from "firebase/auth";
const Header = () => {
  const auth = getAuth();
  const state = useContext(UserContext)
  const {message} = state;
  console.log(auth.currentUser)
  return (
    <header className={styles.header}>
      <div className={styles.logo}>LOGO</div>
      {auth.currentUser && auth.currentUser.email && <h2 className="text-success">Autenticat com a usuari: <span className="text-primary">{auth.currentUser.email}</span></h2>}
      {message && <div className="alert alert-danger">{message}</div>}
      <IconRow logout={auth.currentUser ? true : false} />
    </header>
  );
};
export default Header;
