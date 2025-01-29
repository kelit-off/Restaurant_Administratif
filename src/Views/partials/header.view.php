<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=(isset($title) && !is_null($title)) ? $title : ""?> - Nom du site</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <?php if(is_null($headerType) && !$slimHeader) { ?>
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 px-4 mb-4 border-bottom">
            <div class="col-md-3 mb-2 mb-md-0">
                <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
                    <svg class="bi" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
                </a>
            </div>
    
            <div class="col-md-3 text-end">
                <a class="btn btn-outline-primary me-2" href="/auth/login">Login</a>
                <a class="btn btn-primary" href="/auth/register">Sign-up</a>
            </div>
        </header>
    <?php } ?>