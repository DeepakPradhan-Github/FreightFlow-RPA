<?php
require 'vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

$client = new Client();

// API Endpoints and Configuration
$endpoints = [
    'token' => 'https://account.uipath.com/oauth/token',
    'workspaces' => 'https://cloud.uipath.com/thenemfjkpmx/DefaultTenant/orchestrator_/odata/PersonalWorkspaces',
    'releases' => 'https://cloud.uipath.com/thenemfjkpmx/DefaultTenant/orchestrator_/odata/Releases?%24filter=%20Name%20eq%20%20%27Shipping_Details%27',
    'jobs' => 'https://cloud.uipath.com/thenemfjkpmx/DefaultTenant/orchestrator_/odata/Jobs/UiPath.Server.Configuration.OData.StartJobs',
];

$clientId = '8DEv1AMNXczW3y4U15LL3jYf62jK93n5';
$refreshToken = 'L1ejNCt34hEHPfOhjSNNcifNGVgDNUhkNVj_RxxQOd1y1';
$st = $_GET['job_id'];
// 1. Get Access Token
$response = $client->post($endpoints['token'], [
    'json' => [
        'grant_type' => 'refresh_token',
        'client_id' => $clientId,
        'refresh_token' => $refreshToken,
    ],
]);
$data = json_decode($response->getBody(), true);
$accessToken = $data['access_token'];
echo "%%%%%%% $accessToken ";

// 2. Get Organization Unit ID
$response = $client->get($endpoints['workspaces'], [
    'headers' => [
        'Authorization' => "Bearer $accessToken",
    ],
]);
$data = json_decode($response->getBody(), true);
$organizationUnitId = $data['value'][0]['Id']; // Assuming you want the first workspace's ID
echo "%%%%%%% $organizationUnitId";

// 3. Get Release Key
$response = $client->get($endpoints['releases'], [
    'headers' => [
        'Authorization' => "Bearer $accessToken",
    ],
]);
$data = json_decode($response->getBody(), true);
$releaseKey = $data['value'][0]['Key']; // Assuming you want the first release's key
echo "%%%%%%% $releaseKey";


try{
// 4. Start Job
$response = $client->post($endpoints['jobs'], [
    'headers' => [
        'Authorization' => "Bearer $accessToken",
        'X-UIPATH-TenantName' => 'DefaultTenant',
        'X-UIPATH-OrganizationUnitId' => $organizationUnitId,
    ],
    'json' => [
        'startInfo' => [
            'ReleaseKey' => $releaseKey,
            'Strategy' => 'ModernJobsCount',
            'JobsCount' => 1,
            'InputArguments' => "{\"job_id\":\"$st\",\"user_id\":001}",
        ]
    ],
]);

// Handle the final response (e.g., job ID)
$data = json_decode($response->getBody(), true);
//echo  $data;
header("location: index3.php");
// Process or log the job information
}catch(RequestException $e){
    echo $e->getMessage();
}


?>