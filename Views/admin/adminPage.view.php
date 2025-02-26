<?php
include_once 'Views/partials/header.view.php';
?>
<main class="container mx-auto p-6">
    <div class="flex space-x-4 bg-gray-100 p-4 rounded-lg shadow-md">
        <a href="/admin/users" class="text-blue-600 hover:underline">Gestion des utilisateurs</a>
        <a href="/admin/usager" class="text-blue-600 hover:underline">Gestion des usagers</a>
        <a href="/admin/category" class="text-blue-600 hover:underline">Gestion des catégories</a>
        <a href="/admin/prestation" class="text-blue-600 hover:underline">Gestion des prestations</a>
        <a href="/admin/tarif" class="text-blue-600 hover:underline">Gestion des tarif</a>
        <a href="/admin/ticket" class="text-blue-600 hover:underline">Gestion des ticket</a>
        <a href="/admin/droits" class="text-blue-600 hover:underline">Gestion des droits</a>
        <a href="/admin/depot" class="text-blue-600 hover:underline">Gestion des depot</a>
    </div>
</main>
<?php
include_once 'Views/partials/footer.view.php';
