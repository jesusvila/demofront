<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Demo desarrollo</title>
</head>

<body>

    <?php
    $version = "1.0";
    echo "<p>Frontend: " . $_SERVER['HTTP_HOST'] . "</p>";
    echo "<p>Frontend versión: " . $version . "</p>";
    echo "<p>Backend: " . GetBackHostname() . "</p>";
    ?>
</body>

</html>

<?php
function GetBackHostname()
{
    $url = "http://127.0.0.1:8001";
    $headers[] = "Action:getBackendHostname";
    $client = curl_init($url);
    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($client, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($client, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($client, CURLOPT_TIMEOUT, 30);
    $response = curl_exec($client);
    $result = json_decode($response);
    curl_close($client);
    if ($result->code == "200") {
        return $result->hostname;
    }
}
?>