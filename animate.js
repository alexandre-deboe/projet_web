function affiche_intervenant(){
    $('#50').fadeIn(800);
    $('#33').fadeIn(800);
}
function affiche() {
    for(pas=1;pas<12;pas++){
        var str = '#'+pas.toString();
        $(str).slideToggle(800);
    }

    $('#14').fadeIn(800);
    $('#13').fadeIn(800);
    $('#12').fadeIn(800);
    setTimeout(affiche_intervenant,1000);

    //$('input').slideToggle(800);
    //$('#1').animate({ width: "400px" }, 1000);
}


function cache() {
    for(pas=1;pas<12;pas++){
        var str = '#'+pas.toString();
        $(str).hide(0);
    }

    $('#12').hide(0);
    $('#13').hide(0);
    $('#14').hide(0);

    $('#50').hide(0);
    $('#33').hide(0);
}


function init(str){
    imgObj = document.getElementById(str);
    imgObj.style.position= 'relative';
    imgObj.style.top = '0px';


    return imgObj;
}


function animate(opts) {
    var start = new Date;
    var id = setInterval(function() {
        var timePassed = new Date - start;
        var progress = timePassed / opts.duration;

        if (progress > 1) progress = 1;

        var delta = opts.delta(progress);
        opts.step(delta);
        if (progress == 1) {
            clearInterval(id)
        }
    }, opts.delay || 10)

}

function bounce(progress) {
    for(var a = 0, b = 1, result; 1; a += b, b /= 2) {
        if (progress >= (7 - 4 * a) / 11) {
            return -Math.pow((11 - 6 * a - 11 * progress) / 4, 2) + Math.pow(b, 2);
        }
    }
}

function makeEaseOut(p) {
    return 1 - bounce(1 - p)
}




function move(ind) {

    var to = 700;


    animate({
        delay: 10
        ,
        duration: 800,
        delta: makeEaseOut,
        step: function(delta) {
            tab[ind].style.top = to*delta + "px"
        }
    });

}


function cascade() {
    for (pas = 0; pas < 27; pas++) {
        setTimeout(move, pas*30, pas);
    }
}


/////////////////////////////////////  Fonctions ajout et suppression pour le formulaire





var i = 50;

function ajout(element){
    if(i<59) {


        var formulaire = window.document.getElementById(intervenant);
        // On clone le bouton d'ajout
        var ajout = element.cloneNode(true);
        ajout.className = "ajout2";
        // Crée un nouvel élément de type "input"
        var champ = document.createElement("input");
        // Les valeurs encodée dans le formulaire seront stockées dans un tableau
        i = i + 1;
        champ.name = "intervenant"+i.toString();
        champ.type = "text";

        champ.placeholder="Nom Prénom";

        champ.id = i.toString();

        champ.size = 30;
        champ.className = "champ";

        var sup = document.createElement("input");
        sup.value = "";
        sup.type = "button";
        sup.className = "supprime";
        // Ajout de l'événement onclick
        sup.onclick = function onclick(event) {
            suppression(this);
        };

        // On crée un nouvel élément de type "p" et on insère le champ l'intérieur.
        var bloc = document.createElement("p");
        bloc.appendChild(champ);

        var div = document.createElement("div");
        div.name= "intervenant";
        div.appendChild(ajout);
        div.appendChild(sup);
        div.appendChild(champ);

        $(ajout).insertAfter(element);
        $(sup).insertAfter(element);
        $(champ).insertAfter(element);
        //formulaire.insertBefore(bloc, element.nextSibling);

        $(document.createElement("p")).insertAfter(element);

        var str = "#"+i.toString();

        $(str).autocomplete({
            source: 'complete.php',
            minLength: 1,
            dataType: 'json'
        });


        $(str).blur(function() {verifintervenant2(this);});



    }

}

function suppression(element){
    i=i-1;
    var formulaire = window.document.getElementById("intervenant");

    // Supprime le bouton d'ajout
    formulaire.removeChild(element.previousSibling);
    // Supprime le champ
    formulaire.removeChild(element.nextSibling);
    // Supprime le bouton de suppression
    formulaire.removeChild(element);
}



////////////////////////////////Datepicker

$(function() {

    $.datepicker.setDefaults($.datepicker.regional['fr']);

    $(".datepicker").datepicker({

        dateFormat: 'yy-mm-dd'

    });

});







//////////////////////////Verification formulaire

function surligne(champ, erreur) {
    if(erreur)
        champ.style.backgroundColor = "#fba";
    else
        champ.style.backgroundColor = "";
}

function verifentreprise(champ) {
    if(champ.value.length < 2 || champ.value.length > 30) {
        surligne(champ, true);
        return false;
    }
    else {
        surligne(champ, false);
        return true;
    }
}

function verifclient(champ) {
    if(champ.value.length < 2 || champ.value.length > 20) {
        surligne(champ, true);
        return false;
    }
    else {
        surligne(champ, false);
        return true;
    }
}

