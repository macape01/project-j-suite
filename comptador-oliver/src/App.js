import "./App.css";
import React, { useState } from "react";

function App() {
  const [cont, setContador] = useState(0);
  const customHook = (x, numactual) => {
    x.preventDefault();
    setContador(numactual);
  };
  const incrementarComptador = (x) => {
    x.preventDefault();
    setContador(cont + 1);
  };
  return (
    <div className="App">
      <form>
        <h1>{cont}</h1>
        <div className="Incr">
          <button onClick={(x) => incrementarComptador(x)}>Incrementar</button>
          <button onClick={(x) => customHook(x, cont - 1)}>Decrementar</button>
        </div>
        <div className="Reset">
          <button onClick={(x) => customHook(x, 0)}>Reset</button>
        </div>
      </form>
    </div>
  );
}

export default App;
