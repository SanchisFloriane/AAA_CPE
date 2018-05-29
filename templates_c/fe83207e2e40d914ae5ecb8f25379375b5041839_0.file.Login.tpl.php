<?php
/* Smarty version 3.1.32, created on 2018-05-04 16:44:25
  from '/Users/Alex/Sites/AAA_CPE/Views/Login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5aec71c9956303_59070279',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fe83207e2e40d914ae5ecb8f25379375b5041839' => 
    array (
      0 => '/Users/Alex/Sites/AAA_CPE/Views/Login.tpl',
      1 => 1525445052,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5aec71c9956303_59070279 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="row mb-2 flex-row">
    <div class="col-sm-6 d-flex align-items-stretch">
        <div class="card">
            <div class="card-header">
                Connexion
            </div>
            <div class="card-body">

                <ul class="list-group list-group-flush">
                    <li class="list-group-item">

                        <h5 class="card-title">Connexion avec un compte xxxxx </h5>
                        <form method="post" action="?page=login" method="post">
                            <div class="form-group">
                                <label for="connexion:inputEmail">Adresse électronique</label>
                                <input type="email" class="form-control" name="email" id="connexion:inputEmail"
                                       placeholder="Adresse électronique"
                                       value="" size="40" required>
                            </div>
                            <div class="form-group">
                                <label for="connexion:inputPassword">Mot de passe</label>
                                <input type="password" class="form-control" name="password" id="connexion:inputPassword"
                                       placeholder="Mot de passe"
                                       value="" size="40" required>
                            </div>
                            <button type="submit" class="btn btn-primary float-right">Connexion</button>


                        </form>
                    </li>
                    <li class="list-group-item ">
                        <h5 class="card-title">Connexion avec un compte Google </h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional
                            content.</p>
                        <div id="my-signin2" class="float-right"></div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-sm-6 d-flex align-items-stretch">
        <div class="card">
            <div class="card-header">
                Inscription
            </div>
            <div class="card-body">
                <form class="needs-validation" action="?page=register" method="post">

                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="firstname">Prénom</label>
                            <input type="text" name="firstname" class="form-control" id="firstname" placeholder="Prénom"
                                   required>

                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="lastname">Nom</label>
                            <input type="text" name="lastname" class="form-control" id="lastname" placeholder="Nom" required>

                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="surname">Pseudonyme</label>
                            <input type="text" name="nickname" class="form-control" id="surname" placeholder="Pseudonyme" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail">Adresse électronique</label>
                        <div class="input-group" id="inputEmailGroup">
                            <input type="email" class="form-control" name="email" id="inputEmail"
                                   placeholder="Adresse électronique"
                                   value="" size="40" required>
                            <span id="inputEmailAppend" class="input-group-append d-none">
                        <span class="input-group-text">
                            <span id="helpEmail" class="text-danger fas fa-times"></span>
                        </span>
                    </span>
                        </div>
                        <small id="smallEmail" class="form-text text-muted"></small>

                    </div>
                    <div class="form-group">
                        <label for="inputPassword">Mot de passe</label>
                        <div class="input-group" id="inputPasswordGroup">
                            <input type="password" class="form-control" name="password" id="inputPassword"
                                   placeholder="Mot de passe"
                                   value="" size="40" required>
                            <span id="inputPasswordAppend" class="input-group-append d-none">
                        <span class="input-group-text">
                            <span id="helpPassword"></span>
                        </span>
                    </span>

                        </div>
                        <small id="smallPassword" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="inputRepeatPassword">Répetez le mot de passe</label>
                        <div class="input-group" id="inputRepeatPasswordGroup">
                            <input type="password" class="form-control" name="repeatPassword" id="inputRepeatPassword"
                                   placeholder="Mot de passe"
                                   value="" size="40" required>
                            <span id="inputRepeatPasswordAppend" class="input-group-append d-none">
                        <span class="input-group-text">
                            <span id="helpRepeatPassword"></span>
                        </span>
                    </span>
                        </div>
                        <small id="smallRepeatPassword" class="form-text text-muted d-none">Les mots de passe ne correspondent
                            pas
                        </small>
                    </div>
                    <?php echo '<script'; ?>
 type="text/javascript">

                        var strength = {
                            0: "text-danger fas fa-times",
                            1: "text-warning fas fa-exclamation",
                            2: "text-warning fas fa-exclamation",
                            3: "text-succes fas fa-check",
                            4: "text-succes fas fa-check"
                        };

                        $('#inputEmail')[0].addEventListener('blur', function () {
                            if ($('#inputEmail')[0].value !== "") {
                                $.getJSON('auth/emailValid?email=' + encodeURI($('#inputEmail')[0].value), function (data) {

                                    $('#inputEmailAppend').removeClass('d-none');
                                    $('#helpEmail').attr('class', strength[data.error ? 0 : 4]);
                                    $('#inputEmail')[0].setCustomValidity(data.error ? data.message : '');
                                    $('#smallEmail')[0].innerHTML = (data.error ? data.message : '');

                                });
                            } else
                                $('#inputEmailAppend').addClass('d-none');
                        });

                        $('#inputPassword')[0].addEventListener('input', function () {
                            if ($('#inputPassword')[0].value !== "") {
                                var val = $('#inputPassword')[0].value;
                                var result = zxcvbn(val);
                                $('#inputPassword')[0].setCustomValidity(result.score < 3 ? result.feedback.warning + " " + result.feedback.suggestions.toString() : '');
                                $('#smallPassword')[0].innerHTML = (result.score < 3 ? result.feedback.warning + " " + result.feedback.suggestions.toString() : '');
                                // Update the text indicator
                                $('#helpPassword').attr('class', strength[result.score]);
                                $('#inputPasswordAppend').removeClass('d-none');
                            } else
                                $('#inputPasswordAppend').addClass('d-none');

                        });

                        $('#inputRepeatPassword')[0].addEventListener('input', function () {
                            if ($('#inputRepeatPassword')[0].value !== "") {
                                $('#inputRepeatPasswordAppend').removeClass('d-none');
                                if ($('#inputRepeatPassword')[0].value !== $('#inputPassword')[0].value) {
                                    $('#helpRepeatPassword').attr('class', strength[0]);

                                    $('#smallRepeatPassword').removeClass('d-none');
                                }
                                else {
                                    $('#helpRepeatPassword').attr('class', strength[4]);
                                    $('#smallRepeatPassword').addClass('d-none');
                                }
                            } else
                                $('#inputRepeatPasswordAppend').addClass('d-none');

                        });

                    <?php echo '</script'; ?>
>
                    <button type="submit" class="btn btn-primary float-right ">Inscription</button>

                </form>

            </div>
        </div>
    </div>
</div><?php }
}