function verifadresse(champ) {
    if(champ.value.length < 5 || champ.value.length > 50) {
        surligne(champ, true);
        return false;
    }
    else {
        surligne(champ, false);
        return true;
    }
}


function veriftel(champ) {
    if(champ.value.length < 10 || champ.value.length > 10) {
        surligne(champ, true);
        return false;
    }
    if(champ.value < 1 || champ.value >9999999999) {
        surligne(champ, true);
        return false;
    }
    else {
        surligne(champ, false);
        return true;
    }
}

var verifCE = false;
function verifchargeetude() {
    var champ = document.getElementById('26');
    var id = champ.id;
    var str = '#'+id;

    if(champ.value.length < 1|| champ.value.length > 40) {
        surligne(champ, true);

        return false;
    }
    else {
        $.post("check_charge_etude.php" ,{charge_etude:$(str).val() } ,function(data)
        {
            if(data=='no')
            {

                surligne(champ, true);
                verifCE = false;

            }
            else
            {
                if(data=='yes') {
                    surligne(champ, false);
                    verifCE = true;
                }
                else verifCE=false;
            }
        });
    }
    return verifCE;

}

function verifdate(champ) {
    if(champ.value.length < 10|| champ.value.length > 10) {
        surligne(champ, false);
        return false;
    }
    else {
        surligne(champ, false);
        return true;
    }
}



function verifprixjeh(champ) {
    if(champ.value.length < 2|| champ.value.length > 30) {
        surligne(champ, true);
        return false;
    }
    if(champ.value < 80|| champ.value > 340) {
        surligne(champ, true);
        return false;
    }
    else {
        surligne(champ, false);
        return true;
    }
}

function verifnombrejeh(champ) {
    if(champ.value < 1) {
        surligne(champ, true);
        return false;
    }
    else {
        surligne(champ, false);
        return true;
    }
}


var verifI = false;
function verifintervenant() {
    var pas;
    for(pas=50 ;pas<=i;pas++) {

        var id = pas.toString();
        var str = '#'+id;
        $.post("check_intervenant.php", {intervenant: $(str).val()}, function (data) {
            if (data == 'no') {
                surligne(document.getElementById(id), true);

                verifI = false;
            }
            else {
                if (data == 'yes') {


                    surligne(document.getElementById(id), false);
                    verifI = true;
                }

            }
        });
        if(verifI==false){
            return false;
        }
    }

    return true;
}


function verifintervenant2(champ) {

    var id = champ.id;
    var str = '#'+id;


    $.post("check_intervenant.php", {intervenant: $(str).val()}, function (data) {
        if (data == 'no') {

            surligne(document.getElementById(id), true);
            verifI = false;
        }
        else {
            if (data == 'yes') {


                surligne(document.getElementById(id), false);
                verifI = true;
            }
            else {

                surligne(document.getElementById(id), true);
                verifI = false;
            }
        }
    });

}


function verifForm() {

    if (!(verifentreprise(document.getElementById('21')))) {
        alert('Veuillez remplir le champ entreprise');
        return false;
    }
    else {
        if (!(verifclient(document.getElementById('22')))) {
            alert('Veuillez remplir le champ Nom Client');
            return false;
        }
        else {
            if (!(verifclient(document.getElementById('23')))) {
                alert('Veuillez remplir le champ Prénom Client');
                return false;
            }
            else {
                if (!(verifadresse(document.getElementById('24')))) {
                    alert('Veuillez remplir le champ Adresse CLient');
                    return false;
                }
                else {
                    if (!(veriftel(document.getElementById('25')))) {
                        alert('Veuillez remplir le champ Téléphone Client');
                        return false;
                    }
                    else {
                        if (!(verifchargeetude())) {
                            alert("Veuillez remplir le champ Chargé d'étude\nLe chargé d'étude doit être inscrit dans la BD");
                            return false;
                        }
                        else {
                            if (!(verifdate(document.getElementById('27')))) {
                                surligne(document.getElementById('27'), true);
                                alert('Veuillez remplir le champ Date de début');
                                return false;
                            }
                            else {
                                if (!(verifdate(document.getElementById('28')))) {
                                    surligne(document.getElementById('28'), true);
                                    alert('Veuillez remplir le champ Date de fin');
                                    return false;
                                }
                                else {
                                    if (!(verifprixjeh(document.getElementById('29')))) {
                                        alert('Veuillez remplir le champ JEH');
                                        return false;
                                    }
                                    else {
                                        if (!(verifnombrejeh(document.getElementById('30')))) {
                                            alert('Veuillez remplir le champ Nombre de JEH');
                                            return false;
                                        }
                                        else {
                                            if (!verifI) {
                                                alert("Veuillez remplir le champ Intervenant\nL'intervenant doit être enregistré doit la bd");
                                                return false;
                                            }
                                            else return true;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}






