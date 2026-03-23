<?php require_once('../config.php'); ?>
<?php 
$page = isset($_GET['page']) ? $_GET['page'] : 'home';  
$pageSplit = explode("/",$page);  
if(isset($pageSplit[1]))
$pageSplit[1] = (strtolower($pageSplit[1]) == 'list') ? $pageSplit[0].' List' : $pageSplit[1];
?>
<!DOCTYPE html>
<html lang="en">
<?php require_once('../admin/inc/header.php') ?>
  <body>
     <?php require_once('../admin/inc/topBarNav.php') ?>
     <?php require_once('inc/navigation.php') ?>   
      <main id="main" class="main">
        <div class="pagetitle">
          <h1><?= ucwords(str_replace(['_', '/'], ' ', ($pageSplit[1] ?? $page))) ?></h1>
          <nav>
              <ol class="breadcrumb">
                <li class="breadcrumb-item <?= $page == 'home' ? 'selected' : '' ?>"><a href="<?= base_url ?>user">User Dashboard</a></li>
                <?php if($page != 'home'): ?>
                <li class="breadcrumb-item active"><?= ucwords(str_replace(['_', '/'], ' ', ($pageSplit[1] ?? $page))) ?></li>
                <?php endif; ?>
              </ol>
          </nav>
        </div>
        <div id="msg-container"></div>
        <?php 
          if(!file_exists($page.".php") && !is_dir($page)){
              include '../404.html';
          }else{
            if(is_dir($page))
              include $page.'/index.php';
            else
              include $page.'.php';
          }
        ?>
      </main>
    <?php require_once('../admin/inc/footer.php') ?>
  </body>
</html>
