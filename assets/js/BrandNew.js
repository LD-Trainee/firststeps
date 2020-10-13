

const $ = require('jquery');

$(document).ready(function(){
    document.getElementById("test2").addEventListener("click",
        function(){
            $("#test").toggle();
        });
    document.getElementById("buttonA").addEventListener("click", A);
});

function A(){
    console.log("BUTTON PRESSED");
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {

        document.getElementById("divTest").innerHTML = this.responseText;

    };
    xhttp.open("GET", "http://localhost/test.txt", true);
    xhttp.send();
}