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
          <label>AÑADE UN NUEVO PRODUCTO A LA LISTA</label>
          <input onChange={addProducts} />
        <button className="añadir" type="submit">AÑADIR</button>
        </div>
        <div className="Send">
        </div>
        <div className="ListProducts">
          <ListProducts prods={prods} />
        </div>
      </form>
    </div>
  );
}
export default App;
