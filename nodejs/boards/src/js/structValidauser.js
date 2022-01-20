export function generateHtml2(){
    var html = `
    <body>
    <div>
    <form method="POST">
        <label for="">USER</label>
        <input id="user" type="text" required>
        <label>PASSWORD</label>
        <input id="password" type="password" required>
        <button type="button" id="boton">Entrar</button>
    </form>
    </div>
    </body>

	`
    return html
}