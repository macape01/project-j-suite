import "./App.css";
import Task from "./components/boards/task";
import Message from "./components/chatapp/message";
import Layout from "./components/layout";
import Tickets from "./components/tickets";
const assetArray = require('./assets.json')
const userArray = require('./users.json')
const ticketArray = require('./tickets.json')


function App() {
  return (
    <div className="App">
      <Layout>
        <h1>Hello World</h1>
        <Tickets assetArray={assetArray} userArray={userArray} ticketArray={ticketArray} />
        <Task />
        <Message />
      </Layout>
    </div>
  );
}

export default App;

