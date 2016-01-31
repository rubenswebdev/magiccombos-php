    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar ">
            <li class="<?= $this->get_active("home")?>"><a href="<?=get_url("home")?>">Home</a></li>
            <li class="<?= $this->get_active("colecoes")?>"><a href="<?=$this->get_url("colecoes")?>">Coleções</a></li>
            <li class="<?= $this->get_active("mensagens")?>"><a href="<?=$this->get_url("mensagens")?>">Mensagens <span class="label label-success"><?=(@$num_msgs > 0 ? @$num_msgs : '')?></span></a></li>
            <li class="<?= $this->get_active("amigos")?>"><a href="<?=$this->get_url("amigos")?>">Amigos</a></li>
            <li class="<?= $this->get_active("combos")?>"><a href="<?=$this->get_url("combos")?>">Combos</a></li>
          </ul>
          <ul class="nav nav-sidebar">
           
            <li class=""><a href="<?=get_url("home/sair")?>">Sair</a></li>
          </ul>
        </div>
