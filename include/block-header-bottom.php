<div id="block-header-bottom">
 <?php
 
if ($_SESSION['auth_login'] == 'admin')
 {
    
 echo '
  <nav>
  <ul>
    <li>
      <a href="ecscurs.php">���������</a>
    </li>
    <li>
      <a href="tur.php">����</a>
    </li>
    <li>
      <a href="stat.php">����������</a>
    </li>
  </ul>
  </nav>
  ';
  }else{
  echo '  
  <nav>
  <ul>
    <li>
      <a href="ecscurs.php">���������</a>
    </li>
    <li>
      <a href="tur.php">����</a>
    </li>
    </ul>
  </nav>
  ';
  }
  ?>
</div>