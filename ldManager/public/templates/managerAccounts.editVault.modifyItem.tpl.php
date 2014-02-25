<div class="main"> 
<p class="response2"><?php echo $language->sentence["MNG_ACC_EV_LABEL_DETAILS_TITLE"]; ?></p>
<form id="form" method="post" action="?call=managerAccounts&subCall=editVault&action=modifyItem&account=<?php echo (isset($_GET['account']) ? $_GET['account'] : ''); ?>">
    <table id="vaultSpecifications">
        <tr><td><label><?php echo $language->sentence["MNG_ACC_EV_LABEL_DETAILS_ITEM"]; ?>: <?php echo $managerAccounts->ldVault->codeGroup[$_POST['item']]['Details']['ItemName']; ?></label></td></tr>
        <tr><td><label><?php echo $language->sentence["MNG_ACC_EV_LABEL_DETAILS_LEVEL"]; ?>: +<?php echo $managerAccounts->ldVault->codeGroup[$_POST['item']]['Details']['ItemLevel']; ?></label></td></tr>
        <tr><td><label><?php echo $language->sentence["MNG_ACC_EV_LABEL_DETAILS_LUCK"]; ?>: <?php echo ($managerAccounts->ldVault->codeGroup[$_POST['item']]['Details']['ItemLuck'] == true ? "Sim":"N&atilde;o") ?></label></td></tr>
        <tr><td><label><?php echo $language->sentence["MNG_ACC_EV_LABEL_DETAILS_SKILL"]; ?>: <?php echo ($managerAccounts->ldVault->codeGroup[$_POST['item']]['Details']['ItemSkill'] == true ? "Sim":"N&atilde;o") ?></label></td></tr>
        <tr><td><label><?php echo $language->sentence["MNG_ACC_EV_LABEL_DETAILS_ADDITIONAL"]; ?>: +<?php echo ($managerAccounts->ldVault->codeGroup[$_POST['item']]['Details']['ItemOption']*4); ?></label></td></tr>
        <tr><td><label><?php echo $language->sentence["MNG_ACC_EV_LABEL_DETAILS_DURABILITY"]; ?>: <?php echo $managerAccounts->ldVault->codeGroup[$_POST['item']]['Details']['ItemDurability']; ?></label></td></tr>
        <tr><td><label><?php echo $language->sentence["MNG_ACC_EV_LABEL_DETAILS_SERIAL"]; ?>: <?php echo $managerAccounts->ldVault->codeGroup[$_POST['item']]['Details']['ItemSerial']; ?></label></td></tr>
        <tr><td><label><?php echo $language->sentence["MNG_ACC_EV_LABEL_DETAILS_ANCIENT"]; ?>: <?php echo ldItemParse::getAncientName($managerAccounts->ldVault->codeGroup[$_POST['item']]['Details']['ItemAncient'], $managerAccounts->ldVault->codeGroup[$_POST['item']]['Details']['ItemIdSection'], $managerAccounts->ldVault->codeGroup[$_POST['item']]['Details']['ItemIdIndex']); ?></label></td></tr>
        <tr><td><li style="list-style: none; padding: 0px;">
                        <fieldset>
                            <legend><?php echo $language->sentence["MNG_ACC_EV_LABEL_DETAILS_OPTIONS_EXCELLENTS"]; ?></legend>         
                            <?php
                            echo ($managerAccounts->ldVault->codeGroup[$_POST['item']]['Details']['ItemExcellents'][5] == true ? ldItemParse::getExcellentName(5, $managerAccounts->ldVault->codeGroup[$_POST['item']]['Details']['ItemIdSection'], $managerAccounts->ldVault->codeGroup[$_POST['item']]['Details']['ItemIdIndex']) : "").
                                 ($managerAccounts->ldVault->codeGroup[$_POST['item']]['Details']['ItemExcellents'][4] == true ? ldItemParse::getExcellentName(4, $managerAccounts->ldVault->codeGroup[$_POST['item']]['Details']['ItemIdSection'], $managerAccounts->ldVault->codeGroup[$_POST['item']]['Details']['ItemIdIndex']) : "").
                                 ($managerAccounts->ldVault->codeGroup[$_POST['item']]['Details']['ItemExcellents'][3] == true ? ldItemParse::getExcellentName(3, $managerAccounts->ldVault->codeGroup[$_POST['item']]['Details']['ItemIdSection'], $managerAccounts->ldVault->codeGroup[$_POST['item']]['Details']['ItemIdIndex']) : "").
                                 ($managerAccounts->ldVault->codeGroup[$_POST['item']]['Details']['ItemExcellents'][2] == true ? ldItemParse::getExcellentName(2, $managerAccounts->ldVault->codeGroup[$_POST['item']]['Details']['ItemIdSection'], $managerAccounts->ldVault->codeGroup[$_POST['item']]['Details']['ItemIdIndex']) : "").
                                 ($managerAccounts->ldVault->codeGroup[$_POST['item']]['Details']['ItemExcellents'][1] == true ? ldItemParse::getExcellentName(1, $managerAccounts->ldVault->codeGroup[$_POST['item']]['Details']['ItemIdSection'], $managerAccounts->ldVault->codeGroup[$_POST['item']]['Details']['ItemIdIndex']) : "").
                                 ($managerAccounts->ldVault->codeGroup[$_POST['item']]['Details']['ItemExcellents'][0] == true ? ldItemParse::getExcellentName(0, $managerAccounts->ldVault->codeGroup[$_POST['item']]['Details']['ItemIdSection'], $managerAccounts->ldVault->codeGroup[$_POST['item']]['Details']['ItemIdIndex']) : "");
                            ?>
                        </fieldset> 
                        </li></td></tr>
        <?php
            echo ($managerAccounts->ldVault->codeGroup[$_POST['item']]['Details']['ItemRefine'] > 0 ? "<tr><td><label>". $language->sentence["MNG_ACC_EV_LABEL_DETAILS_OPTIONS_REFINE"] .": <br />".ldItemParse::getRefineName($managerAccounts->ldVault->codeGroup[$_POST['item']]['Details']['ItemIdSection'], $managerAccounts->ldVault->codeGroup[$_POST['item']]['Details']['ItemIdIndex'])."</label></td></tr>":"");
        
            echo ($managerAccounts->ldVault->codeGroup[$_POST['item']]['Details']['HarmonyType'] > 0 ? "<tr><td><label>". $language->sentence["MNG_ACC_EV_LABEL_DETAILS_OPTIONS_HARMONY"] .": <br />".ldItemParse::getHarmonyName($managerAccounts->ldVault->codeGroup[$_POST['item']]['Details']['ItemIdSection'], $managerAccounts->ldVault->codeGroup[$_POST['item']]['Details']['ItemIdIndex'], $managerAccounts->ldVault->codeGroup[$_POST['item']]['Details']['HarmonyType'], $managerAccounts->ldVault->codeGroup[$_POST['item']]['Details']['HarmonyLevel'])."</label></td></tr>":"");
        ?>                                                                                           
        <tr><td><li style="list-style: none; padding: 0px;">
                        <fieldset>
                            <legend><?php echo $language->sentence["MNG_ACC_EV_LABEL_DETAILS_OPTIONS_SOCKET"]; ?></legend>         
                            <?php
                            echo "1: ".ldItemParse::getSocketName(0, $managerAccounts->ldVault->codeGroup[$_POST['item']]['Details']['Sockect'][0])."<br />
                                  2: ".ldItemParse::getSocketName(1, $managerAccounts->ldVault->codeGroup[$_POST['item']]['Details']['Sockect'][1])."<br />
                                  3: ".ldItemParse::getSocketName(2, $managerAccounts->ldVault->codeGroup[$_POST['item']]['Details']['Sockect'][2])."<br />
                                  4: ".ldItemParse::getSocketName(3, $managerAccounts->ldVault->codeGroup[$_POST['item']]['Details']['Sockect'][3])."<br />
                                  5: ".ldItemParse::getSocketName(4, $managerAccounts->ldVault->codeGroup[$_POST['item']]['Details']['Sockect'][4])
                            ?>
                        </fieldset> 
                        </li></td></tr>
                        
        <?php
        if(empty($managerAccounts->sentense) == false)
        {
            printf("<p><strong>%s</strong></p>", $language->sentence[$managerAccounts->sentense]);  
        }
        else
        {
            echo "<tr><td><label><input type=\"button\" value=\"". $language->sentence["MNG_ACC_EV_LABEL_DETAILS_BUTTON_DELETE_ITEM"] ."\" id=\"deleteItem\"></label></td></tr>";
        }
        ?>
    </table>
    <script type="text/javascript">
       $(document).ready(function()
       {
           $("#deleteItem").click(function(){
               $.post('?call=managerAccounts&subCall=editVault&action=modifyItem&account=<?php echo (isset($_GET['account']) ? $_GET['account'] : ''); ?>&subAction=deleteItem', {
                   item: <?php echo $_POST['item']; ?>
               }, function(response)
               {
                   $('#itemLeftInfo').html(response);
               }, 'html');
           });
       });
    </script> 
</form>
</div>