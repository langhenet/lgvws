<?php include("includes/header.html");?>
<div class="inner">
  <div class="content_box">
<?php    $files = scandir('./pages/'); ?>
<ul>
  <?php
foreach($files as $file){
   echo'<li><a href="/pages/'.$file.'">'.$file.'</a></li>';
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
