
export async function obtenirDades()  {
 
    let boardsData,ticketsData;
   
    try {
        boardsData = await fetch('https://project-j-suite-default-rtdb.europe-west1.firebasedatabase.app/Boards.json')
        boardsData = await boardsData.json();
        ticketsData = await fetch('https://project-j-suite-default-rtdb.europe-west1.firebasedatabase.app/tickets.json')
        ticketsData = await ticketsData.json();
        return [boardsData,ticketsData];
    }
    catch {
 
        console.log("... la hemos")
        return "null"
    }
}