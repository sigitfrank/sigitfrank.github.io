function type(element, text) {
    new TypeIt("#" + element, {
        strings: text,
        speed: 120
    }).go();
}

type('myName',' <span class="text-warning">echo</span> "Sigit"');

setTimeout(() => {
    document.getElementById('myName').innerHTML = "Si<span class='name'>git</span>";
}, 5000);
