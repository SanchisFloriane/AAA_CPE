<?php
/* Smarty version 3.1.32, created on 2018-05-13 14:20:28
  from '/Users/Alex/Sites/AAA_CPE/Views/Template.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5af82d8c8d8926_15449648',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e8f9d7b36d894185f6e3540f341d717114edf562' => 
    array (
      0 => '/Users/Alex/Sites/AAA_CPE/Views/Template.tpl',
      1 => 1526214011,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5af82d8c8d8926_15449648 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/Users/Alex/Sites/AAA_CPE/vendor/smarty/smarty/libs/plugins/modifier.replace.php','function'=>'smarty_modifier_replace',),1=>array('file'=>'/Users/Alex/Sites/AAA_CPE/vendor/smarty/smarty/libs/plugins/modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
echo '<?xml ';?>version="1.0" encoding="UTF-8"<?php echo '?>';?>
<!DOCTYPE html
        PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

    <title><?php echo (($tmp = @ucfirst(smarty_modifier_replace($_smarty_tpl->tpl_vars['fileToInclude']->value,'.tpl','')))===null||$tmp==='' ? 'Oups ! ' : $tmp);?>
 - AAA</title>
    <?php echo '<script'; ?>
 type="text/javascript" src="js/bootstrap.min.js"><?php echo '</script'; ?>
>
    <link rel="stylesheet" href="css/bootstrap.css"/>
    <link rel="stylesheet" href="css/custom.css"/>
    <link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet"/>

    <meta name="google-signin-client_id" content="111824800151-gu66ltunvubke0bi8o3jhigr2l8l3p0o.apps.googleusercontent.com"/>

    <?php echo '<script'; ?>
 src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"><?php echo '</script'; ?>
>
</head>
<nav id="navbar" class="navbar navbar-expand-lg navbar-dark bg-dark " >
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['pages']->value, 'url', false, 'nom');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['nom']->value => $_smarty_tpl->tpl_vars['url']->value) {
?>
                <li class="nav-item active">
                    <a class="nav-link" href="?page=<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['nom']->value;?>
 </a>
                </li>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            <?php if (!(is_bool($_smarty_tpl->tpl_vars['user']->value) && !$_smarty_tpl->tpl_vars['user']->value)) {?>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['pagesRestrict']->value, 'url', false, 'nom');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['nom']->value => $_smarty_tpl->tpl_vars['url']->value) {
?>
                    <li class="nav-item active">
                        <a class="nav-link" href="?page=<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['nom']->value;?>
 </a>
                    </li>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            <?php }?>

        </ul>
        <div id="authState">
            <div id="authStateContent">



                <div class="my-2 my-lg-0 text-white">
                    <?php if (is_bool($_smarty_tpl->tpl_vars['user']->value) && !$_smarty_tpl->tpl_vars['user']->value) {?>
                        <a   class="btn btn-outline-light ml-3" href="?page=login">Connexion</a>
                        <?php } else { ?>

                        Bonjour <?php echo $_smarty_tpl->tpl_vars['user']->value['firstname'];?>

                        <a class="btn btn-outline-light ml-3" href="?page=logout">Déconnexion
                        </a>
                    <?php }?>


                </div>

            </div>
        </div>
    </div>
</nav>
</head>
<body>
<div id="content" class="container p-3 _full ">
    <?php if (isset($_smarty_tpl->tpl_vars['error']->value)) {?>
    <div class="alert alert-danger" role="alert">
        <strong>Oh Merde !</strong> <?php echo $_smarty_tpl->tpl_vars['error']->value;?>

    </div>
    <?php }?>
    <?php if (isset($_smarty_tpl->tpl_vars['message']->value)) {?>
        <div class="alert alert-success" role="alert">
            <strong>Niquel !</strong> <?php echo $_smarty_tpl->tpl_vars['message']->value;?>

        </div>
    <?php }?>
    <?php if (isset($_smarty_tpl->tpl_vars['fileToInclude']->value)) {?>
        <?php $_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['fileToInclude']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
    <?php }?>
</div>

<footer>
    <div class="container-fluid bg-dark text-white pt-2 pb-2 position-sticky">
        <div class="container ">
            <div style="position: relative;
display: -webkit-flex;
display: flex;">

                &copy; Copyright <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['date']->value,"%Y");?>


            </div>
        </div>
    </div>


</footer>
</body>
</html><?php }
}
