<?php get_header(); ?>

    <!-- CONTENT SECTION -->
    <section id="content">
       <div class="container">
        <div class="row">
                                              <div class="col-lg-12">
            <!-- MAIN CONTENTS --> 
                <h1 class="festi-title">Nous contacter par mail</h1>
    <form method="POST" action="" accept-charset="UTF-8" class="form-horizontal b-form" id="contact" enctype="multipart/form-data"><input name="_token" type="hidden" value="eL4oF5Uesg7HYlcc9NjvMuwNW2oWKbtKctohExkS">
        <div class="form-group">
            <label class="col-sm-2 control-label" for="name">Votre nom *</label>
            <div class="col-sm-6">
                <input required="" class="form-control" id="name" placeholder="Votre nom" name="name" type="text">
            </div>  
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="email">Votre e-mail *</label>
            <div class="col-sm-6">
                <input required="" class="form-control" id="email" placeholder="Votre e-mail" name="email" type="email">
            </div>
        </div> 
        <div class="form-group">
            <label class="col-sm-2 control-label" for="phone">Votre t&eacute;l&eacute;phone</label>
            <div class="col-sm-6">
                <input class="form-control" id="phone" placeholder="Votre t&eacute;l&eacute;phone" maxlength="10" name="phone" type="text">
            </div>
        </div>  
        <div class="form-group">
            <label class="col-sm-2 control-label" for="subject">Objet du message *</label>
            <div class="col-sm-6">
                <input required="" class="form-control" id="subject" placeholder="Objet du message" name="subject" type="text">
            </div>  
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="message">Votre message *</label>
            <div class="col-sm-6">
                <textarea required="" class="form-control" id="message" placeholder="Votre message" rows="3" cols="5" style="resize: none;" name="message"></textarea>
            </div>  
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="msgcopy" id="msgcopy" value="1"> Recevoir une copie du message
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="newsltr" id="newsltr"> J'accepte de recevoir les communications des société du Festimove
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-6">
                <button type="submit" class="block-btn" id="contactBtn">ENVOYER LE MESSAGE</button>
            </div>
        </div>
    </form>
          </div>
        </div>
       </div>
    </section>
    
    <?php get_footer(); ?>

    <script type="text/javascript">
        $('#contact').validate({
            lang: 'fr'
        });
        var $form = $('#contact');
        var $checkbox = $('#newsltr');
        $form.on('submit', function(e) {
            if(!$checkbox.is(':checked')) {
                e.preventDefault();
                alert('S\'il vous plaît accepter les termes et conditions!');
            }
        });
    </script>    