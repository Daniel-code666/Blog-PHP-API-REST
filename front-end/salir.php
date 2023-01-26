<?php
session_start();
session_destroy();
header("Location: http://localhost:8080/Cosas/blog_api/front-end/acceder.php");