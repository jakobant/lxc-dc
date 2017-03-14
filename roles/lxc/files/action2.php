<head>
<script type="text/javascript">
    function refreshAndClose() {
	opener.location.href = opener.location.href;
        window.close();
    }
</script>
</head>

<body onbeforeunload="refreshAndClose();">
<?php
/**
 * Created by Joe of ExchangeCore.com
 */
if(isset($_POST['username']) && isset($_POST['password'])){

    $adServer = "ldap://ldapserver";
	
    $ldap = ldap_connect($adServer);
    $username = $_POST['username'];
    $password = $_POST['password'];

    $ldaprdn = 'domain' . "\\" . $username;

    ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);

    $bind = @ldap_bind($ldap, $ldaprdn, $password);


    if ($bind) {
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
        @ldap_close($ldap);
	if ($_POST['a'] == 'stop') {
 	   echo "Stopping : ".$_POST["n"];
           $output = shell_exec('sudo /usr/bin/lxc-stop -k -n '.$_POST["n"]);
	   echo "<pre>$output</pre>";
	}
	if ($_POST['a'] == 'start') {
 	   echo "Starting : ".$_POST["n"];
           $output = shell_exec('sudo /usr/bin/lxc-start -d -n '.$_POST["n"]);
	   echo "<pre>$output</pre>";
	}
        $output = shell_exec('sudo /usr/bin/lxc-fancy -j |sudo tee /var/www/html/lxc.json > /dev/null');
	echo "<pre>$output</pre>";
        echo  "<script type='text/javascript'>";
	echo "window.close();";
	echo "</script>";
    } else {
        $msg = "Wrong username or password...";
        echo $msg;
    }

}else{
?>
    <form action="#" method="POST">
        <b>Hi, you action need more permissions </b><br>
        <label for="username">Username: </label><input id="username" type="text" name="username" /> <br>
        <label for="password">Password: </label><input id="password" type="password" name="password" />        <input type="submit" name="submit" value="Submit" />
  	<input id="n" type="hidden" name="n" value="<?php echo $_GET["n"]?>">
  	<input id="a" type="hidden" name="a" value="<?php echo $_GET["a"]?>">
    </form>
<?php } ?> 
</body>
<b>You wish</b>

