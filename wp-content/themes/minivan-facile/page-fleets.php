<?php get_header(); ?>

    <!-- CONTENT SECTION -->
    <section id="content">
       <div class="container">
        <div class="row">
                                              <div class="col-lg-12">
            <!-- MAIN CONTENTS --> 
            	<style type="text/css">
		#news-block1 .news-item .banner-wrap {
		padding: 70px 30px 0px 30px;
		height: 198px;
		color: #fff;
		background-size: cover !important;
		}
		#news-block1 .news-item .news-body {
		background: #fff;
		padding: 30px;
		overflow: hidden;
		}

		#news-block1 .news-item .banner-wrap h5 {
		font-family: 'geomanist-medium';
		font-size: 26px;
		}

		#news-block1 .news-item .date {
		color: #828D94;
		font-size: 16px;
		margin: 15px 0px;
		display: block;
		}
		#news-block1 .news-item .news-body .read-more {
		font-size: 20px;
		color: #00A4D5;
		margin-top: 30px;
		float: right;
		display: inline-block;
		}
		#news-block1 .news-item .news-body {
		background: #fff;
		padding: 30px;
		overflow: hidden;
		}
		#news-block1 {
		margin: 20px 0px 80px 0px;
		}

		#news-block1 .news-item {
		box-shadow: 0px 0px 8px rgba(0,0,0,0.2);
		border-radius: 4px;
		margin: 0px 0px 30px 0px;
		}
		.custom-search-form{
			margin-top:5px;
		}
	</style>
    <h1 class="festi-title">NOS V&Eacute;HICULES</h1>
	<div id="news-block1">
		<div class="container">
			<div class="row">
											
						<div class="col-lg-4">
							<a href="#" data-toggle="modal" data-target="#modal2">
								<div class="news-item">
									<div class="banner-wrap" style="background: url('<?= get_bloginfo("template_url"); ?>/uploads/image/images_1494846073_b.jpg') no-repeat;">
										<h5>Sam</h5>
									</div>
									<div class="news-body">
										<p>
				        					efwefwref
				        				</p>
									</div>
								</div>
							</a>
						</div>
						<!-- modal -->
						<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modal2">
							<div class="modal-dialog modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="gridSystemModalLabel">Sam</h4>
									</div>
									<div class="modal-body">
										<div class="row">
											<div class="col-md-6">
												<img src="<?= get_bloginfo("template_url"); ?>/uploads/image/images_1494846073_b.jpg" height="400" width="400">
											</div>
											<div class="col-md-6">
												Nom 	: Sam <br/>
												Marque 	: Test <br/>
												Type 		: Petrol <br/>
												Prix 	: 12 <br/>
												Volume 	: 12 <br/>
												Taille 		: 0 <br/>
												Description : efwefwref <br/>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
							
						<div class="col-lg-4">
							<a href="#" data-toggle="modal" data-target="#modal3">
								<div class="news-item">
									<div class="banner-wrap" style="background: url('<?= get_bloginfo("template_url"); ?>/uploads/image/download_2__1494846136_b.jpg') no-repeat;">
										<h5>Test</h5>
									</div>
									<div class="news-body">
										<p>
				        					qfef
				        				</p>
									</div>
								</div>
							</a>
						</div>
						<!-- modal -->
						<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modal3">
							<div class="modal-dialog modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="gridSystemModalLabel">Test</h4>
									</div>
									<div class="modal-body">
										<div class="row">
											<div class="col-md-6">
												<img src="<?= get_bloginfo("template_url"); ?>/uploads/image/download_2__1494846136_b.jpg" height="400" width="400">
											</div>
											<div class="col-md-6">
												Nom 	: Test <br/>
												Marque 	: Test <br/>
												Type 		: Petrol <br/>
												Prix 	: 12 <br/>
												Volume 	: 14 <br/>
												Taille 		: 12 <br/>
												Description : qfef <br/>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
												</div>
		</div>
	</div>
          </div>
        </div>
       </div>
    </section>
    
<?php get_footer(); ?>
