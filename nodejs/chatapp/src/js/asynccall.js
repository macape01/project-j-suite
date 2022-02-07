export async function obtenirDades()
{
    let data1,data2,data3;

    try {
        data1 = await fetch('https://project-j-suite-default-rtdb.europe-west1.firebasedatabase.app/usuaris.json')
        data1 = await data1.json();
        data2 = await fetch('https://project-j-suite-default-rtdb.europe-west1.firebasedatabase.app/grups.json')
        data2 = await data2.json();
        data3 = await fetch('https://project-j-suite-default-rtdb.europe-west1.firebasedatabase.app/Messages.json')
        data3 = await data3.json();
        return ([data1, data2, data3]);
    }
    catch {
        console.log("... la hemos")
        return "null"
    }
}