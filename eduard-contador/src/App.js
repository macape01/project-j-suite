import logo from './logo.svg';
import './App.css';
import {useState} from 'react';

function App() {
  const [contador,setContador]=useState(0)
  return (
    <div className="App">
      <form>
        <h1>{contador}</h1>
        <button onClick={(e) => {
          e.preventDefault()
          setContador(contador+1)}
          }>
          Incrementar
        </button>


        <button onClick={(e) => {
          e.preventDefault()
          setContador(contador-1)}
          }>
          Decrementar
        </button>

        <button onClick={(e) => {
          e.preventDefault()
          setContador(0)}
          }>
          Reset
          </button>
      </form>
    </div>
  );
}

export default App;
