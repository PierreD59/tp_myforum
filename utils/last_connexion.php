<?php
$query = $database->query('SELECT * FROM `users`');
$data = $query->fetch();

if (isset( $_SESSION['pseudo'])) {
    $updateTime = $database->prepare('UPDATE `users` SET `last_connection` = NOW() WHERE `id` =' . $_SESSION['id']);
        $updateTime->execute();
        return $updateTime;
}

?>