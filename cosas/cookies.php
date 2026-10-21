<?php

if (isset($_COOKIE["nombre"])) {
    setcookie("nombre", "Pepito conejo", time() - 60);
    print "<p>Su nombre es $_COOKIE[nombre]</p>\n";
} else {
    setcookie("nombre", "Pepito conejo", time() - 120);
    print "<p>NO se su nombre</p>\n";
}

?>