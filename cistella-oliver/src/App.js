import React, { useState } from "react";
import ListProducts from "./ListOfProducts";
import './App.css';

function App() {
  const [prods, setProductes] = useState([]);
  const [state, setState] = useState({});
  const submit = (x, fn) => {
    x.preventDefault();
    setProductes([...prods, state]);
  };
  const addProducts = (x) => {
    setState({ ...state, prodname: x.target.value });
  };
  return (
    <div className="App">
      <form onSubmit={submit}>
        <div className="Product">
          <label>Producte nou</label>
          <input onChange={addProducts} />
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
