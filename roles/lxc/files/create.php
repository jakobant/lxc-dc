<head>
</head>

<body>
<?php
/**
 * Created by Joe of ExchangeCore.com, 
 * Mod by kobbi
 */
if(isset($_POST['username']) && isset($_POST['password'])){

    /*$adServer = "ldap://ldapserver";
	
    $ldap = ldap_connect($adServer);
    $username = $_POST['username'];
    $password = $_POST['password'];

    $ldaprdn = 'domain' . "\\" . $username;

    ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);

    $bind = @ldap_bind($ldap, $ldaprdn, $password);
     */
    $bind = true;

    if ($bind) {
        /*
        $filter="(sAMAccountName=$username)";
        $result = ldap_search($ldap,"dc=EXAMPLE,dc=COM",$filter);
        ldap_sort($ldap,$result,"sn");
        $info = ldap_get_entries($ldap, $result);
        for ($i=0; $i<$info["count"]; $i++)
        {
            if($info['count'] > 1)
                break;
            echo "<p>Hi <strong> ". $info[$i]["givenname"][0] ." ". $info[$i]["sn"][0] ."</strong><br /> (" . $info[$i]["samaccountname"][0] .")</p>\n";
            echo '<pre>';
            //var_dump($info);
            echo '</pre>';
            $userDn = $info[$i]["distinguishedname"][0]; 
        }
        @ldap_close($ldap);*/
	if ($_POST['a'] == 'rd') {
 	   echo "Delete and create : ".$_POST["n"];
           $output = shell_exec('sudo /usr/bin/lxc-rebuild '.$_POST["n"]);
	   echo "<pre>$output</pre>";
	}
        $output = shell_exec('sudo /usr/bin/lxc-fancy -j |sudo tee /var/www/html/lxc.json > /dev/null');
	echo "<pre>$output</pre>";
 	sleep(2);
        echo "<script type='text/javascript'>\n";
	echo "window.close();\n";
 	echo "window.opener.location.reload(true);";
	echo "</script>";
    } else {
        $msg = "Wrong username or password...";
        echo $msg;
    }

}else{
?>
    <form action="#" method="POST">
        <b>Hi, your wish is my command:<br>
	Please not that destroy-create-init will take few minutes....
	<br>Please login:</b><br>
        <label for="username">Username: </label><input id="username" type="text" name="username" /> <br>
        <label for="password">Password: </label><input id="password" type="password" name="password" />        <input type="submit" name="submit" value="Submit" />
  	<input id="n" type="hidden" name="n" value="<?php echo $_GET["n"]?>">
  	<input id="a" type="hidden" name="a" value="<?php echo $_GET["a"]?>">
    </form>
<?php } ?> 
</body>

