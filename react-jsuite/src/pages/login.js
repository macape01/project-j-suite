import React, { useContext, useEffect, useState } from "react";
import { Navigate } from "react-router-dom";
import { UserContext } from "../UserContext";
import "./login.scss";

const Login = () => {
  const { user, setUser, setMessage } = useContext(UserContext);
  const [username, setUsername] =  useState("");
  const [password, setPassword] =  useState("");
  if (user) {
    setMessage(null)
    return <Navigate to="/" replace />
  }
  const HandleSubmit = (e) => {
    console.log(e);
    e.preventDefault();
    setUser(username)
  };
  return (
    <div className="login-wrapper">
      <div id="login">
        <h3 class="text-center text-black pt-5">Login form</h3>
        <form onSubmit={HandleSubmit} class="container">
          <div
            id="login-row"
            class="row justify-content-center align-items-center"
          >
            <div id="login-column" class="col-md-6">
              <div id="login-box" class="col-md-12">
                  <h3 class="text-center text-info">Login</h3>
                  <div class="form-group">
                    <label for="username" class="text-info">
                      Username:
                    </label>
                    <input
                      type="text"
                      name="username"
                      id="username"
                      class="form-control"
                      onChange={(e) => setUsername(e.target.value)}
                    />
                  </div>
                  <div class="form-group">
                    <label for="password" class="text-info">
                      Password:
                    </label>
                    <input
                      type="text"
                      name="password"
                      id="password"
                      class="form-control"
                      onChange={(e) => setPassword(e.target.value)}
                    />
                  </div>
                  <div class="form-group">
                    <button
                      type="submit"
                      name="submit"
                      class="btn center btn-info btn-md"
                    >
                    Login
                    </button>
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
