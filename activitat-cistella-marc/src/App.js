import React, { useState } from "react";
import LlistaProductes from "./LlistaProductes";

function App() {
  const [productes, setProductes] = useState([]);
  const [state, setState] = useState({});
  const handleSubmit = (e, fn) => {
    e.preventDefault();
    setProductes([...productes, state]);
  };
  const handleNameChange = (e) => {
    setState({ ...state, name: e.target.value });
  };
  const handleColorChange = (e) => {
    setState({ ...state, color: e.target.value });
  };
  return (
    <div className="App">
      <form onSubmit={handleSubmit}>
        <label>Nom producte</label>
        <input onChange={handleNameChange} />
        <label>Color producte</label>
        <input onChange={handleColorChange} />
        <button type="submit">Afegir producte</button>
        <LlistaProductes productes={productes} />
      </form>
    </div>
  );
}
export default App;
