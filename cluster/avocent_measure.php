#!/usr/bin/php
<?php
/* 
 * input current watts = .1.3.6.1.4.1.476.1.42.3.8.30.20.1.65.1.1
 * input current 0.01 amps = .1.3.6.1.4.1.476.1.42.3.8.30.40.1.22.1.1.1
 * input voltage 0.1 Volts = .1.3.6.1.4.1.476.1.42.3.8.30.40.1.61.1.1.1
 * branch1 current 0.01 Amp = .1.3.6.1.4.1.476.1.42.3.8.40.20.1.130.1.1
 * branch2 current 0.01 Amp = .1.3.6.1.4.1.476.1.42.3.8.40.20.1.130.1.2
 * branch3 current 0.01 Amp = .1.3.6.1.4.1.476.1.42.3.8.40.20.1.130.1.3
 */
function snmp_get_value($host, $community, $oid) 
{
    $v = snmpget($host,$community,$oid);
    $value = split(": ",$v,2);

    return $value[1];
};

$host = $argv[1];
$port = $argv[2];
// Verify hostname is good
$ip = gethostbyname($host);
if($ip == $host) { // Failure if returns unmodifed hostname
    print "Usage: $argv[0] hostname\n\n";
    return;
}

$community = "Power_Table";
//$oid_input_watts = ".1.3.6.1.4.1.476.1.42.3.8.30.20.1.65.1.1";
//$oid_input_amps = ".1.3.6.1.4.1.476.1.42.3.8.30.40.1.22.1.1.1";
//$oid_input_volts = ".1.3.6.1.4.1.476.1.42.3.8.30.40.1.61.1.1.1";
//$oid_branch1_amps = ".1.3.6.1.4.1.476.1.42.3.8.40.20.1.130.1.1";
//$oid_branch2_amps = ".1.3.6.1.4.1.476.1.42.3.8.40.20.1.130.1.2";
//$oid_branch3_amps = ".1.3.6.1.4.1.476.1.42.3.8.40.20.1.130.1.3";
$oid_power_port = ".1.3.6.1.4.1.10418.17.2.5.5.1.60.1.1.";
$oid_power_port = $oid_power_port.$port;
$value_power_port = snmp_get_value($host, $community, $oid_power_port);
print "$value_power_port \n";

//$input_watts = snmp_get_value($host,$community, $oid_input_watts);
//$input_amps = snmp_get_value($host,$community,$oid_input_amps)/100;
//$input_volts = snmp_get_value($host,$community,$oid_input_volts)/10;
//$branch1_amps = snmp_get_value($host,$community,$oid_branch1_amps)/100;
//$branch2_amps = snmp_get_value($host,$community,$oid_branch2_amps)/100;
//$branch3_amps = snmp_get_value($host,$community,$oid_branch3_amps)/100;
//$branch1_watts = $input_volts * $branch1_amps;
//$branch2_watts = $input_volts * $branch2_amps;
//$branch3_watts = $input_volts * $branch3_amps;

//$time = strftime("%F-%T");
//print "$time,$host,$branch1_amps,$branch1_watts,$branch2_amps,$branch2_watts,$branch3_amps,$branch3_watts\n";

?>