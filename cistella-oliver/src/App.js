import React, { useState } from "react";
import ListProducts from "./ListOfProducts";
import './App.css';

function App() {
  const [prods, setProductes] = useState([]);
  const [prodname, setName] = useState("");
  const submit = (x) => {
    x.preventDefault();
    setProductes([...prods, {
      prodname
    }]);
  };
  return (
    <div className="App">
      <form onSubmit={submit}>
        <div className="Product">
          <label>Producte nou</label>
          <input onChange={e=>setName(e.target.value)} />
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
