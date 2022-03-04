import styles from "./styles.module.scss";
import Header from "./header";
import Sidebar from "./sidebar";
const Layout = ({ children }:any) => {
  return (
    <div className={styles.layout}>
      <Header />
      <div className={styles.content}>
        <Sidebar />
        {children}
      </div>
    </div>
  );
};
export default Layout;
