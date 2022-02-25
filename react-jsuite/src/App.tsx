import "./App.css";
import Task from "./components/boards/task";
import Message from "./components/chatapp/message";
import Layout from "./components/layout";

import Ticket from "./components/tickets/ticket";

function App() {
  return (
    <div className="App">
      <Layout>
        <h1>Hello World</h1>
        <Ticket />
        <Task />
        <Message />
      </Layout>
    </div>
  );
}

export default App;

