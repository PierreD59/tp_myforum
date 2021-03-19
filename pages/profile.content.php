<?php 
// Calls up the content of the user in relation to its ID
$query = $database->query('SELECT * FROM `users` WHERE `id` =' . $_GET['id']);
$data = $query->fetch()
?>
<div class="home">

<h1>Page de profile</h1>
<hr>
<div class="profileBlock">

    <div class="row p-3 m-0">
        <div class="detailProfile col-md-8 border-end">
            <h2>Information de user</h2>
            <ul>
                <li>Adresse mail : </li>
                <li>Date d'inscription : </li>
                <li>Messages : </li>              
            </ul>
        </div>
        <div class="imgProfile col-md-4">
            <h2>Photo de Profil</h2>
        </div>

    </div>

</div>


</div>