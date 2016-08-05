   <tr> 
    <td valign="top" class="text" align="center"> <div id="chartdiv" align="center"> 

               <?php  
        if (count($noticias) > 0) {
       
        	?>
	        <?php foreach ($noticias as $noticia): ?>
	        <blockquote>
				<?php if ($noticia['leer_mas']) { ?>
	            <p align="left"><h1><a href="<?php echo url_for('noticias/ver?idnoticia='.$noticia['id']) ?>"><?php echo $noticia['titulo'] ?></a></h1></p>
	            <?php }else{?>
	            <p align="left"><h1><?php echo $noticia['titulo'] ?></h1></p>
				<?php } ?>
	          <p>
	            <?php echo htmlspecialchars_decode($noticia['intro']); ?>
	            <?php if ($noticia['leer_mas']) { ?>
	            <a href="<?php echo url_for('noticias/ver?idnoticia='.$noticia['id']) ?>">Leer más...</a>
	            <?php } ?>
	          </p>
	        </blockquote>  
	        <?php endforeach; ?>   
        <?php }  ?>  
        </td>
  </div>
</td>
  </tr>
  <tr>

  
  
  
  
  
  
  
        <?php  
    /*    if (count($noticias) > 0) {
       
        	?>
	        <?php foreach ($noticias as $noticia): ?>
	        <blockquote>
				<?php if ($noticia['leer_mas']) { ?>
	            <p align="left"><h1><a href="<?php echo url_for('noticias/ver?idnoticia='.$noticia['id']) ?>"><?php echo $noticia['titulo'] ?></a></h1></p>
	            <?php }else{?>
	            <p align="left"><h1><?php echo $noticia['titulo'] ?></h1></p>
				<?php } ?>
	          <p>
	            <?php echo htmlspecialchars_decode($noticia['intro']); ?>
	            <?php if ($noticia['leer_mas']) { ?>
	            <a href="<?php echo url_for('noticias/ver?idnoticia='.$noticia['id']) ?>">Leer más...</a>
	            <?php } ?>
	          </p>
	        </blockquote>  
	        <?php endforeach; ?>   
        <?php } */ ?>  
  </tr>

