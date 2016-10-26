<?php include("includes/header.php");?>
<div class="inner">
  <div class="content_box">
<?php    $files = scandir('./pages/'); ?>
<?php    $sb = scandir('./pages/sb/'); ?>
<ul>
  <?php
foreach($files as $file){
   echo'<li><a href="/pages/'.$file.'">'.$file.'</a></li>';
} ?>
</ul>
<h2>Schede Business</h2>
<ul>
  <?php
foreach($sb as $sb){
   echo'<li><a href="/pages/sb/'.$sb.'">'.$sb.'</a></li>';
} ?>
</ul>
    <h1>Indice</h1>
    <h3>Tipografia</h3>
    <ul>
      <li>Stili di Base</li>
      <li>Bottoni</li>
      <li>Blockquote e testi speciali</li>
    </ul>
    <h3>Colori</h3>
    <ul>
      <li>Stili di Base</li>
      <li>Bottoni</li>
      <li>Blockquote e testi speciali</li>
    </ul>
  </div>
</div>
<?php include("includes/footer.html");?>
