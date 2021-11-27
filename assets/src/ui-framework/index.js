document.addEventListener('DOMContentLoaded', addListeners);

function addListeners(event) {
    let btn = document.querySelector('#logBtn');
    logStyle(btn);
    btn.addEventListener('mouseover', ()=>  logStyle(btn)); 
    btn.addEventListener('mousedown', ()=>  logStyle(btn)); 

}

function logStyle(element) {
    let style = getComputedStyle(element);
    let str = `button: ${element.textContent};\nbackground-color: ${ style.getPropertyValue('background-color') };\nborder-top: ${ style.getPropertyValue('border-top-width') } ${ style.getPropertyValue('border-top-style') } ${ style.getPropertyValue('border-top-color') };\nborder-right: ${ style.getPropertyValue('border-right-width') } ${ style.getPropertyValue('border-right-style') } ${ style.getPropertyValue('border-right-color') };\nborder-bottom: ${ style.getPropertyValue('border-bottom-width') } ${ style.getPropertyValue('border-bottom-style') } ${ style.getPropertyValue('border-bottom-color') };\nborder-left: ${ style.getPropertyValue('border-left-width') } ${ style.getPropertyValue('border-left-style') } ${ style.getPropertyValue('border-left-color') };`;

    console.log(str);
}

class Dialog extends HTMLElement {
    constructor(content = '', title = ''){
        super();
        this.content = content;
        this.title = title;
    }
    open(){
        console.log('open');
        let backdrop = document.createElement('div');
            backdrop.classList.add('backdrop');
        let dialog = document.createElement('div');
            dialog.classList.add('dialog');
            dialog.append(this.content);
        document.body.appendChild(this)
            .appendChild(backdrop)
            .appendChild(dialog);
        Object.assign(this, {backdrop, dialog});
        backdrop.addEventListener('click', this.backdropOnClick.bind(this));
        document.body.style.overflow = 'hidden';
        document.body.style.paddingRight = '12px';
        this.animate([{opacity:0}, {opacity: 1}], { duration: 300,})
        console.log(this);
    }
    close(){
        console.log('close');
        document.body.style.overflow = '';
        document.body.style.paddingRight = '';
        this.innerHTML = '';
        this.remove();
    }
    backdropOnClick(event){
        if (event.target === this.backdrop) {
            this.close();
        }
    }
}
customElements.define('enf-dialog', Dialog);
window.Dialog = Dialog;
