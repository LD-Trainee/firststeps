

document.addEventListener('DOMContentLoaded', init)


function init(){
    document.getElementById('rechner_form_Calc').addEventListener('click', Button1Clicked)
}

function Button1Clicked(){
    var text;
    text = (document.getElementById('rechner_form_zahl').value);
    var indexArray = checkForSign(text);
        document.getElementById("rechner_form_zahl").value = indexArray[0] + ' ' + indexArray[1];
    var textFetzen = text.split('ß');
    if(indexArray[0]=='999' && indexArray[1]===undefined){
        document.getElementById("rechner_form_zahl").value = eval(text);
    }

}

function checkForSign(text){
    var indexArray = [];
    indexArray[0]=999;
    var counter = 0;
    var indexArrayCounter = 0;
    while(counter!==text.length) {
        if (text.charAt(counter) === 'ß') {
            indexArray[indexArrayCounter] = counter;
            indexArrayCounter++;
        }
        counter++;
    }
    return indexArray;
}