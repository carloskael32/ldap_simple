<?php

$domain = 'bdp.com.bo';
$username = 'cmamani';
$password = 'S#V_2236rdo';
$ldapconfig['host'] = '10.1.6.4';
$ldapconfig['port'] = 389;
$ldapconfig['basedn'] = 'dc=bdp,dc=com,dc=bo';

$ds=ldap_connect($ldapconfig['host'], $ldapconfig['port']);
ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);

$dn="ou=Technology,".$ldapconfig['basedn'];
$bind=ldap_bind($ds, $username .'@' .$domain, $password);
$isITuser = ldap_search($bind,$dn,'(&(objectClass=User)(sAMAccountName=' . $username. '))');
if ($isITuser) {
    echo("Login correct");
} else {
    echo("Login incorrect");
}
