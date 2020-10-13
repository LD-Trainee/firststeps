

const $ = require('jquery');

let a;
$(document).ready(function(){
    document.getElementById("test2").addEventListener("click",
        function(){
            $("#test").toggle();
            a = prompt("gib was ein! : ");
            var xhttp = new XMLHttpRequest();
            xhttp.open("POST", "http://localhost/text/write", true);
            xhttp.send(a);
            $("progressbar1").setDeterminate(true);
        });
    document.getElementById("buttonA").addEventListener("click", A);
    document.getElementById("eins").addEventListener("mouseleave", B);
    document.getElementById("eins").addEventListener("mouseenter", C);
});

function A(){
    console.log("BUTTON PRESSED");
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {

        document.getElementById("divTest").innerHTML = this.responseText;

    };
    xhttp.open("GET", "http://localhost/text.txt", true);
    xhttp.send();

}

function B(){
    $( "#eins" ).removeClass("B").css("color", "red").slideUp(200).slideDown(200);
}

function C(){
    $( "#eins" ).addClass("B");
}