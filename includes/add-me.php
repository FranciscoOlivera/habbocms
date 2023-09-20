<div class="panel panel-default me-info" style="background-image: url('<?php echo $totix->user('portada') . '?' . rand(0,999999); ?>'); background-position: center; background-size: 100%;">
    <div class="panel-body">
        <div class="col-xs-2"> <img src="<?php echo avatar . $totix->user('look'); ?>&size=m&gesture=sml&head_direction=3" /></div>
		<div class="col-xs-5 hidden-xs"><p>
			<b><?php echo $totix->user('username'); ?></b> <span class="label label-info"><?php echo $rank['name']; ?></span>
			<br />
			<i><?php echo $totix->user('motto'); ?></i>
			<br />
			Última conexión: <i><?php echo $totix->getlast($totix->user('last_online')); ?></i>
		</p></div>
		<div style="float: right;" class="col-xs-5">
			<a href="/client" target="_blank" class="btn btn-success btn-lg btn-block"><span class="glyphicon glyphicon-play"></span> Entrar a <?php echo name; ?> &raquo; </a>
			<a href="/home/<?php echo $totix->user('username'); ?>" class="btn btn-primary btn-lg btn-block"><span class="glyphicon glyphicon-user"></span> <?php echo $totix->user('username'); ?> &raquo; </a>
		</div>
    </div>
</div>