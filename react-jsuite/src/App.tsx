import "./App.css";
import Task from "./components/boards/task";
import Message from "./components/chatapp/message";
import Layout from "./components/layout";
import Tickets from "./components/tickets";
const assetArray = require('./data/assets.json')
const userArray = require('./data/users.json')
const ticketArray = require('./data/tickets.json')
const commentArray = require('./data/comments.json')
const statusesArray = require('./data/statuses.json')


function App() {
  return (
    <div className="App">
      <Layout>
        <Tickets commentArray={commentArray} statusArray={statusesArray} assetArray={assetArray} userArray={userArray} ticketArray={ticketArray} />
        <Task />
        <Message />
      </Layout>
    </div>
  );
}

export default App;

