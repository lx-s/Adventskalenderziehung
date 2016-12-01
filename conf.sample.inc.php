<?php

  // --------------------------------------------------------------------------
  // General
  define('PAGE_TITLE', '');

  // --------------------------------------------------------------------------
  // Mail config
  define('MAIL_HOST', 'smtp.example.org');
  define('MAIL_USER', 'example');
  define('MAIL_PASS', '3x4mpl3!');
  define('MAIL_FROM_NAME', 'Advents-Bot');
  define('MAIL_FROM_ADDRESS', 'bot@example.org');
  define('MAIL_SUBJECT', 'A new winner is here!');

  // --------------------------------------------------------------------------
  // Date Range
  define('DATE_RANGE_ACTIVE', true);
  define('DATE_RANGE_START', '2016-12-01');
  define('DATE_RANGE_END', '2016-12-24');

  // --------------------------------------------------------------------------
  // Colleagues, etc.

  $colleagues = array(
    array('name' => 'John Smith', 'email' => 'john.smith@example.org')
  );

  $banter = array(
      'Happy eating!'
    , 'Congrats!'
  );
