 		</div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="<?= get_url('public/js/bootstrap.min.js') ?>"></script>
    <script src="<?= get_url('public/js/docs.min.js') ?>"></script>

    <!--necessário para que o js use o endereço do sistema configurado no arquivo config-->
    <script type="text/javascript">
        base_url = "<?=$this->get_url()?>"
    </script>
    <!-- ... -->

    <?= $this->get_js('scripts','importador','js')?>

  </body>
</html>