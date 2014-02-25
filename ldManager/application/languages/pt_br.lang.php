<?php                
/**
* Arquivo da lingua: pt_br - Português Brasil;
*/

/**
* Index base
*/
$this->languegeSet("TITLE", "ldManager - Editor de MuOnline");

/**
* Header
*/
$this->languegeSet("HEADER_BT_HOME", "Inicial");
$this->languegeSet("HEADER_BT_MANAGER_ACCOUNTS", "Gerenciar contas");
$this->languegeSet("HEADER_BT_MANAGER_CHARACTERS", "Gerenciar personagens");
$this->languegeSet("HEADER_BT_MANAGER_GUILDS", "Geranciar guilds");
$this->languegeSet("HEADER_BT_MANAGER_FILES", "Arquivos em geral");
$this->languegeSet("HEADER_BT_MANAGER_SETTINGS", "Configura&ccedil;&otilde;es");
$this->languegeSet("HEADER_BT_LOGOUT", "Sair");
$this->languegeSet("HEADER_BT_ABOUT", "Sobre");
$this->languegeSet("HEADER_BT_GO_SITE", "Voltar para o site");

/**
* Footer
*/
$this->languegeSet("FOOTER_EXECTION_TIME", "P&aacute;gina gerada em");
$this->languegeSet("FOOTER_LANGUAGE_ENGLISH", "Ingl&ecirc;s");
$this->languegeSet("FOOTER_LANGUAGE_PORTUGUESE", "Portugu&ecirc;s");

/**
* Login page
*/
$this->languegeSet("LOGIN_TITLE_H2", "Logar-se");
$this->languegeSet("LOGIN_LABEL_USERNAME", "Usu&aacute;rio:");
$this->languegeSet("LOGIN_LABEL_PASSWORD", "Senha:");
$this->languegeSet("LOGIN_BT_AUTENTICATE", "Autenticar");
$this->languegeSet("LOGIN_BAD_LOGIN", "Usu&aacute;rio ou senha inv&aacute;lidos.");

/**
* Logged default page
*/
$this->languegeSet("LOGGED_TITLE_H2", "Seja bem vindo");
$this->languegeSet("LOGGED_MESSAGE", "Escolha as op&ccedil;&otilde;es que voc&ecirc; deseja acessar usando os menus superiores.");

/**
* About default page
*/
$this->languegeSet("ABOUT_TITLE_H2", "Sobre");
$this->languegeSet("ABOUT_MESSAGE", "Esse editor foi desenvolvido com o prop&oacute;sito de facilitar a administra&ccedil;&atilde;o de servidores de MuOnline.<br /><br />O editor possui dezenas de fun&ccedil;&otilde;es que lhe ajudaram a administrar contas, personagens, guilds, e at&eacute; mesmo arquivos do MuServer e tambem do Cliente.<br /><br />Uso exclusivo para o MuSite v2.0 +.<br /><br />Editor programado por Leandro Daldegam.<br />Desenvolvido em: 08/2011"); 

/**                              
* Manager Accounts  - Default page
*/
$this->languegeSet("MNG_ACC_TITLE_H2", "Gerenciar contas");
$this->languegeSet("MNG_ACC_MESSAGE", "Escolha a op&ccedil;&atilde;o desejada no menu lateral."); 
$this->languegeSet("MNG_ACC_SUB_MENU", "Op&ccedil;&otilde;es");

$this->languegeSet("MNG_ACC_SUB_MENU_CREATE_ACCOUNT", "Criar conta");
$this->languegeSet("MNG_ACC_SUB_MENU_EDIT_ACCOUNT", "Editar conta");
$this->languegeSet("MNG_ACC_SUB_MENU_REMOVE_ACCOUNT", "Remover conta");
$this->languegeSet("MNG_ACC_SUB_MENU_EDIT_VAULT", "Editar ba&uacute;");

