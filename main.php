<?php
require_once __DIR__ . '/vendor/autoload.php';
$client = new Google_Client();
$client->setScopes([
    'https://www.googleapis.com/auth/youtube.force-ssl',
]);
$client->setAuthConfig('./client_secret.json');
$client->setAccessType('offline');
// Request authorization from the user.
$authUrl = $client->createAuthUrl();
printf("Open this link in your browser:\n%s\n", $authUrl);
print('Enter verification code: ');
$authCode = trim(fgets(STDIN));
// Exchange authorization code for an access token.
$accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
$client->setAccessToken($accessToken);
// Define service object for making API requests.
$service = new Google_Service_YouTube($client);
// Define the $video object, which will be uploaded as the request body.
$video = new Google_Service_YouTube_Video();
// Add 'id' string to the $video object.
$video->setId('XO2fhnG61-Q');
// Add 'snippet' object to the $video object.
$videoSnippet = new Google_Service_YouTube_VideoSnippet();
$videoSnippet->setCategoryId('27');
$videoSnippet->setDescription('This video is about how awesome APIs are. 2020 is so bad ');
$videoSnippet->setTags([
    'kagaya john',
    'tom scott',
    'tomscott',
    'api',
    'coding',
    'application programming interface',
    'data api'
]);
$videoSnippet->setTitle('This my 2019 memories picture is the best year ');
$video->setSnippet($videoSnippet);
$response = $service->videos->update('snippet', $video);
print_r($response);
