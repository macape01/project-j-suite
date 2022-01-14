export class AssetsList {


    assets;

    constructor() {

        this.assets = this.obtenirDades();
        //this.obtenirDades().then ((data) =>  { this.assets=data; console.log(data) } );

    }
    obtenirDades()
    {

        /* let data1 = await fetch('https://biblioteca-9f853-default-rtdb.europe-west1.firebasedatabase.app/assets.json')
        data1 = await data1.json(); */
        let data1 = [{"id_asset":0,"location":"Servidors","model":"Monitor BENQ GW240"},{"id_asset":1,"location":"Servidors","model":"Monitor BENQ GW240"},{"id_asset":2,"location":"Servidors","model":"Teclat Lenovo"},{"id_asset":3,"location":"Aula 106","model":"Monitor BENQ GW240 / 1"},{"id_asset":4,"location":"Aula 106","model":"Monitor BENQ GW240 / 2"},{"id_asset":5,"location":"Departament Informàtica","model":"Impressora Konica Minolta"},{"id_asset":6,"location":"Servidors","model":"Router Cisco XXXX"},{"id_asset":7,"location":"Aula 110","model":"Projector Optmoa GT670"}]
        
        return data1;
    }

}

