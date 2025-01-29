<?php
include_once 'src/Views/partials/header.view.php';
?>
<div class="d-flex align-items-center py-4 bg-body-tertiary w-50 justify-content-center m-auto">
    <main class="form-signin w-100 m-auto">
        <form class="" action="/auth/login" method="POST">
            <img class="mb-4" src="/docs/5.3/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Adresse mail</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Mot de passe">
                <label for="floatingPassword">Mot de passe</label>
            </div>

            <div class="form-check text-start my-3">
                <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Remember me
                </label>
            </div>
            <p>TU n'as pas encore de compte? <a href="/auth/register">Inscription</a></p>
            <button class="btn btn-primary w-100 py-2" type="submit">Connexion</button>
            <p class="mt-5 mb-3 text-body-secondary">© 2017–2024</p>
        </form>
    </main>
</div>
<?php
include_once 'src/Views/partials/footer.view.php';