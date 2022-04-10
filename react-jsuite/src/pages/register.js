import { useContext, useEffect, useState } from "react";
import { Link, Navigate, useNavigate } from "react-router-dom";
import { UserContext } from "../UserContext";
import {  getAuth, createUserWithEmailAndPassword, updateProfile } from "firebase/auth";
import "./register.scss";
import { addDoc, collection } from "firebase/firestore";
import { db } from "../firebase";

const Register = () => {
  const auth = getAuth();
  const { setMessage } = useContext(UserContext);
  const [username, setUsername] =  useState("");
  const [password, setPassword] =  useState("");
  const [email, setEmail] =  useState("");
  let navigate = useNavigate()

  const usersCollectionRef = collection(db,'Users')


  const HandleSubmit = (e) => {
    console.log(e);
    e.preventDefault();

    createUserWithEmailAndPassword(auth, email, password)
    .then((res) => {
      const user = auth.currentUser;
      console.log("profile Updated",user)
      updateProfile(user,{
        displayName: username
      })
      .then(()=>{
        addDoc(usersCollectionRef,
          {
            name:username,
            password: password,
            email:email,
            uid:user.uid
          }
        )
        navigate("/",{replace:true})
        console.log("profile Updated",auth.currentUser)
      })
      .catch(e=>{
        console.log("Something went wrong",e)
      })
    })
    .catch((error) => {
      const errorCode = error.code;
      const errorMessage = error.message;
      alert(errorMessage);

      // ..
    });

  };

  return (
    <div className="register-wrapper">
      <div id="register">
        <h3 class="text-center text-black pt-5">Register form</h3>
        <form onSubmit={HandleSubmit} class="container">
          <div
            id="login-row"
            class="row justify-content-center align-items-center"
          >
            <div id="login-column" class="col-md-6">
              <div id="login-box" class="col-md-12">
                  <h3 class="text-center text-info">Register</h3>
                  <div class="form-group">
                    <label for="username" class="text-info">
                      Username:
                    </label>
                    <input
                      required
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
                      required
                      type="password"
                      name="password"
                      id="password"
                      class="form-control"
                      onChange={(e) => setPassword(e.target.value)}
                    />
                    <label for="email" class="text-info">
                      Email:
                    </label>
                    <input
                      required
                      type="email"
                      name="email"
                      id="email"
                      class="form-control"
                      onChange={(e) => setEmail(e.target.value)}
                    />
                    <button
                      type="submit"
                      name="submit"
                      class="btn register-button center btn-info btn-md"
                    >
                    Register
                    </button>
                    <div class="form-group">
                      <label>
                        Already have an account? 
                      </label>
                      <p>
                        <Link to={"/login"}>Login here:</Link>
                      </p>
                    </div>
                  </div>
                  
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  );
};
  
  export default Register;