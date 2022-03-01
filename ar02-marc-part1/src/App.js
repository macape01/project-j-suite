import { nanoid } from 'https://cdn.jsdelivr.net/npm/nanoid/nanoid.js'
import logo from './logo.svg';
import './App.css';
import Card from './components/Card';
let contacts = require('./contacts.json');

function App() {
  return (
    <div className="App">
     {contacts.map(contact =>{
       return (
       <Card
        key={nanoid()}
        name={contact.name}
        email={contact.email}
        phone={contact.phone}
        imgUrl={contact.imgURL}
       />)
     })}
    </div>
  );
}

export default App;
