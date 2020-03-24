<?php

// Functions to implement random color schemes to improve look/feel of the quiz app
// include this in header.php
// leverages the header style tag that take priority over external stylesheet

function cssApplicator($selector, $property, $value) {
    echo $selector . '{' . $property . ':' . $value . '}';
    return;     // clear the stack frame
}

// schemes taken from triadic color theory
// (https://www.canva.com/colors/color-wheel/)
// Shades adjusted to keep contrast raio greater than 3.0


// Display one of 3 schemes based on randomization
function chooseRandomScheme() {
    $colorSchemeNumber = rand(1,3);   // randomly choose one of three schemes
    switch($colorSchemeNumber) {
        case 1:
            cssApplicator("body", "background-color", "#1ECBE1");
            cssApplicator("body", "color", "#595959");
            cssApplicator(".btn", "background-color", "#AF189D");
            cssApplicator(".btn", "color", "#FFF");
            cssApplicator(".btn", "border", "none");      // remove the button border
            break;
        case 2: 
            cssApplicator("body", "background-color", "#32CDBD");
            cssApplicator("body", "color", "#90269C");
            cssApplicator(".btn", "background-color", "#CDBD32");
            cssApplicator(".btn", "color", "#9F2AAC");
            cssApplicator(".btn", "border", "none");
            break;
        case 3:
        default:    // default should not be reached, but included as fallback
            cssApplicator("body", "background-color", "#43bc91");
            cssApplicator("body", "color", "#743696");
            cssApplicator(".btn", "background-color", "#BC9143");
            cssApplicator(".btn", "color", "#612D7C");
            cssApplicator(".btn", "border", "none");
            break;
    }
    return;
}
