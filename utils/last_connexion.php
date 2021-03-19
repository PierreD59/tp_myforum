<?php
if (isset( $_SESSION['pseudo'])) {
    $updateTime = $database->prepare('UPDATE `users` SET `last_connection` = NOW()');
        $updateTime->execute();
        return $updateTime;
}

?>