<?php


// Helper Functions


// Check if the the hostname and sessionkey cookies are set and the user is logged in
function isLoggedIn() {
    if(isset($_COOKIE['SESSIONKEY'])){
        return true;
    }
    return false;
};



// Routes



// Login Page
$app->get('/login', function ($request, $response, $args) {
    return $this->view->render($response, 'login.html', []);
});

$app->post('/login', function ($request, $response, $args) {

    $parsedBody = $request->getParsedBody();
    $api = new ApiClass;

    $username = $parsedBody["username"];
    $password = $parsedBody["password"];
    $hostname = $this->get('settings')['ms_settings']['hostname'];


    if(strlen($username) == 0){
        return $this->view->render($response, '/', []);
    }

    $session = $api->login($username,$password,$hostname);

    if(isset($session->statusCode)) {
        return $this->view->render($response, '/', []);
    }

    if($session == null) {
        return $this->view->render($response, "login.html", []);
    } else {
        if(isset($session->id)){
            setcookie('SESSIONKEY', $session->id, time()+8640000, '/');
            return $response->withStatus(303)->withHeader('Location', '/');
        } else {
            return $this->view->render($response, "login.html", []);
        }
    }

});


// Logout

$app->get('/logout', function ($request, $response, $args) {
    setcookie('SESSIONKEY', "", time() - 3600, '/');
    return $this->view->render($response, 'login.html', []);
});


// Browse Projects / Main Screen
$app->get('/[{projectid}]', function ($request, $response, $args) {


    if(!isLoggedIn()) {
        return $response->withStatus(301)->withHeader('Location', '/login');
    }

    $api = new ApiClass;

    // Get the config variables
    $hostname = $this->get('settings')['ms_settings']['hostname'];
    $sessionkey = $_COOKIE['SESSIONKEY'];

    // Get the user detail
    $user = json_decode($api->getUserInfo($hostname,$sessionkey));


    // Get all projects
    $projects = json_decode($api->getUserProjects($sessionkey,$hostname));

    // If a specific project was selected, use that project id
    if (isset($args['projectid'])) {
        $projectid = $args['projectid'];
    } else {
        $projectid = $projects[0]->id;
    };


    // Get assets for the project
    $assets = json_decode($api->getAssets($projectid,$sessionkey,$hostname));

    return $this->view->render($response, 'home.html', [
        'projects' => $projects,
        'assets' => $assets,
        'projectid' => $projectid,
        'user' => $user
    ]);


});



// Get the detail of a specific asset
$app->get('/asset/{assetid}', function ($request, $response, $args) {

    if(!isLoggedIn()) {
        return $response->withStatus(301)->withHeader('Location', '/login');
    }

    $api = new ApiClass;

    // Get the config variables
    $hostname = $this->get('settings')['ms_settings']['hostname'];
    $sessionkey = $_COOKIE['SESSIONKEY'];
    $assetid = $args['assetid'];

    // Get assets for the project
    $asset = $api->getAsset($hostname, $assetid,$sessionkey);

    // Return as JSON
    $response->withAddedHeader('Content-Type', 'application/json');
    $response->write($asset);

});


