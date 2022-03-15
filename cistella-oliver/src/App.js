import React, { useState } from "react";
import ListProducts from "./ListOfProducts";
import './App.css';

function App() {
  const [prods, setProductes] = useState([]);
  const [state, setState] = useState({});
  const handleSubmit = (x, fn) => {
    x.preventDefault();
    setProductes([...prods, state]);
  };
  const handleNameChange = (x) => {
    setState({ ...state, name: x.target.value });
  };
  const handleColorChange = (y) => {
    setState({ ...state, color: y.target.value });
  };
  return (
    <div className="App">
      <form onSubmit={handleSubmit}>
        <div className="Product">
          <label>Nom del producte</label>
          <input onChange={handleNameChange} />
          <label>Color del producte</label>
          <input onChange={handleColorChange} />
        </div>
        <div className="Send">
        <button type="submit">Afegir producte</button>
        </div>
        <div className="ListProducts">
          <ListProducts prods={prods} />
        </div>
      </form>
    </div>
  );
}
export default App;
