<div class="container">
        <div id="search-wrapper">
            <div id="search-box">
                <label for="search">BI - Suche:</label>
                <input id="search" name="sstring" type="text">
            </div>
            <div id="suggestion-list-wrapper">
                <ul id="suggestion-list">
                    <!--<li>Item 1</li>
                    <li>Item 2</li>
                    <li>Item 3</li> -->
                </ul>
            </div>
        </div>
    
        <div id="search-info-box-wrapper">
            <div id="search-info-box">
                <div id="question">
                    Frage
                </div>
                <div id="question-long">
                    Lange, sehr ausführliche Ausführung einer Frage, die den Sachverhalt breit und weit darstellt. Blabla hier und Blabla da.
                </div>
                <div id="answer">
                    Hier die Antwort
                </div>
                <div id="link-wrapper">
                    <a id="link" href="#">Ein Link zu mehr Infos</a>
                </div>
            </div>
            

        </div>
    </div>

    <script>
        const baseUrl = "http://localhost/bi-kompass/";
        let searchInput = document.getElementById('search');
        
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
            searchInput.value = val;
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
            if (searchInput.value != '') {
                fetch(baseUrl + 'bi-kompass-component-service/search-component/find?sstring=' + searchInput.value)
                .then((response) => response.json())
                .then((data) => {
                    suggestionList.innerHTML = "";
                    preResult.suggestions = data;
                    preResult.suggestions.forEach(element => {
                        let li = document.createElement('LI');
                        let textNode = document.createTextNode(element.question_short);
                        li.appendChild(textNode);
                        li.class = "suggestion";
                        li.addEventListener('click', selSuggestion);
                        suggestionList.appendChild(li);
                    });
                });
            } else {
                suggestionList.innerHTML = "";
            }
            console.log(searchInput.value);
            
            if (event.keyCode === 13) {
                
                if(searchInput.value != '') {
                    emptyRespondFields();
                    console.log("suche gestartet");
                    event.preventDefault();
                    getResult();
                }
                    
            }
        });

        function getResult() {
            fetch(baseUrl + 'bi-kompass-component-service/search-component/find?sstring=' + searchInput.value)
            .then((response) => response.json())
            .then((data) => {
                resultObject.result = data;
                resultObject.result.forEach((element) => {
                    suggestionList.innerHTML = "";
                    
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

    </script>