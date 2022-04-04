import { useAuth } from "../hooks/authv2";
import React, { useState } from "react";

const Login = () => {
  const { login, user } = useAuth({ middleware: "guest" });
  const [username, setUsername] = useState(user ? user : "");
  const handleSubmit = (e) => {
    e.preventDefault();
    login()
  };
  return (
    <form onSubmit={handleSubmit}>
      <label>Username:{username}</label>
      <input
        type="text"
        value={username}
        onChange={(e) => setUsername(e.target.value)}
      ></input>
      <button onClick={login}>Log in</button>
    </form>
  );
};

export default Login;
