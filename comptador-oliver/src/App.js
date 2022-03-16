import "./App.css";
import React, { useState } from "react";

function App() {
  const [cont, setContador] = useState(0);
  const incrementarComptador = (x) => {
    x.preventDefault();
    setContador(cont + 1);
  };
  const decrementarComptador = (x) => {
    x.preventDefault();
    setContador(cont - 1);
  };
  const resetComptador = (x) => {
    x.preventDefault();
    setContador(cont = 0);
  };
  return (
    <div className="App">
      <form>
        <h1>{cont}</h1>
        <div className="Incr">
          <button onClick={(x) => incrementarComptador(x)}>Incrementar</button>
          <button onClick={(x) => decrementarComptador(x)}>Decrementar</button>
        </div>
        <div className="Reset">
          <button onClick={(x) => resetComptador(x)}>Reset</button>
        </div>
      </form>
    </div>
  );
}

export default App;
