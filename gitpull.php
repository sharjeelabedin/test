<?php
    include 'CloudwaysAPIClient.php';
    $api_key = 'oaciS5ydXy7og6qnKL4zGX08gOETwu';
    $email = 'saad.hassan@cloudways.com';
    $server_id = '255817';
    $app_id = '796526';
    $git_url = 'git@github.com:sharjeelabedin/test.git';
    $branch_name = 'master';
    $cw_api = new CloudwaysAPIClient($email,$api_key);
    $gitpull = $cw_api->git_pull($server_id,$app_id,$git_url,$branch_name);
?>
