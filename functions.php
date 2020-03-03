<?php

    //remove slash in a string (useful with netmask ex: /24 => 24)
    function remove_slash ($str)
    {
        $res = ltrim($str, '/'); 
        return $res;
    }

    //add dot in a binary ip (every 8 bits)
    function get_pointed_ip($binary_ip){
        $pointed_ip = "";
        for($i=0; $i<32; $i++){
            if($i%8 == 0 && $i>0){
                $pointed_ip .= ".";
            }
            $pointed_ip .= $binary_ip[$i];
        }
        return $pointed_ip;
    }

    //convert an decimal doted ip into a binary undoted ip
    function ip2binary ($dec_ip)
    {
        $ip_ex = explode('.', $dec_ip);

        $binary_ip = "";
        for($i = 0; $i <= 3; $i++){
            $binary_ip .= sprintf('%08b',  $ip_ex[$i]);
        }

        return $binary_ip;
    }

    //convert an ip undoted ip into a decimal doted ip
    function ip2dec ($binary_ip)
    {
        $ip_ex = explode(".", get_pointed_ip($binary_ip));
        $dec_ip = bindec($ip_ex[0]);
        for($i=1; $i<=3; $i++){
            $dec_ip .= "." . bindec($ip_ex[$i]);
        }
        
        return $dec_ip;
    }

    //return a binary netmask form a slahed netmask
    function get_binary_netmask ($dec_netmask)
    {
        $binary_netmask = "";
        for($i=0; $i<$dec_netmask; $i++){
            $binary_netmask .= 1;
        }
        for($i=$dec_netmask; $i<32; $i++){
            $binary_netmask .= 0;
        }
        return $binary_netmask;
    }

    //return a binary wildcard form a binary netmask
    function get_binary_wildcard($binary_netmask)
    {
        $binary_wildcard = "";
        for($i=0; $i<32; $i++){
            $binary_wildcard .= sprintf('%01b',  (!$binary_netmask[$i]));
        }

        return $binary_wildcard;
    }

    //return a binary network address from a binary ip adress and a binary netmask
    function get_binary_network ($binary_ip, $binary_netmask)
    {
        $binary_network = "";
        for($i=0; $i<32; $i++){
            $binary_network .= sprintf('%01b',  ($binary_ip[$i] && $binary_netmask[$i]));
        }

        return $binary_network;
    }

    //return A, B, C, D or E (the ip class of a network address)
    function get_ip_class($binary_network)
    {
        $nb = 0;
        while ($binary_network[$nb] == 1 && $nb <32) {
            $nb++;
        }

        switch ($nb) {
            case 0:
                $ip_class = 'A';
                break;

            case 1:
                $ip_class = 'B';
                break;

            case 2:
                $ip_class = 'C';
                break;

            case 3:
                $ip_class = 'D';
                break;
            
            default:
                $ip_class = "E";
                break;
        }

        return $ip_class;
    }

    //return the binary broadcast address of a network
    function get_binary_broadcast($binary_network, $binary_wildcard)
    {
        $binary_broadcast = "";
        for($i=0; $i<32; $i++){
            $binary_broadcast .= sprintf('%01b',  ($binary_network[$i] || $binary_wildcard[$i]));
        }

        return $binary_broadcast;
    }

    // return the binary address of the min host in a network
    function get_binary_hostmin($binary_network)
    {
        $ip_ex = explode('.', get_pointed_ip($binary_network));
        $ip_ex[3] = sprintf('%08b',  $ip_ex[3]+1);

        return implode("", $ip_ex);
    }

    //return the binary address of the max host in a network
    function get_binary_hostmax ($binary_network, $binary_netmask)
    {
        $binary_wildcard = get_binary_wildcard($binary_netmask);
        $binary_broadcast = get_binary_broadcast($binary_network , $binary_wildcard);
        
        $binary_hostmax = $binary_broadcast;
        $binary_hostmax[31] = 0;

        return $binary_hostmax;
    }

    //return the number of possibles hosts in a network
    function get_hosts_number ($netmask_size) 
    {
        return pow(2,32-$netmask_size);
    }

    //return true if the network is a private network
    function is_private_network($binary_network)
    {
        $private = false;
        if(strncmp($binary_network, "00001010", 8)==0 || strncmp($binary_network, "101011000001", 12)==0 || strncmp($binary_network, "1100000010101000", 16)==0){
            $private = true;
        }

        return $private;
    }

    /* 
    RESEAUX PRIVES
    */
?>
