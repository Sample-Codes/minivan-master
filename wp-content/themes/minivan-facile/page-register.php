<?php get_header(); ?>

        <section id="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h1 class="festi-title">S&#039;enregistrer</h1>
                                                                                <form class="form-horizontal b-form login-block" role="formregister" method="POST" action="" id="registre">
                        <input type="hidden" name="_token" value="eL4oF5Uesg7HYlcc9NjvMuwNW2oWKbtKctohExkS">

                        <div class="form-group">
                            <label for="first_name" class="col-sm-4 control-label">Pr&eacute;nom *</label>
                            <div class="col-sm-8">
                                <input id="first_name" type="text" class="form-control" name="first_name" value="" required="" placeholder="Pr&eacute;nom">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="last_name" class="col-sm-4 control-label">Nom *</label>
                            <div class="col-sm-8">
                                <input id="last_name" type="text" class="form-control" name="last_name" value="" required="" placeholder="Nom">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-sm-4 control-label">Email *</label>
                            <div class="col-sm-8">
                                <input id="email" type="email" class="form-control" name="email" value="" required="" placeholder="Email">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-sm-4 control-label">Mot de passe *</label>
                            <div class="col-sm-8">
                                <input id="password" type="password" class="form-control" name="password" required="" placeholder="Mot de passe">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-sm-4 control-label">Confirmer le mot de passe *</label>
                            <div class="col-sm-8">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required="" placeholder="Confirmer le mot de passe">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-10">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="cgvcheck"> J'accepte les <a href="<?= get_bloginfo("template_url"); ?>/conditions-generales-de-vente" target="_blank">conditions d'utilisations</a>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-8">
                                <button type="submit" class="block-btn" id="registerBtn"> S&#039;enregistrer</button>
                                <p class="or">ou</p>
                                <button type="button" class="fb-btn" onclick="window.open('https://www.facebook.com/v2.8/dialog/oauth?client_id=155802074956413&amp;redirect_uri=http%3A%2F%2Fminibus-test.ideliver.top%2Ffb_callback&amp;scope=email&amp;response_type=code&amp;state=LNjIBQUPg9tHU9tyugxXb1mbrW84CTutKvW0y8xQ','popup','width=700,height=700'); return false;">Se connecter avec Facebook</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6">
                    <img class="resp" id="banner-img" src="<?= get_bloginfo("template_url"); ?>/assets/images/signup-banner.jpg" />
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>

    <script type="text/javascript">
        $('#registre').validate({
            lang: 'fr'
        });
        var $form = $('#registre');
        var $checkbox = $('#cgvcheck');
        $form.on('submit', function(e) {
            if(!$checkbox.is(':checked')) {
                e.preventDefault();
                alert('S\'il vous plaît accepter les termes et conditions!');
            }
        });
    </script>    
