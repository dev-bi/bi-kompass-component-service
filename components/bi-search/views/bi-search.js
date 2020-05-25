/*
    Server / Localhost Setting
*/
const env = "http://localhost/";

const baseUrl = env;

let elInputText = document.getElementById('search');

let elSuggestionList = document.getElementById('suggestion-list');

let elResultsContainer = document.getElementById('search-info-box');

let suggestionList = {
    currentIndex : 0,
    suggestions : ''
};

let searchResultsObject = { result: '' };

function assignSelectedSuggestionToInputText(e) {
    let val = e.target.innerHTML;

    let strongHtmlTags = new RegExp("<[/]?strong>", "g");
    let adjustedSearchString = val.replace(strongHtmlTags, "");

    elInputText.value = adjustedSearchString;
    elSuggestionList.innerHTML = '';
    elInputText.focus();
}

function emptyRespondFields() {
    elResultsContainer.innerHTML = "";
}

function displayResults() {
    fetch(baseUrl + 'bi-kompass-component-service/search-component/find?sstring=' + elInputText.value)
    .then((response) => response.json())
    .then((data) => {
        searchResultsObject.result = data;
        searchResultsObject.result.forEach((element) => {

            let resultContainer = document.createElement('DIV');
            resultContainer.setAttribute('class', 'faq-container');
            let questionShort = document.createElement('DIV');
            questionShort.setAttribute('class', 'question');
            let questionLong =document.createElement('DIV');
            questionLong.setAttribute('class', 'question-long');
            let answer = document.createElement('DIV');
            answer.setAttribute('class', 'answer');
            let link = document.createElement('A');
            
            let questionShortText = document.createTextNode(element.question_short);
            questionShort.appendChild(questionShortText);
            resultContainer.appendChild(questionShort);

            let questionLongText = element.question_long == null
                            ? document.createTextNode("Keine Lange Ausführung")
                            :document.createTextNode(element.question_long);
            questionLong.appendChild(questionLongText);
            resultContainer.appendChild(questionLong);

            let answerText = document.createTextNode(element.answer);
            answer.appendChild(answerText);
            resultContainer.appendChild(answer);

            let linkText = document.createTextNode(element.link);
            link.appendChild(linkText);
            link.setAttribute('href', element.link);
            resultContainer.appendChild(link);
            elResultsContainer.appendChild(resultContainer);
        });
    })
}

function highlightMatches(matchedString="", fullResultString="") {
    let regex = new RegExp(matchedString, "gi");
    let resStr = fullResultString.replace(regex, (match) => {
        return `<strong>${match}</strong>`;
    })
    return resStr;
}

function navigateSuggestions(key) {
    console.log("key: " + key);
    let lastElement = 0;
    if (key === 40 &&
        suggestionList.currentIndex < suggestionList.suggestions.length - 1) {
        suggestionList.currentIndex += 1;
        if (suggestionList.currentIndex == 0) {
            lastElement = 0
        } else {
            lastElement = -1;
        }
        console.log("List Index: " + suggestionList.currentIndex);

    } else if (key === 38 && suggestionList.currentIndex > 0) {
        suggestionList.currentIndex -= 1;
        if (suggestionList.currentIndex == suggestionList.suggestions.length - 1) {
            lastElement = 0
        } else {
            lastElement = +1;
        }
        console.log("List Index: " + suggestionList.currentIndex);
    }
    elInputText.value = suggestionList.suggestions[suggestionList.currentIndex].question_short;
    let liArray = elSuggestionList.children;
    liArray[suggestionList.currentIndex].classList.toggle('is-current');
    liArray[suggestionList.currentIndex + lastElement].classList.toggle('is-current');
}

elInputText.addEventListener('keyup', function(event) {
    if (event.keyCode === 13) {
        elSuggestionList.innerHTML = "";
        
        if(elInputText.value != '') {
            emptyRespondFields();
            event.preventDefault();
            displayResults();
        }

    } else if (elInputText.value != '') {
        if (event.keyCode === 38 || event.keyCode === 40) {
            navigateSuggestions(event.keyCode);
        } else {
            fetch(baseUrl + 'bi-kompass-component-service/search-component/find?sstring=' + elInputText.value)
            .then((response) => response.json())
            .then((data) => {
                elSuggestionList.innerHTML = "";
                suggestionList.suggestions = data;
                suggestionList.currentIndex = 0;
                suggestionList.suggestions.forEach(element => {
                    let li = document.createElement('LI');
                    let outputString = highlightMatches(elInputText.value, element.question_short);
                    li.innerHTML = outputString;
                    li.class = "suggestion";
                    li.addEventListener('click', assignSelectedSuggestionToInputText);
                    elSuggestionList.appendChild(li);
                });
                elSuggestionList.firstChild.classList.toggle('is-current');
            });
        }
            
    } else {
        elSuggestionList.innerHTML = "";
    }
});