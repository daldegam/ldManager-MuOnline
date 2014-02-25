<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="public/templates/style.css" rel="stylesheet" type="text/css" />
<script src="public/templates/jquery-1.4.2.js"></script>  
<script type="text/javascript" src="public/templates/sexy-tooltips.v1.1.jquery.js"></script>                       
<script type="text/javascript" src="public/templates/jquery.easing.1.3.js"></script>                       
<script type="text/javascript" src="public/templates/sexyalertbox.v1.2.jquery.js"></script>                       
<link rel="stylesheet" href="public/templates/images/sexy-tooltips/dark.css" type="text/css" media="all" id="theme"/>                  
<link rel="stylesheet" href="public/templates/sexyalertbox.css" type="text/css" media="all" />  
<title><?php echo $language->sentence["TITLE"]; ?></title>
</head>

<body>
<div class="main">
  <?php require("header.auth.tpl.php"); ?>
  <div class="clr"></div>
  <div class="blog_body">
    <div class="blog_bottom">
      <div class="left">
        <h2 class="sevr"><?php echo $language->sentence["MNG_ACC_EV_TITLE_H2"]; ?></h2>
        <form method="post" action="?call=managerAccounts&subCall=editVault&action=check" id="form" name="form">
            <table id="vaultSpecifications">
                <tr>
                    <td style="width: 280px;">
                        <label for="username"><?php echo $language->sentence["MNG_ACC_EV_LABEL_USERNAME"]; ?></label>    
                        <input name="username" type="text" value="<?php echo (isset($_GET['account']) ? $_GET['account'] : ''); ?>" maxlength="10" readonly="readonly" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label><?php echo $language->sentence["MNG_ACC_EV_LABEL_CATEGORY"]; ?></label>
                        <select name="itemSection" id="itemSection">
                            <option value="0">Swords</option>
                            <option value="1">Axes</option>
                            <option value="2">Maces</option>
                            <option value="3">Spears</option>
                            <option value="4">Bows</option>
                            <option value="5">Staffs</option>
                            <option value="6">Shields</option>
                            <option value="7">Helms</option>
                            <option value="8">Armors</option>
                            <option value="9">Pants</option>
                            <option value="10">Gloves</option>
                            <option value="11">Boots</option>
                            <option value="12">Wings/Orb/Jewel/Box</option>
                            <option value="13">Pets/Rings/Pendants</option>
                            <option value="14">Other</option>
                            <option value="15">Scroll</option>
                        </select>
                    </td>
                    <td rowspan="6">
                        <li style="list-style: none; padding: 0px;">
                        <fieldset>
                            <legend><?php echo $language->sentence["MNG_ACC_EV_LABEL_OPTIONS_EXCELLENTS"]; ?></legend>         
                            <input name="excOp0" id="excOp0" class="excOp" type="checkbox" value="1" /> <strong id="excText0" class="normal">No Effect</strong><br />
                            <input name="excOp1" id="excOp1" class="excOp" type="checkbox" value="1" /> <strong id="excText1" class="normal">No Effect</strong><br />
                            <input name="excOp2" id="excOp2" class="excOp" type="checkbox" value="1" /> <strong id="excText2" class="normal">No Effect</strong><br />
                            <input name="excOp3" id="excOp3" class="excOp" type="checkbox" value="1" /> <strong id="excText3" class="normal">No Effect</strong><br />
                            <input name="excOp4" id="excOp4" class="excOp" type="checkbox" value="1" /> <strong id="excText4" class="normal">No Effect</strong><br />
                            <input name="excOp5" id="excOp5" class="excOp" type="checkbox" value="1" /> <strong id="excText5" class="normal">No Effect</strong>
                        </fieldset> 
                        </li>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label><?php echo $language->sentence["MNG_ACC_EV_LABEL_ITEM"]; ?></label>
                        <select name="itemIndex" id="itemIndex"></select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label><?php echo $language->sentence["MNG_ACC_EV_LABEL_SERIAL"]; ?></label>
                        <input name="itemSerial" id="itemSerial" type="checkbox" value="1" />
                        <input name="itemSerialText" id="itemSerialText" checked="checked" type="text" value="FFFFFFFF" maxlength="8" style="width: 70px;" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label><?php echo $language->sentence["MNG_ACC_EV_LABEL_LEVEL"]; ?></label>
                        <select name="itemLevel" id="itemLevel">
                            <option value="0">+0</option>
                            <option value="1">+1</option>
                            <option value="2">+2</option>
                            <option value="3">+3</option>
                            <option value="4">+4</option>
                            <option value="5">+5</option>
                            <option value="6">+6</option>
                            <option value="7">+7</option>
                            <option value="8">+8</option>
                            <option value="9">+9</option>
                            <option value="10">+10</option>
                            <option value="11">+11</option>
                            <option value="12">+12</option>
                            <option value="13">+13</option>
                            <option value="14">+14</option>
                            <option value="15">+15</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label><?php echo $language->sentence["MNG_ACC_EV_LABEL_ADDITIONAL"]; ?></label>
                        <select name="itemOption" id="itemOption">
                            <option value="0">+0</option>
                            <option value="1">+4</option>
                            <option value="2">+8</option>
                            <option value="3">+12</option>
                            <option value="4">+16</option>
                            <option value="5">+20</option>
                            <option value="6">+24</option>
                            <option value="7">+28</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label><?php echo $language->sentence["MNG_ACC_EV_LABEL_ANCIENT"]; ?></label>
                        <select name="itemAncient" id="itemAncient">
                            <option value="-1">No Effect</option>
                            <option value="1">Ancient 1</option>
                            <option value="2">Ancient 2</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label><?php echo $language->sentence["MNG_ACC_EV_LABEL_SKILL"]; ?></label>
                        <input name="skillOp" id="skillOp" type="checkbox" value="1" />
                    </td>
                    <td rowspan="2">
                        <li style="list-style: none; padding: 0px;">
                        <fieldset>
                            <legend><?php echo $language->sentence["MNG_ACC_EV_LABEL_OPTIONS_HARMONY"]; ?></legend>          
                            <select name="itemHarmony" id="itemHarmony">
                                <option value="-1">No Effect</option>
                            </select>
                        </fieldset> 
                        </li>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label><?php echo $language->sentence["MNG_ACC_EV_LABEL_LUCK"]; ?></label>
                        <input name="luckOp" id="luckOp" type="checkbox" value="1" />
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <li style="list-style: none; padding: 0px;">
                        <label><?php echo $language->sentence["MNG_ACC_EV_LABEL_OPTIONS_REFINE"]; ?></label>
                        <input name="refineOp" id="refineOp" type="checkbox" value="1" /> <strong id="refineText" class="normal">No Effect</strong>
                        </li>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <li style="list-style: none; padding: 0px;">
                        <fieldset>
                            <legend><?php echo $language->sentence["MNG_ACC_EV_LABEL_OPTIONS_SOCKET"]; ?></legend>
                            <p><select name="socketOp0" id="socketOp0" class="socketOp"><option value="255">No Socket Option</option></select></p>
                            <p><select name="socketOp1" id="socketOp1" class="socketOp"><option value="255">No Socket Option</option></select></p>
                            <p><select name="socketOp2" id="socketOp2" class="socketOp"><option value="255">No Socket Option</option></select></p>
                            <p><select name="socketOp3" id="socketOp3" class="socketOp"><option value="255">No Socket Option</option></select></p>
                            <p><select name="socketOp4" id="socketOp4" class="socketOp"><option value="255">No Socket Option</option></select></p>
                        </fieldset> 
                        </li>
                    </td>
                </tr>
            </table>
        </form>
            <div id="responseNull" style="display: none;"></div>
            <table id="vaultStructure">
                <tr>
                    <td style="width: 280px; vertical-align: top;" id="itemLeftInfo">
                        
                    </td>
                    <td>
                       <div class="vaultStructure">
                       <?php 
                       for($i = 0; $i < 120; $i++)
                            echo "<div class=\"slot\" id=\"slot_{$i}\"></div>\n";
                       ?>
                       </div> 
                       <script type="text/javascript">
                       function callModifyItem(id)
                       {
                            $.post('?call=managerAccounts&subCall=editVault&action=modifyItem&account=<?php echo (isset($_GET['account']) ? $_GET['account'] : ''); ?>', {
                                item: id
                            }, function(response)
                            {
                                $('#itemLeftInfo').html(response);
                            }, 'html');   
                       }
                        
                       function serialCheck()
                       {
                           if($("#itemSerial").attr("checked") == false)
                            {
                                $("#itemSerialText").val("FFFFFFFF");
                            }
                            else
                                $.post('?call=managerAccounts&subCall=editVault&action=getSerial', function(response)
                                {
                                    $('#itemSerialText').val(response);
                                }, 'html');
                       }     
                       $(document).ready(function()
                       {
                            $("#itemIndex").html("<option value='-1'><?php echo $language->sentence["MNG_ACC_EV_SELECT_LOADING"]; ?></option>").load("?call=managerAccounts&subCall=editVault&action=loadSelect",{type: 'item', value: 0 });
                            
                            $("#itemSerial").click(function(){ 
                                serialCheck();
                            });
                            
                            $("#itemSection").change(function(){ 
                                $('.slot').removeClass('slotAttention'); 
                                serialCheck();
                                $("#itemIndex").html("<option value='0'><?php echo $language->sentence["MNG_ACC_EV_SELECT_LOADING"]; ?></option>").load("?call=managerAccounts&subCall=editVault&action=loadSelect",{type: 'item', value: $("#itemSection").val() });
                                $("#responseNull").load("?call=managerAccounts&subCall=editVault&action=loadSelect",{type: 'details', section: $("#itemSection").val(), index: $(this).val() });  
                            });
                            
                            $("#itemIndex").change(function(){ 
                                //$("#responseNull").css("display", "block"); //Remover
                                $('.slot').removeClass('slotAttention'); 
                                serialCheck();
                                $("#responseNull").load("?call=managerAccounts&subCall=editVault&action=loadSelect",{type: 'details', section: $("#itemSection").val(), index: $(this).val() });  
                            });
                            
                            $(".slot").click(function(){
                                $(this).removeClass('slotAttention'); 
                                serialCheck();
                                $.post('?call=managerAccounts&subCall=editVault&action=insertItem&account=<?php echo (isset($_GET['account']) ? $_GET['account'] : ''); ?>&slot='+ $(this).attr("id").split("_")[1], $("#form").serialize(), 
                                function(response)
                                {
                                    $("#itemLeftInfo").html( response );
                                }, 'html'); 
                            });
                            
                            <?php
                                echo isset($managerAccounts->tempJQuery) ? $managerAccounts->tempJQuery : '';
                            ?>
                       });
                       </script>  
                    </td>
                </tr>
            </table> 
        <div class="bg"></div>
      </div>
      <div class="right">
        <h2><?php echo $language->sentence["MNG_ACC_SUB_MENU"]; ?></h2>
        <ul>
          <li><a href="?call=managerAccounts&subCall=createAccount"><?php echo $language->sentence["MNG_ACC_SUB_MENU_CREATE_ACCOUNT"]; ?></a></li>
          <li><a href="?call=managerAccounts&subCall=editAccount"><?php echo $language->sentence["MNG_ACC_SUB_MENU_EDIT_ACCOUNT"]; ?></a></li>
          <li><a href="?call=managerAccounts&subCall=removeAccount"><?php echo $language->sentence["MNG_ACC_SUB_MENU_REMOVE_ACCOUNT"]; ?></a></li>
          <li><a href="?call=managerAccounts&subCall=editVault"><strong><?php echo $language->sentence["MNG_ACC_SUB_MENU_EDIT_VAULT"]; ?></strong></a></li>
        </ul>
      </div>
      <div class="clr"></div>
    </div>
    <div class="clr"></div>
  </div>
  
  <?php require("footer.tpl.php"); ?>
</div>
</body>
</html>
