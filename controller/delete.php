<?php  

require 'functions.php';

$id = $_GET['id'];

if (delete($id) > 0) {
  header("Location: ../index.php");
} else {
  echo "gagal";
}

?>