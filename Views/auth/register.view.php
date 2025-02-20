<?php
include_once 'Views/partials/header.view.php';
?>
<div class="flex items-center py-4 bg-gray-100 w-1/2 justify-center mx-auto">
    <main class="w-full mx-auto">
        <form action="/auth/register" method="POST" class="bg-white p-6 rounded-lg shadow-md">
            <h1 class="text-2xl font-semibold text-center mb-3">Inscription</h1>

            <div class="mb-3">
                <label for="floatingFirstName" class="block text-sm font-medium text-gray-700">Prénom</label>
                <input type="text" id="floatingFirstName" name="first_name" placeholder="Marc" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="mb-3">
                <label for="floatingLastName" class="block text-sm font-medium text-gray-700">Nom de famille</label>
                <input type="text" id="floatingLastName" name="last_name" placeholder="Dupuis" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="mb-3">
                <label for="floatingEmail" class="block text-sm font-medium text-gray-700">Adresse mail</label>
                <input type="email" id="floatingEmail" name="email" placeholder="name@example.com" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="mb-3">
                <label for="floatingPassword" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                <input type="password" id="floatingPassword" name="password" placeholder="Mot de passe" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
            
            <p class="text-sm text-gray-600">Tu as déja un compte? <a href="/auth/login" class="text-blue-600 hover:underline">Connexte toi</a></p>
            
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 mt-3">Connexion</button>
            
            <p class="mt-5 text-center text-sm text-gray-500">© 2017–2025</p>
        </form>
    </main>
</div>
<?php
include_once 'Views/partials/footer.view.php';