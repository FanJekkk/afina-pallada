<div id="block-header-bottom">
 <?php
 
if ($_SESSION['auth_login'] == 'admin')
 {
    
 echo '
  <nav>
  <ul>
    <li>
      <a href="ecscurs.php">Ёкскурсии</a>
    </li>
    <li>
      <a href="tur.php">“уры</a>
    </li>
    <li>
      <a href="stat.php">—татистика</a>
    </li>
  </ul>
  </nav>
  ';
  }else{
  echo '  
  <nav>
  <ul>
    <li>
      <a href="ecscurs.php">Ёкскурсии</a>
    </li>
    <li>
      <a href="tur.php">“уры</a>
    </li>
    </ul>
  </nav>
  ';
  }
  ?>
</div>