<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html
        PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

    <title>{$fileToInclude|replace:'.tpl':''|ucfirst|default:'Oups ! '} - AAA</title>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.css"/>
    <link rel="stylesheet" href="css/custom.css"/>
    <link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet"/>

    <meta name="google-signin-client_id" content="111824800151-gu66ltunvubke0bi8o3jhigr2l8l3p0o.apps.googleusercontent.com"/>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</head>
<nav id="navbar" class="navbar navbar-expand-lg navbar-dark bg-dark " >
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            {foreach from=$pages key=nom item=url}
                <li class="nav-item active">
                    <a class="nav-link" href="?page={$url}">{$nom} </a>
                </li>
            {/foreach}
            {if !(is_bool($user)&&!$user)}
                {foreach from=$pagesRestrict key=nom item=url}
                    <li class="nav-item active">
                        <a class="nav-link text-warning" href="?page={$url}">{$nom} </a>
                    </li>
                {/foreach}
            {/if}

        </ul>
        <div id="authState">
            <div id="authStateContent">



                <div class="my-2 my-lg-0 text-white">
                    {if is_bool($user)&&!$user}
                        <a   class="btn btn-outline-light ml-3" href="?page=login">Connexion</a>
                        {else}

                        Bonjour {$user['firstname']}
                        <a class="btn btn-outline-light ml-3" href="?page=logout">Déconnexion</a>
                    {/if}


                </div>

            </div>
        </div>
    </div>
</nav>
</head>
<body>
<div id="content" class="container p-3 _full ">
    {if isset($error)}
    <div class="alert alert-danger" role="alert">
        <strong>Oh Merde !</strong> {$error}
    </div>
    {/if}
    {if isset($message)}
        <div class="alert alert-success" role="alert">
            <strong>Niquel !</strong> {$message}
        </div>
    {/if}
    {if isset($fileToInclude)}
        {include file=$fileToInclude}
    {/if}
</div>

<footer>
    <div class="container-fluid bg-dark text-white pt-2 pb-2 position-sticky">
        <div class="container ">
            <div style="position: relative;
display: -webkit-flex;
display: flex;">

                &copy; Copyright {$date|date_format:"%Y"}

            </div>
        </div>
    </div>


</footer>
</body>
</html>