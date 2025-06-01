<?php

function dateConvert(string|null $dateAndOrTime, string $format = "Y-m-d H:i:s")
{
    if (!$dateAndOrTime)
        return null;
    return (new DateTime($dateAndOrTime))->format($format);
}
