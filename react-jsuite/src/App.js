import "./App.css";
import Tasks from "./components/boards";
import Messages from "./components/chatapp";
import Layout from "./components/layout";
import Tickets from "./components/tickets";
import { BrowserRouter as Router, Routes, Route, Link } from "react-router-dom";
import BoardPage from "./pages/boards";
import Home from "./pages/home";
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
const chatsArray = require("./data/chats.json");

function App() {
  return (
    <Router>
      <Layout className="App">
        <Routes>
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
              <Tickets
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
              <Tasks
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
              <Messages messagesArray={messagesArray} userArray={userArray} />
            }
          ></Route>
        </Routes>
      </Layout>
    </Router>
  );
}

export default App;
