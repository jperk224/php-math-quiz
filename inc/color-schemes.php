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
// 1. Main: #1ECBE1 Button: #E11ECB Font: #CBE11E
// 2. Main: #32CDBD Button: #BD32CD Font: #BD32CD
// 3. Main: #43bc91 Button: #BC9143 Font: #9143BC


// Display one of 3 schemes based on randomization
function chooseRandomScheme() {
    $colorSchemeNumber = rand(1,3);   // randomly choose one of three schemes
    switch($colorSchemeNumber) {
        case 1: // Good
            cssApplicator("body", "background-color", "#1ECBE1");
            cssApplicator("body", "color", "#E11ECB");
            cssApplicator(".btn", "background-color", "#CBE11E");
            cssApplicator(".btn", "color", "#E11ECB");
            cssApplicator(".btn", "border", "none");      // remove the button border
            break;
        case 2: // Good
            cssApplicator("body", "background-color", "#32CDBD");
            cssApplicator("body", "color", "#BD32CD");
            cssApplicator(".btn", "background-color", "#CDBD32");
            cssApplicator(".btn", "color", "#BD32CD");
            cssApplicator(".btn", "border", "none");
            break;
        case 3: // Good
        default:    // default should not be reached, but included as fallback
            cssApplicator("body", "background-color", "#43bc91");
            cssApplicator("body", "color", "#9143BC");
            cssApplicator(".btn", "background-color", "#BC9143");
            cssApplicator(".btn", "color", "#9143BC");
            cssApplicator(".btn", "border", "none");
            break;
    }
    return;
}
