import "../css/components.css"

// import webpacklogo from '../assets/img/webpack-logo.png';

export const saludar = (nom) => {
    console.log("Creant etiqueta h1");
    const h1 = document.createElement("h1");
    h1.innerHTML = `Hola ${ nom }`;

    document.body.append(h1);



    //img
    // console.log(webpacklogo);
    // const img = document.createElement('img');
    // img.src = webpacklogo;
    // document.body.append(img);
}