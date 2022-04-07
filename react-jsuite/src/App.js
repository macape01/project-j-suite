import { getAuth, onAuthStateChanged } from "firebase/auth";
import "./App.css";
import Tasks from "./components/boards";
import Messages from "./components/chatapp";
import Layout from "./components/layout";
import Tickets from "./components/tickets";
import { BrowserRouter as Router, Routes, Route, Link, Navigate } from "react-router-dom";
import BoardPage from "./pages/boards";
import Home from "./pages/home";
import TicketForm from "./pages/tickets";
import TaskForm from "./pages/boards";
import MessageForm from "./pages/messages";
import Login from "./pages/login";
import { UserContext } from "./UserContext";
import { useEffect, useState } from "react";
import NotFound from "./pages/notfound";
import Register from "./pages/register";

const assetArray = require("./data/assets.json");
const userArray = require("./data/users.json");
const ticketArray = require("./data/tickets.json");
const taskArray = require("./data/tasks.json");
const commentArray = require("./data/comments.json");
const noteArray = require("./data/notes.json");
const statusesArray = require("./data/statuses.json");
const completionArray = require("./data/completion.json");
const messagesArray = require("./data/messages.json");
const userchatsArray = require("./data/user_chats.json");
const chatArray = require("./data/chats.json");

function App() {

  const auth = getAuth();
  const [message, setMessage] = useState(null);
  useEffect(()=>{
    const authStateChange = onAuthStateChanged(auth, (user) => {
      if (user) {
        // User is signed in, see docs for a list of available properties
        // https://firebase.google.com/docs/reference/js/firebase.User
        const uid = user.uid;
        console.log("Logged in")
        setMessage("Logged In")

      } else {
        console.log("Logged out")
        setMessage("Not Logged")
      }
    });
    return () => authStateChange()
  },[])

  return (
    <Router>
      <UserContext.Provider value={{ message, setMessage}}>
        <Layout className="App">
          <Routes>
            <Route exact path="/login" element={<Login />}></Route>
            <Route exact path="/register" element={<Register />}></Route>
            <Route
              exact
              path="/"
              element={
                <Home
                  commentArray={commentArray}
                  statusArray={statusesArray}
                  assetArray={assetArray}
                  userArray={userArray}
                  ticketArray={ticketArray}
                />
              }
            ></Route>
            <Route
              exact
              path="/tickets"
              element={
                <TicketForm
                  commentArray={commentArray}
                  statusArray={statusesArray}
                  assetArray={assetArray}
                  userArray={userArray}
                  ticketArray={ticketArray}
                />
              }
            ></Route>
            <Route
              exact
              path="/boards"
              element={
                <TaskForm
                  noteArray={noteArray}
                  completionArray={completionArray}
                  userArray={userArray}
                  taskArray={taskArray}
                />
              }
            ></Route>
            <Route
              exact
              path="/messages"
              element={
                <MessageForm
                  messagesArray={messagesArray}
                  userArray={userArray}
                  chatArray={chatArray}
                />
              }
            ></Route>
            <Route path="*" element={<NotFound />}></Route>
          </Routes>
        </Layout>
      </UserContext.Provider>
    </Router>
  );
}

export default App;
