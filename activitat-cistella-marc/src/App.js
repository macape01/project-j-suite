import React, { useState } from "react";
import LlistaProductes from "./LlistaProductes";

function App() {
  const [productes, setProductes] = useState([]);
  const [nom, setNom] = useState("");
  const [color, setColor] = useState("");
  const handleSubmit = (e) => {
    e.preventDefault();
    setProductes([...productes, {
      nom,
      color
    }]);
  };
  return (
    <div className="App">
      <form onSubmit={handleSubmit}>
        <label>Nom producte</label>
        <input onChange={e=>setNom(e.target.value)} />
        <label>Color producte</label>
        <input onChange={e=>setColor(e.target.value)} />
        <button type="submit">Afegir producte</button>
        <LlistaProductes productes={productes} />
      </form>
    </div>
  );
}
export default App;
