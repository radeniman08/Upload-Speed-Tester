<?php

function to_bytes($val)
{
    $sSuffix = strtoupper(substr($val, -1));
    if (!in_array($sSuffix, array('P', 'T', 'G', 'M', 'K'))) {
        return (int)$val;
    }
    $iValue = substr($val, 0, -1);
    switch ($sSuffix) {
        case 'G':
            $iValue *= 1024;
            // Fallthrough intended
        case 'M':
            $iValue *= 1024;
            // Fallthrough intended
        case 'K':
            $iValue *= 1024;
            break;
    }
    return (int)$iValue;
}

function to_human($bytes, $precision = 2)
{
    $unit = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB');

    return @round(
        $bytes / pow(1024, ($i = floor(log($bytes, 1024)))),
        $precision
    ) . ' ' . $unit[$i];
}
