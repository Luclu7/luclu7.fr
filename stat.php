<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 5//EN" "http://www.w3.org/TR/html5/strict.dtd">
<head>
<title>A propros de ce serveur</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="
sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
<?php
    $load = file_get_contents("/proc/loadavg");
    $load = explode(' ',$load);
    $load = $load[0];
    if (!$load && function_exists('exec')) {
        $reguptime=trim(exec("uptime"));
        if ($reguptime) if (preg_match("/, *(\d) (users?), .*: (.*), (.*), (.*)/",$reguptime,$uptime)) $load = $uptime[3];
    }

    $uptime_text = file_get_contents("/proc/uptime");
    $uptime = substr($uptime_text,0,strpos($uptime_text," "));
    if (!$uptime && function_exists('shell_exec')) $uptime = shell_exec("cut -d. -f1 /proc/uptime");
    $days = floor($uptime/60/60/24);
    $hours = str_pad($uptime/60/60%24,2,"0",STR_PAD_LEFT);
    $mins = str_pad($uptime/60%60,2,"0",STR_PAD_LEFT);
    $secs = str_pad($uptime%60,2,"0",STR_PAD_LEFT);

    $phpver = shell_exec("php phpver.php|cut -c1-6");
    $mysqlver = shell_exec("mysql --version| cut -c12-31");

   
    echo "<h1 class=\"text-center\">$days jours, $hours H $mins et $secs secondes d'uptime\n</h1>";
	echo "<h2 class=\"text-center\"><br>Avec PHP $phpver et MariaDB $mysqlver\n</h2><br><br><h3 class=\"text-center\">Load average: $load</h3>";
?>

<!-- Code by Luclu7 (@Luclu7Gaming), it's not very good but it work ! -->
</body>