    <div class="menuBar">
        <ul class="button-group">
          <li><a href="#" class="button small langBtn <?php echo (getLang()!='_ESP')?'langSel':''; ?>">ENGLISH</a></li>
          <li><a href="#" class="button small langBtn <?php echo (getLang()=='_ESP')?'langSel':''; ?>">ESPAÑOL</a></li>
        </ul>
        <div class="content">
            <div class="logo goTo" ref="<?php echo base_url(); ?>"></div>
            <div class="menuOpt">CUARTOS
                <div class="dropdownContain">
                    <div class="dropOut">
                        <div class="triangle"></div>
                        <ul>
                            <li class="goTo" ref="<?php echo base_url(); ?>room/sanJusto">SAN JUSTO</li>
                            <li class="goTo" ref="<?php echo base_url(); ?>room/sol">SOL</li>
                            <li class="goTo" ref="<?php echo base_url(); ?>room/luna">LUNA</li>
                            <li class="goTo" ref="<?php echo base_url(); ?>room/sanJose">SAN JOSE</li>
                            <li class="goTo" ref="<?php echo base_url(); ?>room/princesa">PRINCESA</li>
                            <li class="goTo" ref="<?php echo base_url(); ?>room/sanFelipe">SAN FELIPE</li>
                            <li class="goTo" ref="<?php echo base_url(); ?>room/sanGeronimo">SAN GERONIMO</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="menuOpt mSuites">SUITES
                <div class="dropdownContain">
                    <div class="dropOut">
                        <div class="triangle"></div>
                        <ul>
                            <li class="goTo" ref="<?php echo base_url(); ?>suite/presidencial">PRESIDENCIAL SUITE</li>
                            <li class="goTo" ref="<?php echo base_url(); ?>suite/fortaleza">FORTALEZA SUITE</li>
                            <li class="goTo" ref="<?php echo base_url(); ?>suite/sanSebastian">SAN SEBASTIAN</li>
                            <li class="goTo" ref="<?php echo base_url(); ?>suite/sanCristobal">SAN CRISTOBAL</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="menuOpt goTo" ref="<?php echo base_url(); ?>info">INFORMACIÓN</div>
            <div class="menuOpt bookmein" ref="<?php echo base_url(); ?>booking">BOOKING</div>
            <div class="menuOpt goTo" ref="<?php echo base_url(); ?>contacto">CONTACTO</div>
        </div>
    </div>