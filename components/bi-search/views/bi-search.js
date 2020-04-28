/*
    Server / Localhost Setting
*/
const env = "http://localhost/bi-kompass/";

const baseUrl = env;

let inputText = document.getElementById('search');
let suggestionList = document.getElementById('suggestion-list');

/* Felder für Frage, Antwort und Link */
let questionShort = document.getElementById('question');
let questionLong = document.getElementById('question-long');
let answer = document.getElementById('answer');
let link = document.getElementById('link');
/* ********************************** */

let preResult = { suggestions : ''};
let resultObject = { result: '' };

function getSelectedSuggestion(e) {
    let val = e.target.innerHTML;

    let strongHtmlTags = new RegExp("<[/]?strong>", "g");
    let adjustedSearchString = val.replace(strongHtmlTags, "");

    inputText.value = adjustedSearchString;
    suggestionList.innerHTML = '';
    inputText.focus();
}

function emptyRespondFields() {
    questionShort.innerHTML = "";
    questionLong.innerHTML = "";
    answer.innerHTML = "";
    link.innerHTML = "";
}

function getResult() {
    fetch(baseUrl + 'bi-kompass-component-service/search-component/find?sstring=' + inputText.value)
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

inputText.addEventListener('keyup', function(event) {
    if (event.keyCode === 13) {
        suggestionList.innerHTML = "";
        
        if(inputText.value != '') {
            emptyRespondFields();
            event.preventDefault();
            getResult();
        }
    } else {
        if (inputText.value != '') {
        fetch(baseUrl + 'bi-kompass-component-service/search-component/find?sstring=' + inputText.value)
        .then((response) => response.json())
        .then((data) => {
            suggestionList.innerHTML = "";
            preResult.suggestions = data;
            preResult.suggestions.forEach(element => {
                /* finde Teilstring in textNode und ersetze durch <strong> */
                let resultString = element.question_short;
                let inputString = inputText.value;
                let outputString = highlightMatches(inputString, resultString);
                let li = document.createElement('LI');
                li.innerHTML = outputString;
                li.class = "suggestion";
                li.addEventListener('click', getSelectedSuggestion);
                suggestionList.appendChild(li);
            });
        });
        } else {
            suggestionList.innerHTML = "";
        }
        console.log(inputText.value);
    }
    
});


function highlightMatches(substring="", originString="") {
    let regex = new RegExp(substring, "gi");
    let resStr = originString.replace(regex, (match) => {
        return `<strong>${match}</strong>`;
    })
return resStr;
}