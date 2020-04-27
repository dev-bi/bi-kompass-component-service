/*
        Environment Setting
*/
const env = "http://localhost/bi-kompass/";
//const baseUrlProduction = "http://developer.lionysos.com/";

const baseUrl = env;

let searchInput = document.getElementById('search');
let suggestionInput = "";

let suggestionList = document.getElementById('suggestion-list');

/* Felder für Frage, Antwort und Link */
let questionShort = document.getElementById('question');
let questionLong = document.getElementById('question-long');
let answer = document.getElementById('answer');
let link = document.getElementById('link');
/* ********************************** */

let preResult = { suggestions : ''};
let resultObject = { result: '' };

function selSuggestion(e) {
    let val = e.target.innerHTML;
    /* 
    * Das muss alles gesäubert werden! Nur provisorischer Code!
    * Außerdem: andere Lösung finden. data-Feld benutzen oder so
    */
    let openStrong = new RegExp("\<strong\>", "g");
    let closeStrong = new RegExp("\<\/strong\>", "g");
    valWithoutOpenStrong = val.replace(openStrong, "");
    valWithoutAllTags = valWithoutOpenStrong.replace(closeStrong, "");
    searchInput.value = valWithoutAllTags;
    suggestionList.innerHTML = '';
    searchInput.focus();
}

function emptyRespondFields() {
    questionShort.innerHTML = "";
    questionLong.innerHTML = "";
    answer.innerHTML = "";
    link.innerHTML = "";
}

searchInput.addEventListener('keyup', function(event) {
    if (event.keyCode === 13) {
        suggestionList.innerHTML = "";
        
        if(searchInput.value != '') {
            emptyRespondFields();
            console.log("antwort: suche gestartet");
            event.preventDefault();
            getResult();
        }
            
    }else {
        if (searchInput.value != '') {
        fetch(baseUrl + 'bi-kompass-component-service/search-component/find?sstring=' + searchInput.value)
        .then((response) => response.json())
        .then((data) => {
            suggestionList.innerHTML = "";
            preResult.suggestions = data;
            preResult.suggestions.forEach(element => {
                /* finde Teilstring in textNode und ersetze durch <strong> */
                let resultString = element.question_short;
                let inputString = searchInput.value;
                let outputString = highlightMatches(inputString, resultString);
                let li = document.createElement('LI');
                li.innerHTML = outputString;
                li.class = "suggestion";
                li.addEventListener('click', selSuggestion);
                suggestionList.appendChild(li);
            });
        });
        } else {
            suggestionList.innerHTML = "";
        }
        console.log(searchInput.value);
    }
    
});

function getResult() {
    fetch(baseUrl + 'bi-kompass-component-service/search-component/find?sstring=' + searchInput.value)
    .then((response) => response.json())
    .then((data) => {
        resultObject.result = data;
        resultObject.result.forEach((element) => {
            //suggestionList.innerHTML = "";
            
            let questionShortText = document.createTextNode(element.question_short);
            questionShort.appendChild(questionShortText);

            let questionLongText = element.question_long == null ? document.createTextNode("Keine Lange Ausführung") : document.createTextNode(element.question_long);
            questionLong.appendChild(questionLongText);

            let answerText = document.createTextNode(element.answer);
            answer.appendChild(answerText);
            let linkText = document.createTextNode(element.link);
            link.appendChild(linkText);
        });
    })
}

function highlightMatches(substring="", originString="") {
    let regex = new RegExp(substring, "gi");
    let resStr = originString.replace(regex, (match) => {
        return `<strong>${match}</strong>`;
    })
return resStr;
}