<?php
//セッションをクリアして最初の画面。

session_start();

session_destroy();

header('Location: /php2');
