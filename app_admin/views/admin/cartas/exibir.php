<div class="row">
  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      <img src="<?=$carta['imagem_src']?>" alt="<?=$carta['nome']?>">
      <div class="caption">
        <h3><?=$carta['nome']?></h3>
        <span><?=$carta['sigla_edicao']?></span>
        <span><?=converte_mana($carta['mana'])?></span>
        <p>Descrição: <?=$carta['descricao']?></p>
        <p>Frase: <?=$carta['texto']?></p>
        <p>Lealdade: <?=$carta['lealdade']?></p>
        <p>Ataque: <?=$carta['ataque']?></p>
        <p>Resistência: <?=$carta['resistencia']?></p>
      </div>
    </div>
  </div>
</div>
