<?php
include_once 'Views/partials/header.view.php';
?>
<main class="min-h-screen bg-gray-100 flex flex-col items-center p-6">
    <div class="w-full max-w-2xl bg-white shadow-lg rounded-xl p-6 text-center">
        <!-- Message indiquant si connecté ou non -->
        <?php if(isset($_SESSION['user_id'])) { ?>
            <h1 class="text-2xl font-bold text-green-600">Bienvenue!</h1>
            <p class="text-lg text-gray-700">T'es chez les cools ici :)</p>
        <?php } else { ?>
            <h1 class="text-2xl font-bold text-red-600">Tu n'es pas connecté</h1>
            <p class="text-lg text-gray-700">Crée un compte ou connecte-toi</p>
            <div class="mt-4 flex justify-center space-x-4">
                <a href="/auth/login" class="px-4 py-2 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600">Connexion</a>
                <a href="/auth/register" class="px-4 py-2 bg-green-500 text-white rounded-lg shadow hover:bg-green-600">Inscription</a>
            </div>
        <?php } ?>
    </div>
    
    <div class="w-full max-w-4xl mt-8">
        <!-- Les prix -->
        <div class="overflow-hidden rounded-xl shadow-lg bg-white p-6">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="p-3 text-gray-700">Prestation</th>
                        <th class="p-3 text-gray-700">Catégorie</th>
                        <th class="p-3 text-gray-700">Prix</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($prestationsListe as $prestation) { ?>
                        <tr class="border-t border-gray-300 hover:bg-gray-100">
                            <td class="p-3 text-gray-800"><?= $prestation['prestation']['type_prestation'] ?></td>
                            <td class="p-3 text-gray-800"><?= $prestation['categorie']['libelle_categorie'] ?></td>
                            <td class="p-3 text-gray-800 font-semibold"><?= $prestation['prix'] ?>€</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<?php
include_once 'Views/partials/footer.view.php';
?>