import React, { useState } from "react";

function App() {
  const [contador, setContador] = useState(0);
  const customHook = (e, operation) => {
    e.preventDefault();
    setContador(operation);
  };
  return (
    <div className="App">
      <form>
        <h1>{contador}</h1>
        <button onClick={(e) => customHook(e, contador + 1)}>
          Incrementar
        </button>
        <button onClick={(e) => customHook(e, contador - 1)}>
          Decrementar
        </button>
        <button onClick={(e) => customHook(e, 0)}>Reset</button>
      </form>
    </div>
  );
}

export default App;
