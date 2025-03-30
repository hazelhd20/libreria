<?php
session_start();
session_destroy();
echo "
  <script>
    alert('Ahora ya saliste del sistema');
    location.href = 'index.php';
  </script>";
?>