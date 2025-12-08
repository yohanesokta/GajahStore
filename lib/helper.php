<?php
function URL($url)
{
    return $url;
}

function Redirect($url)
{
    header("Location: $url");
    exit();
}

