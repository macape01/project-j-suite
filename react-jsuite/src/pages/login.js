import { getAuth, signInWithEmailAndPassword } from "firebase/auth";
import React, { useContext, useEffect, useState } from "react";
import { Link, Navigate, useNavigate } from "react-router-dom";
import { UserContext } from "../UserContext";
import "./login.scss";

const Login = () => {
  const {setMessage} = useContext(UserContext);
  const auth = getAuth();
  const [password, setPassword] =  useState("");
  const [email, setEmail] =  useState("");
  let navigate = useNavigate()
  

  const HandleSubmit = (e) => {
    console.log(e);
    e.preventDefault();
    signInWithEmailAndPassword(auth, email, password)
    .then((userCredential) => {
        // Signed in
        const user = userCredential.user;
        console.log("USER SIGNED IN",user)
        // ...
        navigate("/",{replace:true})
      })
      .catch((error) => {
        const errorCode = error.code;
        const errorMessage = error.message;
        console.log("error",errorMessage)
        setMessage("La validació ha fallat")

      });
  };
  return (
    <div className="login-wrapper">
      <div id="login">
        <h3 className="text-center text-black pt-5">Login form</h3>
        <form onSubmit={HandleSubmit} className="container">
          <div
            id="login-row"
            className="row justify-content-center align-items-center"
          >
            <div id="login-column" className="col-md-6">
              <div id="login-box" className="col-md-12">
                  <h3 className="text-center text-info">Login</h3>
                  <div className="form-group">
                    <label for="email" className="text-info">
                      Email:
                    </label>
                    <input
                      required
                      type="email"
                      name="email"
                      id="email"
                      className="form-control"
                      onChange={(e) => setEmail(e.target.value)}
                    />
                  </div>
                  <div className="form-group">
                    <label for="password" className="text-info">
                      Password:
                    </label>
                    <input
                      required
                      type="text"
                      name="password"
                      id="password"
                      className="form-control"
                      onChange={(e) => setPassword(e.target.value)}
                    />
                  </div>
                  <div className="form-group">
                    <button
                      type="submit"
                      name="submit"
                      className="btn center btn-info btn-md"
                    >
                    Login
                    </button>
                  </div>
                  <div className="form-group">
                    <label>
                      Doesn't have an account? 
                    </label>
                    <p>
                      <Link to={"/register"}>Register here:</Link>
                    </p>
                  </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  );
};

export default Login;
