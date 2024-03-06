let text = document.getElementById('text');
let leaf = document.getElementById('leaf');
let hill1 = document.getElementById('hill1');
let hill4 = document.getElementById('hill4');
let hill5 = document.getElementById('hill5');
let sec = document.getElementById('sec')

let connexion = document.getElementById('connexion');

window.addEventListener('scroll', () => {
    let value = window.scrollY;
    let windowHeight = window.innerHeight;
    let documentHeight = document.body.clientHeight;

    // Check if the user is near the bottom of the page
    if (value + windowHeight >= documentHeight - 100) {
        // Detach the event listener when near the bottom
        window.removeEventListener('scroll', scrollHandler);
    } else {
        // Apply your scroll effects
        text.style.marginTop = value * 2.5 + 'px';
        leaf.style.top = value * -1.5 + 'px';
        leaf.style.left = value * 1.5 + 'px';
        hill5.style.left = value * 1.5 + 'px';
        hill4.style.left = value * -1.5 + 'px';
        hill1.style.top = value * 1 + 'px';
    }
});

document.getElementById("connexion").onclick = function(event) {
    document.getElementById("sec").scrollIntoView({ behavior: "smooth",  block: "end" });
    event.preventDefault(); // Prevent the default behavior
};