/**
* Manager Accounts - Create Account page
*/
$this->languegeSet("MNG_ACC_CA_TITLE_H2", "Criar conta");
$this->languegeSet("MNG_ACC_CA_LABEL_USERNAME", "Usu&aacute;rio"); 
$this->languegeSet("MNG_ACC_CA_LABEL_PASSWORD", "Senha");
$this->languegeSet("MNG_ACC_CA_LABEL_NAME", "Nome");  
$this->languegeSet("MNG_ACC_CA_LABEL_EMAIL", "Email"); 
$this->languegeSet("MNG_ACC_CA_LABEL_PERSONALID", "Personal ID"); 
$this->languegeSet("MNG_ACC_CA_LABEL_QUESTION", "Pergunta secreta"); 
$this->languegeSet("MNG_ACC_CA_LABEL_ANSWER", "Resposta secreta"); 
$this->languegeSet("MNG_ACC_CA_BT_CREATE", "Criar conta");
$this->languegeSet("MNG_ACC_CA_EMPTY_FIELDS", "Campos em branco.");
$this->languegeSet("MNG_ACC_CA_LOGIN_EXISTS", "Esse login j&aacute; existe."); 
$this->languegeSet("MNG_ACC_CA_LOGIN_DONE", "Registrado com sucesso."); 

/**
* Manager Accounts - Edit Account page
*/ 
$this->languegeSet("MNG_ACC_EA_TITLE_H2", "Editar conta");
$this->languegeSet("MNG_ACC_EA_LABEL_USERNAME", "Usu&aacute;rio"); 
$this->languegeSet("MNG_ACC_EA_LABEL_PASSWORD", "Senha"); 
$this->languegeSet("MNG_ACC_EA_LABEL_NAME", "Nome"); 
$this->languegeSet("MNG_ACC_EA_LABEL_EMAIL", "Email"); 
$this->languegeSet("MNG_ACC_EA_LABEL_PERSONALID", "Personal ID"); 
$this->languegeSet("MNG_ACC_EA_LABEL_QUESTION", "Pergunta secreta"); 
$this->languegeSet("MNG_ACC_EA_LABEL_ANSWER", "Resposta secreta");   
$this->languegeSet("MNG_ACC_EA_BT_LOAD", "Carregar conta"); 
$this->languegeSet("MNG_ACC_EA_BT_SAVE", "Salvar conta"); 
$this->languegeSet("MNG_ACC_EA_EMPTY_FIELDS", "Campos em branco.");             
$this->languegeSet("MNG_ACC_EA_LOGIN_NOT_EXISTS", "Esse login n&atilde;o existe.");
$this->languegeSet("MNG_ACC_EA_ENABLED_MD5", "MD5 ativado. Deixe a senha em branco para n&atilde;o alterar-la."); 
$this->languegeSet("MNG_ACC_EA_DONE", "Editado com sucesso.");

/**
* Manager Accounts - Remove Account page
*/
$this->languegeSet("MNG_ACC_RA_TITLE_H2", "Remover conta");
$this->languegeSet("MNG_ACC_RA_LABEL_USERNAME", "Usu&aacute;rio");         
$this->languegeSet("MNG_ACC_RA_BT_REMOVE", "Remover conta");
$this->languegeSet("MNG_ACC_RA_EMPTY_FIELDS", "Campos em branco.");  
$this->languegeSet("MNG_ACC_RA_LOGIN_NOT_EXISTS", "Esse login n&atilde;o existe.");
$this->languegeSet("MNG_ACC_RA_DONE", "Conta deleta com sucesso."); 

/**
* Manager Accounts - Edit Vault page
*/
   $this->languegeSet("MNG_ACC_EV_TITLE_H2", "Editar ba&uacute;");
$this->languegeSet("MNG_ACC_EV_LABEL_USERNAME", "Usu&aacute;rio");         

$this->languegeSet("MNG_ACC_EV_LABEL_CATEGORY", "Categoria"); 
$this->languegeSet("MNG_ACC_EV_LABEL_OPTIONS_EXCELLENTS", "Op&ccedil;&otilde;es excelentes"); 
$this->languegeSet("MNG_ACC_EV_LABEL_ITEM", "Item"); 
$this->languegeSet("MNG_ACC_EV_LABEL_SERIAL", "Serial"); 
$this->languegeSet("MNG_ACC_EV_LABEL_LEVEL", "Level"); 
$this->languegeSet("MNG_ACC_EV_LABEL_ADDITIONAL", "Adicional"); 
$this->languegeSet("MNG_ACC_EV_LABEL_ANCIENT", "Ancient"); 
$this->languegeSet("MNG_ACC_EV_LABEL_SKILL", "Skill"); 
$this->languegeSet("MNG_ACC_EV_LABEL_OPTIONS_HARMONY", "Op&ccedil;&otilde;es harmony"); 
$this->languegeSet("MNG_ACC_EV_LABEL_LUCK", "Sorte"); 
$this->languegeSet("MNG_ACC_EV_LABEL_OPTIONS_REFINE", "Op&ccedil;&atilde;o refine"); 
$this->languegeSet("MNG_ACC_EV_LABEL_OPTIONS_SOCKET", "Op&ccedil;&otilde;es socket"); 


