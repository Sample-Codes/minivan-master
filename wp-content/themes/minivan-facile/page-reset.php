<?php get_header(); ?>

        <section id="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h1 class="festi-title">R&eacute;initialiser le mot de passe</h1>
                                        <form class="form-horizontal b-form login-block" role="formreset" method="POST" action="" id="pswdRst">
                        <input type="hidden" name="_token" value="eL4oF5Uesg7HYlcc9NjvMuwNW2oWKbtKctohExkS">
                        <div class="form-group">
                            <label for="email" class="col-sm-4 control-label">Email *</label>
                            <div class="col-sm-8">
                                <input id="email" type="email" class="form-control" name="email" value="" required="" placeholder="Email">
                                                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-8">
                                <button type="submit" class="block-btn"> Envoyer le lien pour la r&eacute;initialisation</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6">
                    <img class="resp" id="banner-img" src="<?= get_bloginfo("template_url"); ?>/assets/images/login-banner.jpg" />
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>

    <script type="text/javascript">
        $('#pswdRst').validate({
            lang: 'fr'
        });
    </script>    