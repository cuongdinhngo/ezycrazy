<?php if (isset($_SESSION["jsVariables"])) {
    echo $_SESSION["jsVariables"];
    unset($_SESSION["jsVariables"]);
}
