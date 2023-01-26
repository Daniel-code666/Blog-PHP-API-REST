<?php

function formatDate($date)
{
    return date('d M, Y, g:i a', strtotime($date));
}

function cutText($text, $chars = 100)
{
    $text = $text."";
    $text = substr($text, 0, $chars);
    $text = substr($text, 0, strrpos($text, ''));
    $text = $text."...";
    return $text;
}
