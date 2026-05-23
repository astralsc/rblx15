<?php
session_start();
$config = include_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';

foreach (glob($_SERVER['DOCUMENT_ROOT'] . '/config/classes/*.php') as $class) {
    include_once $class;
}
foreach (glob($_SERVER['DOCUMENT_ROOT'] . '/Assemblies/Roblox/Grid/Rcc/*.php') as $soapClass) {
    include_once $soapClass;
}
try {
    $pdo = new PDO(
        "mysql:host=" . config['database']['host'] . ";dbname=" . config['database']['database'],
        config['database']['user'],
        config['database']['password'],
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    header('Content-Type: application/json');
    exit(json_encode(['error' => "true", "message" => "Database Error. Please Contact Administrator"])); //$e->getMessage()
}

if (config["site"]["maintenance"] and !$_SESSION["devpass"]) {
    header('Content-Type: application/json');
    exit(header("Location: /maintentance"));
}

function checkPort($portToCheck)
{
    exec('netstat -an | find "' . $portToCheck . '"', $output);
    if (empty($output)) {
        return false;
    } else {
        return true;
    }
}

function stopRcc($port)
{
    $port = (int)$port;
    $processName = 'RCCService.exe';
    $argString = '-console ' . $port . '';
    exec("wmic process where name='$processName' get processid, commandline", $output);
    foreach ($output as $line) {
        if (strpos($line, $argString) !== false) {
            preg_match('/(\d+)$/', $line, $matches);
            $pid = $matches[1];
            exec("taskkill /f /PID $pid");
        }
    }
}
function execEXE($filePath, $workingDirectory, $arguments)
{
    $WshShell = new COM("WScript.Shell");
    $cmd = "$filePath $arguments";
    $WshShell->Run("cmd /C \"start /B $cmd\"", 0, false);
}
