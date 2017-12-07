<?php get_header(); ?>

      <section id="content">
     <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <h1 class="festi-title">Se connecter</h1>
                                        <form class="form-horizontal b-form login-block" role="formlogin" method="POST" action="" id="logIn">
              <input type="hidden" name="_token" value="eL4oF5Uesg7HYlcc9NjvMuwNW2oWKbtKctohExkS">
            <div class="form-group">
              <label for="name" class="col-sm-4 control-label">Nom d&#039;utilisateur *</label>
              <div class="col-sm-8">
                  <input id="email1" type="email" class="form-control" name="email" value="" required="" placeholder="Nom d&#039;utilisateur">
              </div>
            </div>

             <div class="form-group">
              <label for="name" class="col-sm-4 control-label">Mot de passe *</label>
              <div class="col-sm-8">
                  <input id="password" type="password" class="form-control" name="password" required="" placeholder="Mot de passe">
              </div>
            </div>

             <div class="form-group">
              <div class="col-sm-offset-4 col-sm-8">
                <div class="checkbox">
                  <label>
                      <input type="checkbox" name="remember"> Se souvenir de moi
                  </label>
                  <br />
                  <br />
                  <a href="<?= get_bloginfo("template_url"); ?>/reset">Mot de passe oubli&eacute; ?</a><br />
                  <a href="<?= get_bloginfo("template_url"); ?>/register">S&#039;enregistrer</a> 
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-offset-4 col-sm-8">
                <button type="submit" class="block-btn">Se connecter</button>
                <p class="or">ou</p>
                <button type="button" class="fb-btn" onclick="window.open('https://www.facebook.com/v2.8/dialog/oauth?client_id=155802074956413&amp;redirect_uri=http%3A%2F%2Fminibus-test.ideliver.top%2Ffb_callback&amp;scope=email&amp;response_type=code&amp;state=0GnolBxwUufbuGZYUj2gGwOeyRhESN2iwcuYQqrR','popup','width=700,height=700'); return false;">Se connecter avec Facebook</button>
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
    $('#logIn').validate({
      lang: 'fr'
    });
  </script>    
