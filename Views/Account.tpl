<div class="card">
    <div class="card-header">
        Gestion de mon compte
    </div>
    <div class="card-body">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text text-primary" id="basic-addon3">Mon mot de passe actuel : </span>
            </div>
            <input type="password" class="form-control" id="currentPassword" name="password" aria-describedby="basic-addon3" onkeyup=" propagerMotDePasse()">
        </div>

        <h5 class="card-title">Changer mon adresse éléctronique </h5>
        <p class="card-text">Vous souhaitez être contacté depuis une autre adresse ?</p>
        <form action="?page=account/updateEmail" method="post" xmlns="http://www.w3.org/1999/html">
            <input type="hidden" name="password">
            <input placeholder="Saisissez une adresse éléctronique valide" type="text" name="newEmail"
                   class="form-control" id="basic-url" aria-describedby="basic-addon3">
            <div class="text-right mt-2">
                <button type="submit" class="btn btn-primary">Valider</button>
            </div>
        </form>

        <hr class="my-4">

        <h5 class="card-title">Changer mon mot de passe</h5>
        <p class="card-text">Vous souhaitez changer votre mot de passe ?</p>
        <form action="?page=account/updatePassword" method="post" xmlns="http://www.w3.org/1999/html">
            <input type="hidden" name="password">
        <input placeholder="Saisissez un mot de passe" name="newPassword" type="password" class="form-control"
               id="basic-url" aria-describedby="basic-addon3">
        <input placeholder="Répétez le mot de passe" name="newPasswordRepeat" type="password" class="form-control"
               id="basic-url" aria-describedby="basic-addon3">


        <div class="text-right mt-2">
            <button type="submit" class="btn btn-primary">Valider</button>
        </div>
        </form>
        <hr class="my-4">

        <h5 class="card-title">Supprimer mon compte</h5>
        <p class="card-text">Vous voulez faire valoir votre droit à l'oubli ?</br>Attention, cette opération est
            irréversible</p>
        <form action="?page=account/delete" method="post" xmlns="http://www.w3.org/1999/html">
            <input type="hidden" name="password">


            <div class="text-right mt-2">
                <button type="submit" class="btn btn-danger" onclick="confirm('Etes-vous sûr de vouloir supprimer vôtre compte ? ')">Supprimer</button>
            </div>
        </form>


    </div>
</div>
<script>
    function propagerMotDePasse() {
        $("[name=password]").each(function () {

            $(this).val($('#currentPassword').val())
        })
    }
</script>