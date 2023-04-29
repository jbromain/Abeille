<?php
    require_once __DIR__.'/../../core/config/Abeille.config.php';

    /* Developers debug features & PHP errors */
    if (file_exists(dbgFile)) {
        $dbgDeveloperMode = true;
    }

    // require_once __DIR__.'/../../../../core/php/core.inc.php';
    // include_once __DIR__.'/../../core/class/AbeilleTools.class.php';
    // include_once __DIR__.'/../../core/php/AbeilleLog.php'; // logDebug()
    /*
    if (!isConnect('admin')) {
        throw new Exception('401 Unauthorized');
    }
     */

    // $eqLogics = Abeille::byType('Abeille');

    // eqLogic/configuration/ab::settings reminder
    // networkMap[zgId] = array(
    //     "level0" => "map-level0.png",
    //     "levelX" => "map-levelX.png"
    // )
?>
{{Cette page vous permet de définir un plan et le nom (niveau) associé}}.<br><br>

Niveau:
<!-- Drop down list to select Zigate -->
<select id="idLevel" onchange="levelChanged()" style="width:100px">
</select>
<button id="idLevelMin" class="btn btn-danger btn-sm" onclick="levelRemove()">-</button>
<input id="idLevelNew" type="text" value="">
<button id="idLevelPlus" class="btn btn-success btn-sm" onclick="levelAdd()">+</button>
<br>
<!-- class="fas fa-plus-circle" -->

Plan: <button id="map" onclick="uploadMap()">{{Plan}}</button>
<script>
    // TEMP
    networkMap = {
        1: {
            rdc: 'map-rdc.png',
            premier: 'map-1er.png'
        }
    };
    // END TEMP

    buildLevelsList();

    function buildLevelsList() {
        console.log("buildLevelsList(). networkMap=", networkMap);
        if (typeof networkMap[zgId] === 'undefined')
            return;

        nm = networkMap[zgId];
        console.log("nm=", nm);
        select = document.getElementById("idLevel");
        for (const [level, map] of Object.entries(nm)) {
            var el = document.createElement("option");
            el.textContent = level;
            el.value = map;
            select.appendChild(el);
        }
    }

    function levelChanged() {
        console.log("levelChanged())");
        level = $("#idLevel").val();
        console.log("level=", level);
    }

    // Remove current selected level
    function levelRemove() {
        select = document.getElementById("idLevel");
        index = select.selectedIndex;
        console.log("levelRemove(index="+index+")");
        if (index < 0)
            return;
        select.remove(index);
    }

    // Add a new level
    function levelAdd() {
        value = document.getElementById("idLevelNew").value;
        console.log("levelAdd(value="+value+")");
        if (value == '')
            return;

        var el = document.createElement("option");
        el.textContent = value;
        el.value = value;
        select.appendChild(el);
    }
</script>
