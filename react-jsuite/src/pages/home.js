import React, { useContext } from "react";
import { Navigate } from "react-router-dom";
import { UserContext } from "../UserContext";

const Home = () => {
  const { user, setUser, setMessage } = useContext(UserContext);
  console.log(user);
  //Necesitamos un else porque por algun motivo,
  if (!user) {
    setMessage(
      "No pots accedir a les rutes protegides, no estàs autenticat..."
    );
    return <Navigate to="/login" replace />
  }
  return (
    <>
      <h1 style={{ textAlign: "center", padding: "20px 0px" }}>Home</h1>
      <img
        style={{ marginLeft: "150px" }}
        width={"1500px"}
        height={"600px"}
        src="https://www.filo.news/__export/1560280127814/sites/claro/malditosnerds/img/2019/06/11/h1hld0cgw_1256x620_crop1560280127649.jpg_1902800913.jpg"
        alt="yo"
      ></img>
    </>
  );
};

export default Home;
