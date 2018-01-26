function obtenirListe() {
  fetch('./liste.php')
    .then(function(response) { return response.json() })
    .then(function(ouvrages) {
      for(let ouvrage of ouvrages) {
        document.getElementById('liste-ouvrages').innerHTML += "<li><a href=\'afficher.php?id=" + ouvrage[0] + "\'>" + ouvrage[1] + "</a></li>";
      }
    })
    .then(function() {
      avant_afficher();
    });
}

// récupérer les inputs du formulaire et les afficher
function avant_afficher(){
  let liste = document.querySelectorAll('#liste-ouvrages li a');
  for(let item of liste){ //permet de couvrir tous les ouvrage du sommaire
    item.addEventListener('click', function(evt) {
      evt.preventDefault();
      afficher(item);
    })
  }  
}

function afficher(item){
  fetch(item.href) // correspond à fetch("affichier.php?id=" + id)
    .then(function (r) { return r.json() })
    .then(function (ouvrage) {
      document.getElementById('ident').value = ouvrage[0];
      document.getElementById('titre').value = ouvrage[1];
      document.getElementById('aut').value = ouvrage[2];
      document.getElementById('year').value = ouvrage[3];
      document.getElementById('maison').value = ouvrage[4];
      document.getElementById('ed').value = ouvrage[5];
      document.getElementById('siteWeb').value = ouvrage[6];
      document.getElementById('image').value = ouvrage[7];
      document.getElementById('select').value = ouvrage[8];
      document.getElementById('description').value = ouvrage[9];
    });
}

function sendDataForm(){
  const form = document.getElementById("formulaire-ajout")
  fetch('creer.php', { method: 'POST', body: new FormData(form) })
    .then(function (response) {
      if (response.ok) { 
        document.getElementById('liste-ouvrages').innerHTML = "";    
        // ajouter l'ouvrage dans le sommaire avec la liste.php en appelant à nouveau la fonction obtenirListe()
        obtenirListe();
      }
    })
}

function disableDescription() {
  var selected = document.getElementById("select").value; 
  if (selected == "X") {
    document.getElementById("description").disabled=false;
  }
  else {
    document.getElementById ("description").disabled=true;
    document.getElementById ("description").value = "";
  }
}

function verification() {
  const id = document.getElementById('ident').value;
  const t = document.getElementById('titre').value;
  const a = document.getElementById('aut').value;
  const m = document.getElementById('maison').value;
  const site = document.getElementById('siteWeb').value;
  const select = document.getElementById('select').value;
  const d2 = document.getElementById('description').value;
  bool = true;
  txt = [];

  if (id === "" ) {
    txt1 = " l'identifiant  ";
    txt.push(txt1);
    bool = false;
    const inputEl = document.querySelector('input[name=ident]');
    inputEl.style.border = "2px solid red";
  } else {
    txt1 = "";
    const inputEl = document.querySelector('input[name=ident]');
  }

  if (t === "" ) {
    txt2 = " le titre "
    txt.push(txt2);
    bool = false;
    const inputEl = document.querySelector('input[name=titre]');
    inputEl.style.border = "2px solid red";
  } else {
    txt2 = "";
    const inputEl = document.querySelector('input[name=titre]');
    inputEl.style.border = "1px solid green";
  }

  if (a === "" ) {
    txt3 = " l'auteur ";
    txt.push(txt3);
    bool = false;
    const inputEl = document.querySelector('input[name=aut]');
    inputEl.style.border = "2px solid red";
  } else {
    txt3 = ""
    const inputEl = document.querySelector('input[name=aut]');
    inputEl.style.border = "1px solid green";
  }

  if (m === "" ) {
    txt4 = " la maison d'édition ";
    txt.push(txt4);
    bool = false;
    const inputEl = document.querySelector('input[name=maison]');
    inputEl.style.border = "2px solid red";
  } else {
    txt4 = "";
    const inputEl = document.querySelector('input[name=maison]');
    inputEl.style.border = "1px solid green";
  }

  if (site === "" ) {
    txt5= " le siteWeb ";
    txt.push(txt5);
    bool = false;
    const inputEl = document.querySelector('input[name=siteWeb]');
    inputEl.style.border = "2px solid red";
  } else {
    txt5 = "";
    const inputEl = document.querySelector('input[name=siteWeb]');
    inputEl.style.border = "1px solid green";
  }

  if (select === "choisir" ) {
    txt6= " le type d'ouvrage ";
    txt.push(txt6);
    bool = false;
    const inputEl = document.querySelector('#select');
    inputEl.style.border = "2px solid red";
  } else {
    txt6 = "";
    const inputEl = document.querySelector('#select');
    inputEl.style.border = "1px solid green";
  }

  if (select === "X" && d2 === "") {
    txt7 = " Une description doit être renseignée";
    txt.push(txt7);
    bool = false;
    const inputEl = document.getElementById('description');
    inputEl.style.border = "2px solid red";
  } else {
    txt7 = "";
    const inputEl = document.getElementById('description');
    inputEl.style.border = "1px solid green";
  }
  return bool;
}

function checkNotSameId(){ 
  id=[];
  current_id = document.getElementById('ident').value;
  return fetch('liste.php')
      .then(function(r) { return r.json() })
      .then(function(ouvrages) {
      for(let ouvrage of ouvrages){
          id.push(ouvrage[0]);
      }
      return id.includes(current_id);
  })    
}

  // Affichage des erreurs
function afficheErrVerif(){
  if(!verification()){
    const msg_erreur = document.getElementById('liste-err');
    msg_erreur.innerHTML ="";
    for(let i = 0; i < txt.length; i++){
      document.getElementById('errors').innerHTML = " ATTENTION : champ(s) manquant(s) ";
      msg_erreur.innerHTML += "<li>" + txt[i] + "</li>";
    } 
  } else {
    //enlever l'affichage des erreurs
    document.getElementById('liste-err').innerHTML ="";
    document.getElementById('errors').innerHTML ="";
  }
}

function afficherErrCheckSameId(){
  checkNotSameId().then(function(id_exists){
    if(id_exists) {
        document.getElementById('erreur_same_id').innerHTML = " L'id renseignée existe déjà! ";
        const inputEl = document.querySelector('input[name=ident]');
        inputEl.style.border = "2px solid red";
    } 
    else {
        document.getElementById('erreur_same_id').innerHTML ="";
        const inputEl = document.querySelector('input[name=ident]');
        inputEl.style.border = "1px solid green";
    }        
  });
}

document.addEventListener('DOMContentLoaded', (evt) => {
  evt.preventDefault();
  const formulaireSubmit = document.getElementById('formulaire-ajout')
  formulaireSubmit.addEventListener('submit', function(evt) {
    evt.preventDefault();
    afficheErrVerif();
    afficherErrCheckSameId();
    checkNotSameId().then(function(id_exists){ 
      if(verification() && !id_exists){
        document.getElementById('ajout-ouvrage').innerHTML = "L'ouvrage a été ajouté avec succes"; 
        sendDataForm();
      } else {
          document.getElementById('ajout-ouvrage').innerHTML = "L'ouvrage n'a pas pu être ajouté";     
      }
    });
  })
  obtenirListe();
});
