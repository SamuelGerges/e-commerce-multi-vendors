<?php

//define('PAGINATION_COUNT', 5);

const PAGINATION_COUNT = 5;
function getFolder()
{
    return app()->getLocale() == 'ar' ? 'css-rtl' : 'css';
}
