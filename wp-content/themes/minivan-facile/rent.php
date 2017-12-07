<?php get_header(); ?>
    <nav class="navbar navbar-orange">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.html"><img src="assets/images/logo.png" /></a>
        </div>

        <div id="navbar" class="navbar-collapse collapse">          
          <ul class="nav navbar-nav navbar-right">            
            <li class="dropdown open">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">MENU <span class="sandwitch"></span></a>
              <ul class="dropdown-menu">
                <li><a href="index.html">Accueil</a></li>
                <li><a href="rent.html">LOUER UN MINIBUS</a></li>
                <li><a href="fleets.html">NOS V&Eacute;HICULES</a></li>
                <li><a href="faq.html">FAQ</a></li>
                <li><a href="qui-sommes-nous.html">QUI SOMMES NOUS</a></li>
                              </ul>
            </li>
          </ul>
                      <ul class="nav navbar-nav separator navbar-right"> 
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Nous contacter</a>
                <ul class="dropdown-menu">
                  <li><a href="#">+33602838291</a></li>
                  <li><a href="contact.html">Nous contacter par mail</a></li>
                </ul>
              </li>
              <li><a href="login.html">Se connecter</a></li>
            </ul>
                       
        </div><!--/.nav-collapse -->
      </div><!--/.container-fluid -->
    </nav>

    <style type="text/css">
    input[type=number]::-webkit-inner-spin-button, input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    input[type=number] {
        -moz-appearance:textfield;
    }
</style>
    <section id="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-xs-12">
                                        <div id="search-block">
                        <form method="GET" action="http://minibus-test.ideliver.top/rent/list" accept-charset="UTF-8" id="bookingBus">
                            <div class="row">
                                <div class="col-lg-3">
                                    <label>Nombre de km &agrave; parcourir</label>
                                    <div class="field-wrap-r">
                                        <span class="ico-r location-ico"></span>
                                        <input id="travel_km" required="" class="form-control km_num" placeholder="Nombre de km &agrave; parcourir" min="1" name="travel_km" type="number">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-xs-12">
                                    <label>d&eacute;but</label>
                                    <div class="field-wrap-l col-l">
                                        <span class="ico-l cal-ico"></span>
                                        <input id="start_date" required="" class="form-control" placeholder="23 mai 2017" name="start_date" type="text">
                                    </div>
                                    <div class="field-wrap-l col-r">
                                        <span class="ico-l clock-ico"></span>
                                        <input id="start_datetime" required="" class="form-control" placeholder="19h00" name="start_datetime" type="text">
                                        <!-- <input type="text" value="19h00" class="form-control" /> -->
                                    </div>
                                </div>

                                <div class="col-lg-4 col-xs-12">
                                    <label>fin</label>
                                    <div class="field-wrap-l col-l">
                                        <span class="ico-l cal-ico"></span>
                                        <input id="end_date" required="" class="form-control" placeholder="23 mai 2017" name="end_date" type="text">
                                    </div>
                                    <div class="field-wrap-l col-r">
                                        <span class="ico-l clock-ico"></span>
                                        <input id="end_datetime" required="" class="form-control" placeholder="19h00" name="end_datetime" type="text">
                                        <!-- <input type="text" value="19h00" class="form-control" /> -->
                                    </div>
                                </div>

                                <div class="col-lg-1 col-xs-12">
                                    <button type="submit" class="submit-btn"></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>