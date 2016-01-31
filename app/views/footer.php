
  
    </div> <!-- /container -->
    <div id="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                       
                        <p class="text-center">MagicCombos&copy; Company 2014</p>
                     
                    </div>
                </div>
            </div>
    </div>

    <style type="text/css">
        /* Sticky footer styles
        -------------------------------------------------- */
        html {
          position: relative;
          min-height: 100%;
        }
        body {
          /* Margin bottom by footer height */
          margin-bottom: 60px;
        }
        #footer {
          position: absolute;
          bottom: 0;
          width: 100%;
          /* Set the fixed height of the footer here */
          height: 60px;
          background-color: #f5f5f5;
          
        }


        /* Custom page CSS
        -------------------------------------------------- */
        /* Not required for template or sticky footer method. */

        body > .container {
          padding: 60px 15px 0;
        }
        .container .text-muted {
          margin: 20px 0;
        }

        #footer > .container {
          padding-right: 15px;
          padding-left: 15px;
        }

        code {
          font-size: 80%;
        }

    </style>

    <script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-46175035-1', 'auto');
	  ga('send', 'pageview');

	</script>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>-->
    <script src="<?= get_url("public/js/jquery.js") ?>"></script>
    <script src="<?= get_url("public/js/jquery-ui-1.10.4.custom.min.js") ?>"></script>
    <script src="<?= get_url("public/js/bootstrap.min.js") ?>"></script>
   
    <script src="<?= get_url("public/js/docs.min.js") ?>"></script>


    <!-- Add fancyBox -->
	<link rel="stylesheet" href="<?= get_url('public/js/fancybox/jquery.fancybox.css?v=2.1.5') ?>" type="text/css" media="screen" />
	<script type="text/javascript" src="<?= get_url('public/js/fancybox/jquery.fancybox.pack.js?v=2.1.5')?>"></script>



     <script src="<?= get_url("public/js/alertify/alertify.min.js") ?>"></script>
     <script src="<?= get_url("public/js/tooltip/jquery.tooltipster.min.js") ?>"></script>
     <script src="<?= get_url("public/js/jquery.mask.min.js") ?>"></script>
     <?php if($this->segments(0) == null): ?>
     <script src="<?= get_url("public/js/home/scripts.js") ?>"></script>
   <?php endif ?>
    <!--necessário para que o js use o endereço do sistema configurado no arquivo config-->
    <script type="text/javascript">
        base_url = "<?=$this->get_url()?>"
    </script>
    <!-- ... -->


    <?= $this->get_js("scripts","importador","js")?>
    <?= $this->get_js("scripts","colecoes","js")?>
    <?= $this->get_js("scripts","home","js")?>
    <?= $this->get_js("scripts","cartas","js")?>
    <?= $this->get_js("scripts","mensagens","js")?>
    <?= $this->get_js("scripts","amigos","js")?>
    <?= $this->get_js("scripts","cadastre_se","js")?>
    <?= $this->get_js("scripts","denuncias","js")?>
    <?= $this->get_js("scripts","combos","js")?>
    <?= $this->get_js("scripts","perfil","js")?>
 






    <div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.0";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>

  </body>
</html>