import React, { useEffect, useState } from "react";

const Form = ({
  modeEdicio,
  editMessage,
  putMessage,
  error,
  setMessage,
  state,
  changeFilter,
  user,
  chats
}) => {
  const [filteredChats,setFilteredChats] = useState([])
  
  useEffect(()=>{
    console.log("form user",user)
    console.log("form chats",filteredChats)
    console.log("true?",user && user.chats_array && user.chats_array.length>0)
    if ( filteredChats.length>0 ) return
    if ( user && user.chats_array && user.chats_array.length > 0){
      let newChats = chats.filter(c=>user.chats_array.includes(c.cid))
      setFilteredChats(newChats)
    }
    /* if ( filteredChats ) return
    if( user && user.chats_array && user.chats_array.length > 0 && filteredChats.length>0){
    }  
    let newChats = filteredChats.filter(c=>user.chats_array.includes(c.cid)) */
  })
  
  return (
    <form onSubmit={modeEdicio ? editMessage : putMessage}>
      <span className="text-danger">{error} </span>
      <div className="form-group mb-4">
        <label >Busca un message: </label>
        <input 
          className="form-control mb-2"
          onChange={e=>changeFilter(e.target.value)} 
          type={"text"} 
          placeholder="Introdueix el nom d'un message"
          />
      </div>
      <input
        type="text"
        className="form-control mb-2"
        placeholder="Escriu aqui..."
        onChange={(e) => setMessage({ ...state, message: e.target.value })}
        value={state.message}
      />
      <select
        type="text"
        className="form-control mb-2"
        value={state.chat_id}
        onChange={(e) => {
          setMessage({ ...state, chat_id: e.target.value * 1 });
        }}
      >
        {filteredChats && filteredChats.length > 0 ?
          <>
          <option selected hidden>Selecciona un chat</option>
          {filteredChats.map((chat, idx) => {
            console.log("CHAT",chat)
            return (
              <option value={chat.cid} key={idx}>
                {chat.name}
              </option>
            );
          })}
          </>
          :
          <option selected disabled>No perteneces a ningun chat, Cagaste</option> 
        }
      </select>
      {modeEdicio ? (
        <>
          <button className="btn btn-warning btn-block" type="submit">
            Editar
          </button>
        </>
      ) : (
        <>
          <button disabled={!filteredChats} className="btn btn-dark btn-block" type="submit">
            Enviar
          </button>
        </>
      )}
    </form>
  );
};

export default Form;
