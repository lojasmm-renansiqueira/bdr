<?

$loggedSession = (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true);
$loggedCookie = (isset($_COOKIE['Loggedin']) && $_COOKIE['Loggedin'] == true);

if ($loggedSession || $loggedCookie) 
{
    header("Location: http://www.google.com");
    exit();
}