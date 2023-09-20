<?php
if($totix->user('rank') >= hkmin) {
?>
<?php if(isset($_SESSION['aviso_error'])) { echo '<div class="alert alert-danger">'.$_SESSION['aviso_error'].'</div>'; } ?>
<div class="panel panel-default">
  <div class="panel-body">
        <div class="foto_usuario" style="background: url(<?php echo avatar . $totix->user('look'); ?>&direction=3&head_direction=3&size=b&gesture=agr); background-position: -13px -20px; background-color: #e6c873;"></div>
        <form action="<?php echo www; ?>/app/submits/aviso_submit.php" method="POST">
            <div class="form-group">
              <div class="col-lg-10">
                <textarea class="form-control" rows="3" name="aviso" id="textArea" placeholder="Esta sección es para publicar pequeños avisos y actualizaciones del hotel, usala bien"></textarea>
              </div>
            </div>
	        <div class="form-group">
              <div class="col-xs-6" style="margin-top: 15px;">
                <button type="submit" class="btn btn-primary btn-lg btn-block">Publicar</button>
              </div>
			  <div class="col-xs-6" style="margin-top: 15px;">
				<button type="button" class="btn btn-danger btn-lg btn-block" data-toggle="modal" data-target="#Codes">Codes</button>
			  </div>
            </div>
        </form>
  </div>
</div>

<div class="modal fade" id="Codes" tabindex="-1" role="dialog" aria-labelledby="CodesLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
		<font size="6">Códigos comunes</font>
		<br /><br />
		[i]Texto en cursiva[/i] - <i>Texto en cursiva</i>
		<br />
		[b]Texto en negritas[/b] - <b>Texto en negritas</b>
		<br />
		[u]Texto subrayado[/u] - <u>Texto subrayado</u>
		<br />
		[br] - Salto de línea
		<br />
		<br />
		<font size="6">Códigos embed</font>
		<br /><br />
		<b>Vídeos de youtube: </b>youtubevideo-[Link despues del "watch"] - <i>Ej: youtubevideo-9wM0MMKvUHk</i>
		<br />
		<b>Imágenes: </b>[img][Link de la imagen][/img] - <i>Ej: [img]http://i.imgur.com/is5E4hZ.gif[/img]</i>
		<br />
		<b>Hipervinculo: </b>[url=[LINK]][Cualquier texto][/url] - <i>Ej: [url=http://beeg.com]¡Visitame![/url]</i>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar cuadro</button>
      </div>
    </div>
  </div>
</div>
<?php } ?>