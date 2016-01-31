
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class="<?= $this->get_active('home')?>"><a href="<?=get_url('home')?>">Home</a></li>
            <li class="<?= $this->get_active('importador')?>"><a href="<?=$this->get_url('importador')?>">Importador</a></li>
            <li class="<?= $this->get_active('edicoes')?>"><a href="<?=$this->get_url('edicoes')?>">Edições</a></li>
            <li class="<?= $this->get_active('usuarios')?>"><a href="<?=$this->get_url('usuarios')?>">Usuários</a></li>
            <li class="<?= $this->get_active('combos')?>"><a href="#">Combos</a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li class="<?= $this->get_active('colecoes')?>"><a href="">Coleções</a></li>
            <li class="<?= $this->get_active('mensagens')?>"><a href="">Mensagens</a></li>
          </ul>
        </div>