/*
    Server / Localhost Setting
*/
const env = "http://localhost/bi-kompass/";

const baseUrl = env;

let inputText = document.getElementById('search');

let elSuggestionList = document.getElementById('suggestion-list');

/*
let elQuestionShort = document.getElementById('question');
let elQuestionLong = document.getElementById('question-long');
let elAnswer = document.getElementById('answer');
let elLink = document.getElementById('link'); */
let elResultsContainer = document.getElementById('search-info-box');

let preResult = { suggestions : ''};
let searchResultsObject = { result: '' };

function assignSelectedSuggestionToInputText(e) {
    let val = e.target.innerHTML;

    let strongHtmlTags = new RegExp("<[/]?strong>", "g");
    let adjustedSearchString = val.replace(strongHtmlTags, "");

    inputText.value = adjustedSearchString;
    elSuggestionList.innerHTML = '';
    inputText.focus();
}

function emptyRespondFields() {
    elResultsContainer.innerHTML = "";
    //elQuestionShort.innerHTML = "";
    //elQuestionLong.innerHTML = "";
    //elAnswer.innerHTML = "";
    //elLink.innerHTML = "";
}

function displayResults() {
    fetch(baseUrl + 'bi-kompass-component-service/search-component/find?sstring=' + inputText.value)
    .then((response) => response.json())
    .then((data) => {
        searchResultsObject.result = data;
        searchResultsObject.result.forEach((element) => {

            let resultContainer = document.createElement('DIV');
            let questionShort = document.createElement('DIV');
            let questionLong =document.createElement('DIV');
            let answer = document.createElement('DIV');
            let link = document.createElement('DIV');
            let elHr = document.createElement('HR');
            
            let questionShortText = document.createTextNode(element.question_short);
            //elQuestionShort.appendChild(questionShortText);
            questionShort.appendChild(questionShortText);
            resultContainer.appendChild(questionShort);

            let questionLongText = element.question_long == null
                            ? document.createTextNode("Keine Lange Ausführung")
                            :document.createTextNode(element.question_long);
            //elQuestionLong.appendChild(questionLongText);
            questionLong.appendChild(questionLongText);
            resultContainer.appendChild(questionLong);

            let answerText = document.createTextNode(element.answer);
            //elAnswer.appendChild(answerText);
            answer.appendChild(answerText);
            resultContainer.appendChild(answer);

            let linkText = document.createTextNode(element.link);
            //elLink.appendChild(linkText);
            link.appendChild(linkText);
            resultContainer.appendChild(link);
            elResultsContainer.appendChild(resultContainer);
            elResultsContainer.appendChild(elHr);

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

inputText.addEventListener('keyup', function(event) {
    if (event.keyCode === 13) {
        elSuggestionList.innerHTML = "";
        
        if(inputText.value != '') {
            emptyRespondFields();
            event.preventDefault();
            displayResults();
        }
    } else {
        if (inputText.value != '') {
        fetch(baseUrl + 'bi-kompass-component-service/search-component/find?sstring=' + inputText.value)
        .then((response) => response.json())
        .then((data) => {
            elSuggestionList.innerHTML = "";
            preResult.suggestions = data;
            preResult.suggestions.forEach(element => {
                /* finde Teilstring in textNode und ersetze durch <strong> */
                let resultString = element.question_short;
                let inputString = inputText.value;
                let outputString = highlightMatches(inputString, resultString);
                let li = document.createElement('LI');
                li.innerHTML = outputString;
                li.class = "suggestion";
                li.addEventListener('click', assignSelectedSuggestionToInputText);
                elSuggestionList.appendChild(li);
            });
        });
        } else {
            elSuggestionList.innerHTML = "";
        }
        console.log(inputText.value);
    }
    
});