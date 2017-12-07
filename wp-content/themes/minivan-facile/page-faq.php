<?php get_header(); ?>

    <!-- CONTENT SECTION -->
    <section id="content">
       <div class="container">
        <div class="row">
                                              <div class="col-lg-12">
            <!-- MAIN CONTENTS --> 
            	<h1 class="festi-title">FAQ</h1>
			<!-- cancellation faq -->
		<h3>Annulation</h3>
		<div id="cancel">
							<h3>kiufgguifeuga</h3>
				<div>
					<p><strong>dsagfhyydbf f hv wrhg bwvw thryhyhy</strong></p>
				</div>
							<h3>testsss sssssss</h3>
				<div>
				<h2>Qu&#39;est-ce que le Lorem Ipsum?</h2>

<p>Le <strong>Lorem Ipsum</strong> est simplement du faux texte employ&eacute; dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l&#39;imprimerie depuis les ann&eacute;es 1500, quand un peintre anonyme assembla ensemble des morceaux de texte pour r&eacute;aliser un livre sp&eacute;cimen de polices de texte. Il n&#39;a pas fait que survivre cinq si&egrave;cles, mais s&#39;est aussi adapt&eacute; &agrave; la bureautique informatique, sans que son contenu n&#39;en soit modifi&eacute;. Il a &eacute;t&eacute; popularis&eacute; dans les ann&eacute;es 1960 gr&acirc;ce &agrave; la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus r&eacute;cemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.</p>

				</div>
					</div>
				<!-- reservation faq -->
		<h3>R&eacute;servation</h3>
		<div id="reserve">
							<h3>test </h3>
				<div>
				    <p>test</p>

<p><img alt="" src="<?= get_bloginfo("template_url"); ?>/docs/1493988471-shortcodes-sprite.png" style="height:60px; width:286px" /></p>

<p><em>dsf</em></p>

<p><em><s>dsf</s></em></p>

<p>hj<strong>k</strong></p>

<blockquote>
<p>gyu</p>
</blockquote>

<ul>
	<li>hkjkl</li>
</ul>

<p>&nbsp;</p>

				</div>
							<h3>Te stet</h3>
				<div>
					<h2>Qu&#39;est-ce que le Lorem Ipsum?</h2>

<p>Le <strong>Lorem Ipsum</strong> est simplement du faux texte employ&eacute; dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l&#39;imprimerie depuis les ann&eacute;es 1500, quand un peintre anonyme assembla ensemble des morceaux de texte pour r&eacute;aliser un livre sp&eacute;cimen de polices de texte. Il n&#39;a pas fait que survivre cinq si&egrave;cles, mais s&#39;est aussi adapt&eacute; &agrave; la bureautique informatique, sans que son contenu n&#39;en soit modifi&eacute;. Il a &eacute;t&eacute; popularis&eacute; dans les ann&eacute;es 1960 gr&acirc;ce &agrave; la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus r&eacute;cemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.</p>

<p><img alt="" src="<?= get_bloginfo("template_url"); ?>/docs/1493988369-images.jpg" style="height:204px; width:204px" /></p>

<p>test</p>

				</div>
					</div>
				<!-- others faq -->
		<h3>Autres</h3>
		<div id="others">
							<h3>test test </h3>
				<div>
					<h2>Qu&#39;est-ce que le Lorem Ipsum?</h2>

<p><img alt="" src="<?= get_bloginfo("template_url"); ?>/docs/1493988395-images1.png" style="height:225px; width:225px" /></p>

<p>Le <strong>Lorem Ipsum</strong> est simplement du faux texte employ&eacute; dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l&#39;imprimerie depuis les ann&eacute;es 1500, quand un peintre anonyme assembla ensemble des morceaux de texte pour r&eacute;aliser un livre sp&eacute;cimen de polices de texte. Il n&#39;a pas fait que survivre cinq si&egrave;cles, mais s&#39;est aussi adapt&eacute; &agrave; la bureautique informatique, sans que son contenu n&#39;en soit modifi&eacute;. Il a &eacute;t&eacute; popularis&eacute; dans les ann&eacute;es 1960 gr&acirc;ce &agrave; la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus r&eacute;cemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.</p>

				</div>
					</div>
				
	          </div>
        </div>
       </div>
    </section>
        
<?php get_template_part('offres', 'speciales'); ?>
    
<?php get_footer(); ?>

    <script src="<?= get_bloginfo("template_url"); ?>/assets/jquery-ui/jquery-ui.min.js"></script>
	<script type="text/javascript">
	    $( document ).ready(function() {
		    $( "#cancel" ).accordion({
		    	active: false,
	      		collapsible: true
		    });
		    $( "#reserve" ).accordion({
		    	active: false,
	      		collapsible: true
		    });
		    $( "#others" ).accordion({
		    	active: false,
	      		collapsible: true
		    });
		});
</script>
