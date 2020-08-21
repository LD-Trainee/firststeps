document.addEventListener('DOMContentLoaded', init)
var counter;
const text1='Oil remove shred and tear radiation vapor';
const text2='It\'s the fear so unclear man in motion going nowhere';
const text3='In our homes stuck in the face spread the word to the populace';
const text4='Yellow journal yellow journal set the pace feel the rage';

function init(){
    document.getElementById('Button1').addEventListener('click', Button1Clicked)
    counter = 0;
}

function Button1Clicked() {
    counter++;
    if(counter===1){document.getElementById('textfeld').innerText += '\n' + text1}
    if(counter===2){document.getElementById('textfeld').innerText += '\n' + text2}
    if(counter===3){document.getElementById('textfeld').innerText += '\n' + text3}
    if(counter===4){document.getElementById('textfeld').innerText += '\n' + text4}
}