import styles from "./styles.module.scss";
import IconRow from "./iconRow";
const Header = () => {
  return (
    <header className={styles.header}>
      <div className={styles.logo}>LOGO</div>
      <IconRow />
    </header>
  );
};
export default Header;
