<?php

function formatDate($dateStr)
{
    if (strlen($dateStr) == 14) {
        $year = substr($dateStr, 0, 4);
        $month = substr($dateStr, 4, 2);
        $day = substr($dateStr, 6, 2);
        $hour = substr($dateStr, 8, 2);
        $minute = substr($dateStr, 10, 2);
        $second = substr($dateStr, 12, 2);

        $formattedDate = "$day.$month.$year $hour:$minute:$second";

        return $formattedDate;
    } else if (strlen($dateStr) == 19){
        $date = new DateTime($dateStr);
        $formattedDate = $date->format('d.m.Y H:i:s');

        return $formattedDate;
    } else if (strlen($dateStr) == 10){
        $date = new DateTime($dateStr);
        $formattedDate = $date->format('d.m.Y');

        return $formattedDate;
    } else {
        return $dateStr;
    }
}