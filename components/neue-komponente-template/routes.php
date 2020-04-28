<?php
/*
* routes.php muss noch in der datei bi-kompass-component-service/routes/web.php bekanntgemacht werden.
*/
$router->get('/neue-komponente-template/show', 'NeueKomponenteTemplateServiceController@index');
$router->post('/neue-komponente-template/post/something', 'NeueKomponenteTemplateServiceController@irgendeinPostRequest');