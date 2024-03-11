<?php

$managerEvolutionMensuelle = new ManagerEvoMensuelle();

$resultatsGroupes = $managerEvolutionMensuelle->getEvoMensuelle();

include "vue/v_evolutionMensuelle.php";