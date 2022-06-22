<?php
$ldaprdn  = 'carlos.mamani@bdp.com.bo'; // ldap rdn or dn
$ldappass = 'S#V_2236rdo';  // associated password


$ldapconn = ldap_connect('10.1.6.4') or die("Could not connect to LDAP server.");
ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
ldap_set_option($ldapconn, LDAP_OPT_REFERRALS, 0);
if ($ldapconn) {
	// realizando la autenticación
	try {
		$ldapbind = @ldap_bind($ldapconn, $ldaprdn, $ldappass);
	} catch (Exception $exc) {
		echo "errossssr";
	}
	if ('10.1.6.4') {

		$result = ldap_search($ldapconn, "dc=bdp, dc=com, dc=bo", "(userprincipalname=$ldaprdn)");
		$entries = ldap_get_entries($ldapconn, $result);

		$userDN = $entries[0]["description"][0];
		echo ('<p style="color:green;">El DN del usuario: ' . $userDN . '</p>');
		for ($ligne = 0; $ligne < $entries["count"]; $ligne++) {
			for ($colonne = 0; $colonne < $entries[$ligne]["count"]; $colonne++) {
				$data = $entries[$ligne][$colonne];
				echo $data . ":" . $entries[$ligne][$data][0] . "<BR><br>";
			}
		}
	} else {
		echo "error";
	}

	ldap_close($ldapconn);
} else {
	echo "Error";
}
?>