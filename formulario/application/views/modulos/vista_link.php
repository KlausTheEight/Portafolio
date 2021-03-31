<li class="nav-item">
	<a class="nav-link" href="#navbar-dashboards<?php echo $identificador ?>" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-dashboards">
		<i class="fas fa-tag"></i>
		<span class="nav-link-text text-black"><?php echo $tabla ?></span>
	</a>
	<div class="collapse" id="navbar-dashboards<?php echo $identificador ?>">
		<ul class="nav nav-sm flex-column">
			<li class="nav-item">
				<a href="<?php echo base_url().$tabla?>_controller/view_add" class="nav-link">Nuevo</a>
			</li>
			<li class="nav-item">
				<a href="<?php echo base_url().$tabla?>_controller/" class="nav-link">Listar</a>
			</li>
		</ul>
	</div>
</li>