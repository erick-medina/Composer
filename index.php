<?php

declare(strict_types = 1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once(__DIR__.'/vendor/autoload.php');
use Monolog\Handler\BrowserConsoleHandler;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;


// create a log channel
$logInfo = new Logger('firstChannel');
$logInfo->pushHandler(new StreamHandler(__DIR__.'/logs/info.log', Logger::DEBUG));
$logInfo->pushHandler(new BrowserConsoleHandler(Logger::DEBUG));

$logWarning = new Logger('SecondChannel');
$logWarning->pushHandler(new StreamHandler(__DIR__.'/logs/warning.log', Logger::WARNING));

$logEmergency = new Logger('ThirdChannel');
$logEmergency->pushHandler(new StreamHandler(__DIR__.'/logs/emergency.log', Logger::EMERGENCY));

$logDanger = new Logger('ForthChannel');
$logDanger->pushHandler(new StreamHandler(__DIR__.'/logs/danger.log', Logger::ERROR));

$buttonName = $_POST['type'];
$inputMessage = $_POST['message'];

// add records to the log
switch ($buttonName) {
    case 'DEBUG':
        $logInfo->debug($inputMessage);
        break;
    case 'INFO':
        $logInfo->info($inputMessage);
        break;
    case 'NOTICE':
        $logInfo->notice($inputMessage);
        break;
    case 'WARNING':
        $logWarning->warning($inputMessage);
        break;
    case 'ERROR':
        $logDanger->error($inputMessage);
        break;
    case 'CRITICAL':
        $logDanger->critical($inputMessage);
        break;
    case 'ALERT':
        $logDanger->alert($inputMessage);
        break;
    case 'EMERGENCY':
        $logEmergency->emergency($inputMessage);
        break;

}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Logger</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" type="text/css"
          rel="stylesheet"/>
</head>
<body>
<form method="POST">
    <h1>Using Monolog with Composer</h1>

    <input type="text" name="message" placeholder="My log message" class="form-control" required />

    <button type="submit" name="type" value="DEBUG" class="btn btn-info">DEBUG (100): Detailed debug information.</button>
    <button type="submit" name="type" value="INFO" class="btn btn-info">INFO (200): Interesting events. Examples: User logs in, SQL logs.
    </button>
    <button type="submit" name="type" value="NOTICE" class="btn btn-info">NOTICE (250): Normal but significant events.
    </button>
    <button type="submit" name="type" value="WARNING" class="btn btn-warning">WARNING (300): Exceptional occurrences that are not errors. Examples: Use of deprecated APIs, poor use of an API, undesirable things that are not necessarily wrong.
    </button>
    <button type="submit" name="type" value="ERROR" class="btn btn-danger">ERROR (400): Runtime errors that do not require immediate action but should typically be logged and monitored.
    </button>
    <button type="submit" name="type" value="CRITICAL" class="btn btn-danger">CRITICAL (500): Critical conditions. Example: Application component unavailable, unexpected exception.
    </button>
    <button type="submit" name="type" value="ALERT" class="btn btn-danger">ALERT (550): Action must be taken immediately. Example: Entire website down, database unavailable, etc. This should trigger the SMS alerts and wake you up.
    </button>
    <button type="submit" name="type" value="EMERGENCY" class="btn btn-dark">EMERGENCY (600): Emergency: system is unusable.
    </button>
</form>
<style>
button {
    display: block;
    margin: 12px 0px;
    }
</style>

</body>
</html>