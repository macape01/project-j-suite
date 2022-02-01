export async function obtenirDades()  {
 
    let usuarisData,assetsData,ticketsData;
   
    try {
        usuarisData = await fetch('https://project-j-suite-default-rtdb.europe-west1.firebasedatabase.app/usuaris.json')
        usuarisData = await usuarisData.json();
        ticketsData = await fetch('https://project-j-suite-default-rtdb.europe-west1.firebasedatabase.app/tickets.json')
        ticketsData = await ticketsData.json();
        return [usuarisData,ticketsData];
    }
    catch {
 
        console.log("... la hemos")
        return "null"
    }
}