$this->languegeSet("MNG_ACC_EV_SELECT_LOADING", "Carregando...");
$this->languegeSet("MNG_ACC_EV_SEXY_HAVE_ITEM_SLOT", "J&aacute; existe um item nesse slot...");
$this->languegeSet("MNG_ACC_EV_SEXY_ITEM_SLOT_NO_SPACE_TRY", "Esse espa&ccedil;o n&atilde;o suporta o item... <br />Tente o slot %d que est&aacute; em amarelo.");
$this->languegeSet("MNG_ACC_EV_SEXY_ITEM_SLOT_NO_SPACE", "N&atilde;o h&aacute; espa&ccedil;o no ba&uacute; para adicionar o item.");


$this->languegeSet("MNG_ACC_EV_TOOLTIP_EXCELLENT", "Excelente"); 
$this->languegeSet("MNG_ACC_EV_TOOLTIP_LEVEL", "Level"); 
$this->languegeSet("MNG_ACC_EV_TOOLTIP_LUCK", "Sorte"); 
$this->languegeSet("MNG_ACC_EV_TOOLTIP_SKILL", "Skill"); 
$this->languegeSet("MNG_ACC_EV_TOOLTIP_ADDITIONAL", "Adicionais"); 
$this->languegeSet("MNG_ACC_EV_TOOLTIP_DURABILITY", "Durabilidade"); 
$this->languegeSet("MNG_ACC_EV_TOOLTIP_SERIAL", "Serial"); 
$this->languegeSet("MNG_ACC_EV_TOOLTIP_ANCIENT", "Ancient"); 
$this->languegeSet("MNG_ACC_EV_TOOLTIP_OPTION_REFINE", "Refine"); 
$this->languegeSet("MNG_ACC_EV_TOOLTIP_OPTION_HARMONY", "Harmony"); 
$this->languegeSet("MNG_ACC_EV_TOOLTIP_OPTION_SOCKET", "Socket"); 

                                                              
$this->languegeSet("MNG_ACC_EV_LABEL_DETAILS_TITLE", "Detalhes dos itens"); 
$this->languegeSet("MNG_ACC_EV_LABEL_DETAILS_ITEM", "Item"); 
$this->languegeSet("MNG_ACC_EV_LABEL_DETAILS_LEVEL", "Level"); 
$this->languegeSet("MNG_ACC_EV_LABEL_DETAILS_LUCK", "Luck"); 
$this->languegeSet("MNG_ACC_EV_LABEL_DETAILS_SKILL", "Skill"); 
$this->languegeSet("MNG_ACC_EV_LABEL_DETAILS_ADDITIONAL", "Adicionais"); 
$this->languegeSet("MNG_ACC_EV_LABEL_DETAILS_DURABILITY", "Durabilidade"); 
$this->languegeSet("MNG_ACC_EV_LABEL_DETAILS_SERIAL", "Serial"); 
$this->languegeSet("MNG_ACC_EV_LABEL_DETAILS_ANCIENT", "Ancient");
$this->languegeSet("MNG_ACC_EV_LABEL_DETAILS_OPTIONS_EXCELLENTS", "Op&ccedil;&otilde;es excelentes"); 
$this->languegeSet("MNG_ACC_EV_LABEL_DETAILS_OPTIONS_HARMONY", "Harmony"); 
$this->languegeSet("MNG_ACC_EV_LABEL_DETAILS_OPTIONS_REFINE", "Refine"); 
$this->languegeSet("MNG_ACC_EV_LABEL_DETAILS_OPTIONS_SOCKET", "Socket"); 
$this->languegeSet("MNG_ACC_EV_LABEL_DETAILS_BUTTON_DELETE_ITEM", "Deletar item"); 
        
$this->languegeSet("MNG_ACC_EV_BT_REMOVE", "Carregar ba&uacute;");
$this->languegeSet("MNG_ACC_EV_EMPTY_FIELDS", "Campos em branco.");  
$this->languegeSet("MNG_ACC_EV_LOGIN_NOT_EXISTS", "Esse login n&atilde;o existe.");
$this->languegeSet("MNG_ACC_EV_INVALID_ITEM", "Esse item n&atilde;o existe.");

$this->languegeSet("DATABASE_CANT_LOAD", "N&atilde;o foi possivel carregar o banco de dados.");
?>