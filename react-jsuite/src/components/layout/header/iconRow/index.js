import styles from "./styles.module.scss";
import { GrLogout } from "react-icons/gr";
import { useContext } from "react";
import { UserContext } from "../../../../UserContext";
const IconRow = ({logout}) => {
  const { setUser } = useContext(UserContext);
  const HandleLogout = ()=>{
    setUser(null)
  }
  return (
    <div className={styles.iconRow}>
      {logout && 
        <div className={styles.iconWrapper}>
          <div className={styles.icon}>
            <GrLogout  size={"30px"} onClick={HandleLogout}/>
          </div>
        </div>
      }
    </div>
  );
};
export default IconRow;
