import React, { useContext, useEffect, useLayoutEffect } from "react";
import { Navigate, useNavigate } from "react-router-dom";
import {  getAuth } from "firebase/auth";
import { UserContext } from "../UserContext";

const Home = () => {
  const auth = getAuth();
  const { setMessage } = useContext(UserContext);
  //Necesitamos un else porque por algun motivo,
  let navigate = useNavigate()
  useEffect(()=>{
    console.log("auuuth",auth.currentUser)
    if ( auth.currentUser === null){
      navigate("/login", { replace: true });
    }
  },[])
  return (
    <>
    <h1 style={{ textAlign: "center", padding: "20px 0px" }}>Home</h1>
    <img
      width={"1500px"}
      height={"700px"}
      src="https://www.filo.news/__export/1560280127814/sites/claro/malditosnerds/img/2019/06/11/h1hld0cgw_1256x620_crop1560280127649.jpg_1902800913.jpg"
      alt="yo"
      ></img>
  </>
);
};

export default Home;
