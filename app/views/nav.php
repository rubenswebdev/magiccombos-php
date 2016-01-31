<body>
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <?php $this->view("container-fluid")?>
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Menu</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?=get_url()?>"> <span class="glyphicon glyphicon-star"> </span> MagicCombos </a>
        </div>
        <div class="navbar-collapse collapse">
       

           <?php if(!$this->auth->loged()): ?>
            <form class="navbar-form navbar-right" method="post" action="<?=get_url()?>" role="form">
              <div class="form-group">
                <input type="text" placeholder="Login" name="login" class="form-control">
              </div>
              <div class="form-group">
                <input type="password" placeholder="Password" name="senha" class="form-control">
              </div>
              <button type="submit" class="btn btn-success">Login</button>
              
             <a href="<?=get_url('cadastre_se')?>" role="button" class="btn btn-primary">Cadastre-se</a>

            


            </form>
          <?php endif ?>

            <?php if($this->auth->loged()): ?>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav navbar-right">
               
                <li class="<?=$this->get_active('home')?>"><a href="<?=get_url("home")?>"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                <li class="<?=$this->get_active('colecoes')?>"><a href="<?=get_url("colecoes")?>"><span class="glyphicon glyphicon-bookmark"></span> Minhas Coleções</a></li>
                <li class="<?=$this->get_active('mensagens')?>"><a href="<?=get_url("mensagens")?>"><span class="glyphicon glyphicon-inbox"></span> Mensagens <span class=" label label-success"><?=(@$num_msgs > 0 ? @$num_msgs : '')?></span></a></li>
                <li class="<?=$this->get_active('amigos')?>"><a href="<?=get_url("amigos")?>"><span class="glyphicon glyphicon-star-empty"></span> Amigos</a></li>
                <li class="dropdown <?=$this->get_active('denuncias')?>">
			          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-ban-circle"></span>  Denuncias <b class="caret"></b></a>
			          <ul class="dropdown-menu">
			            <li><a href="<?=get_url("denuncias/recebidas")?>">Recebidas</a></li>
			            <li><a href="<?=get_url("denuncias/feitas")?>">Feitas</a></li>
			          </ul>
			       </li>
             	 <li class="<?=$this->get_active('perfil')?> dropdown">
             	 		<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> Olá <?=$this->auth->get_data("nome") ?><b class="caret"></b></a>
             	 		<ul class="dropdown-menu">
				            <li><a href="<?=get_url("perfil")?>">Meu Perfil</a></li>
				           
				          </ul>
             	 </li>
                 <li><a href="<?=get_url("home/sair")?>"><span class="glyphicon glyphicon-backward"></span> Sair</a></li>
              </ul>
            </div>
            <?php endif ?>

        </div><!--/.navbar-collapse -->
      </div>
    </div>

       <?php if(!empty(@$erro)):?>
      <div class="row">
          <div class="col-xs-4 col-xs-offset-7">
            <div class="alert alert-danger"><?=$erro?></div>
          </div>
      </div>
    <?php endif ?>
