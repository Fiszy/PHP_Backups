<?php

@$http_client_ip = $_SERVER['HTTP_CLIENT_IP'];
@$http_forwarded_for = $_SERVER['HTTP_FORWARDED_IP'];
$remote_addr = $_SERVER['REMOTE_ADDR'];

if (!emtpy($http_client_ip)){
    $ip = $http_client_ip;
}
elseif(!emtpy($http_forwaded_for)){
    $ip = $http_forwaded_for;

}
else{
    $ip = $_SERVER['REMOTE_ADDR'];
}

?>

echo $ip;