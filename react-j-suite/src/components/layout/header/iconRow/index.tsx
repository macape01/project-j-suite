import styles from "./styles.module.scss";
import { FaBeer } from "react-icons/fa";
const IconRow = () => {
  return (
    <div className={styles.iconRow}>
      <FaBeer />
      <FaBeer />
      <FaBeer />
    </div>
  );
};
export default IconRow;
