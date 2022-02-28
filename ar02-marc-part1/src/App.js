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
        key={contact.id}
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
