class LogCad extends HTMLElement {

    connectedCallback(){
       let campos =  this.getAttribute('class');
        
        if(campos === 'login') {
            this.innerHTML = ''
        }
        else if (campos === 'cadastro') {
            this.innerHTML = ''
        }
        else {
            this.innerHTML = '<h1>Erro</h1>'
        }
    };
}

customElements.define("login-cad", LogCad )