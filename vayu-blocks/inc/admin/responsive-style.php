<?php

function vayu_blocks_desktop( $style = '' ) {
    $media = "@media only screen and (min-width: 1025px) {\n{$style}\n}";

    return $media;
}

function vayu_blocks_tablet( $style = '' ) {

    $media = "@media only screen and (min-width: 601px) and (max-width: 1024px) {\n{$style}\n}";

    return $media;
}

function vayu_blocks_mobile( $style = '' ) {
    $media = "@media only screen and (max-width: 600px) {\n{$style}\n}";
    return $media;

}