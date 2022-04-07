import styles from "./styles.module.scss";
import { GrLogout } from "react-icons/gr";
import { getAuth, signOut } from "firebase/auth";
import { useContext } from "react";
import { UserContext } from "../../../../UserContext";
const IconRow = ({logout}) => {
  const { setMessage } = useContext(UserContext);

  const auth = getAuth();
  const HandleLogout = ()=>{
    signOut(auth).then(() => {
      // Sign-out successful.
    }).catch((error) => {
      // An error happened.
    });
  }
  return (
    <div className={styles.iconRow}>
      {logout && 
        <div className={styles.iconWrapper}>
          <div className={styles.icon}>
            <GrLogout size={"30px"} onClick={HandleLogout}/>
          </div>
        </div>
      }
    </div>
  );
};
export default IconRow;
