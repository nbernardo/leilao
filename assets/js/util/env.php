<?php

$serverRoot = FacadePrincipal::baseURL();

echo "
<script>
    APP_ROOT_DIR = '{$serverRoot}';
    GATEWAY = APP_ROOT_DIR+'controllerGateway.php';
</script>
";