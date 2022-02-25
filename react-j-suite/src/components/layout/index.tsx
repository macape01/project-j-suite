import styles from "./styles.module.scss";
import Header from "./header";
import Sidebar from "./sidebar";
const Layout = ({ children }) => {
  return (
    <div className={styles.layout}>
      <Header />
      <Sidebar />
      {children}
    </div>
  );
};
export default Layout;
