<?php

$domain = 'bdp.com.bo';
$ldaprdn  = 'cmamani'; // ldap rdn or dn
$ldappass = 'S#V_2236rdo';  // associated password

$ldapconn = ldap_connect('10.1.6.4') or die("Could not connect to LDAP server.");
ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
ldap_set_option($ldapconn, LDAP_OPT_REFERRALS, 0);
if ($ldapconn) {
    // realizando la autenticación
    //$ldapbind = ldap_bind($ldapconn, $ldaprdn, $ldappass);
    $ldapbind=ldap_bind($ldapconn, $ldaprdn .'@' .$domain, $ldappass);
    
    if ($ldapbind) {

        $result = ldap_search($ldapconn, "dc=bdp, dc=com, dc=bo", "(samaccountname=$ldaprdn)");

        $entries = ldap_get_entries($ldapconn, $result);


        $arr = array(
            $userDN = $entries[0]["description"][0],
            $userDN2 = $entries[0]["physicaldeliveryofficename"][0],
            $userDN3 = $entries[0]["displayname"][0],
            $userDN4 = $entries[0]["samaccountname"][0],
            $userDN5 = $entries[0]["mail"][0],
            $userDN6 = $entries[0]["distinguishedname"][0],

        );

        $separador = ",";
        $separada = explode($separador, $userDN6);
        $n = $separada[1];
        $separador2 = " ";
        $sep2 = explode($separador2, $n);

        echo $sep2[1];

        echo print_r($arr);

        //print_r($separada);
    } else {
        echo "error de datos de usuario";
    }

    ldap_close($ldapconn);
} else {
    echo "Error de servidor";
}
