import styles from "./styles.module.scss";
import IconRow from "./iconRow";
import { UserContext } from "../../../UserContext";
import { useContext } from "react";
const Header = () => {
  const state = useContext(UserContext)
  const {user, setUser} = state;
  return (
    <header className={styles.header}>
      <div className={styles.logo}>LOGO</div>
      <p>{user}</p>
      <IconRow />
    </header>
  );
};
export default Header;
