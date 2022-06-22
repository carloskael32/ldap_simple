<?php

$ldapconn = ldap_connect("10.1.6.4")
or die("Could not connect to LDAP server.");
$ldaprdn = "c";
$ldappass = "S#V_2236rdo";

if ($ldapconn) {

    // binding to ldap server

    $ldapbind = @ldap_bind($ldapconn, $ldaprdn, $ldappass);
  

    // verify binding
    if ($ldapbind) {
        echo "LDAP bind successful...";

       
        
    } else {
        echo "LDAP bind failed...";
    }
}
