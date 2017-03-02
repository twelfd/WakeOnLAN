<?php

//require_once __DIR__.'/../PHPGangsta/WakeOnLAN.php';
function wakeUp($macAddressHexadecimal, $broadcastAddress)
    {
        $macAddressHexadecimal = str_replace(':', '', $macAddressHexadecimal);

        // check if $macAddress is a valid mac address
        if (!ctype_xdigit($macAddressHexadecimal)) {
            throw new \Exception('Mac address invalid, only 0-9 and a-f are allowed');
        }

        $macAddressBinary = pack('H12', $macAddressHexadecimal);

        $magicPacket = str_repeat(chr(0xff), 6).str_repeat($macAddressBinary, 16);
        echo $magicPacket;
        //$fp = fopen("test.txt","w");
        if (!$fp = fsockopen('udp://' . $broadcastAddress, 9, $errno, $errstr, 2)) {
            throw new \Exception("Cannot open UDP socket: {$errstr}", $errno);
        }
        fputs($fp, $magicPacket);
        fclose($fp);
    }
echo "hello";
wakeUp('78:24:AF:xx:xx:xx', '192.168.1.255');
