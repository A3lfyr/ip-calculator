<?php 
if(isset($_GET['ip']) && $_GET['ip']!=""){
    $ip = $_GET['ip'];
} else {
    $ip = "192.168.0.1";
}
if(isset($_GET['slashnetmask']) && $_GET['slashnetmask']!=""){
    $slashnetmask = $_GET['slashnetmask'];
} else {
    $slashnetmask = "/24";
}

$binary_ip = ip2binary($ip);

$netmask_size = remove_slash($slashnetmask);
$binary_netmask = get_binary_netmask($netmask_size);
$netmask = ip2dec($binary_netmask);

$binary_wildcard = get_binary_wildcard($binary_netmask);
$wildcard = ip2dec($binary_wildcard);

$binary_network = get_binary_network($binary_ip, $binary_netmask);
$network = ip2dec($binary_network);
$net_class = get_ip_class($binary_network);

$binary_hostmin = get_binary_hostmin($binary_network);
$hostmin = ip2dec($binary_hostmin);

$binary_broadcast = get_binary_broadcast($binary_network, $binary_wildcard);
$broadcast = ip2dec($binary_broadcast);

$binary_hostmax = get_binary_hostmax($binary_network, $binary_netmask);
$hostmax = ip2dec($binary_hostmax);

$nbOfHosts = get_hosts_number($netmask_size);

if(is_private_network($binary_network)){
    $isPrivateNetwork = '(<a href="http://www.ietf.org/rfc/rfc1918.txt">Private Internet</a>)';
} else {
    $isPrivateNetwork = "";
}
?>