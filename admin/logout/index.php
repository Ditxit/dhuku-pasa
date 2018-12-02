<?php
  session_start();
  unset($_SESSION['adminname']);
  unset($adminname);
  session_destroy();
  
  session_start();
  $_SESSION['message'] = "<span style='color:#0f0;'>Logging out success</span>";
  header("location: ../login/");
  exit;
?>