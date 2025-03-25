<html>
  <head>

  </head>
  <body>
    <table width="70%" align="center" border="1" cellspacing="0" cellpadding="0">
      <tr>
	<td colspan="6" align="center"><h1>BANNER GELECEK</h1></td>
      </tr>
      <tr>
	<td colspan="6">
    <?php
      $menu = array("Ana Sayfa", "Hakkımızda", "Projelerimiz", "Personel", "Öğrenciler", "Duyurular");
      $icerik = array (
        array("Ana Sayfa Başlığı","Ana sayfanın içerikleri buraya gelecek"),
        array("HAKKIMIZDA","<h2>Hakkımızdaki bilgiler</h2>"),
        array("Projeler","Deneme Proje"),
        array("Personel","Deneme Personel"),
        array("Öğrenciler","Deneme öğrenci"),
        array("Duyurular","Duyuru Listesi")
        );

    ?>

	  <table border="0" align="center" width="100%" cellspacing="0" cellpadding="0">
	    <tr>
          <?php
            for ($i=0; $i<count($menu);$i++) {
                echo '<td align="center"><a href="index.php?menu='.$i.'">'.$menu[$i].'</a></td>';
            }
          ?>	   
        
	    </tr>
	  </table>
	</td>

      </tr>
      <tr height="200">
	<td width="20%" valign="top">
	  <table border="1" cellpadding="0" cellspacing="0" width="100%">
	    <tr>
	      <th>&nbsp;</th>
	    </tr>
	    <tr>
	      <th>Bağlantılar</th>
	    </tr>
	    <tr>
	      <td><a href="https://alanya.edu.tr">Alanya Alaaddin Keykubat Üniversitesi</a></td>
	    </tr>
	    <tr>
	      <td><a href="https://yok.gov.tr">YÖK</a></td>
	    </tr>
	  </table>



	  
	  

	    </td>
	    <td colspan="5" valign="top">
            <table border="1" width="100%" align="center">
                <tr>
                    <td align="center">
                        <?php
                            $index=$_GET["menu"];
                            echo $icerik[$index][0];
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php  
                            echo $icerik[$index][1];
                        ?>
                    
                    </td>
                </tr>
            </table>
        
        
      </tr>
      
      <tr>
	<td colspan="6" align="center">Adresler ve iletişim</td>
      </tr>
    </table>
  </body>

</html>