<?php

if($_SESSION['user']){
    echo "<script>THIS_IS_ME={$_SESSION['user']->id}</script>";
    echo '<iframe id="chatIframe" src="http://localhost:3001/?'.$_SESSION['user']->id.'" width="300" height="300"></iframe>';
}