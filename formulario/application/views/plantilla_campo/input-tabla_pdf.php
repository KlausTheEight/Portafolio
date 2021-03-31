<?php
if (!isset($valores)) {
	$valores = null;
}
if ($valores != null) {
	$valores = json_decode($valores["valor"], true);
}
$obligatorio = $obligatorio == 1 ? "required"  : "";
?>
<table id="<?php echo $identificador ?>" class="<?= $class ?> <?= $obligatorio == "required" ? "validar" : "" ?>" border=1 style="width: 100% !important;" nombre="campo_<?php echo $id ?>" validaciones="tabla<?php echo ($validaciones != null ? ";".$validaciones : ""); ?>"  minimo="<?= $configuracion["total_lineas_requeridas"] ?>">
	<thead>
		<?php foreach ($configuracion["titulos"] as $titulos): ?>
			<tr>
				<?php foreach ($titulos as $t): ?>
					<th class="text-center"><?= $t ?></th>
				<?php endforeach ?>
			</tr>
		<?php endforeach ?>
	</thead>
	<tbody>
		<?php
		for ($i = 0; $i < $configuracion["total_lineas"]; $i++) {
			?>
			<tr>
				<?php
				for ($j = 0; $j < count($configuracion["titulos"][0]); $j++) {
					?>
					<?php if ($configuracion["etiquetas"] != null && isset($configuracion["etiquetas"][$j][$i])){
						?>
						<td>
							<?= $configuracion["etiquetas"][$j][$i] ?>
						</td>
					<?php }else{
						$tipo = "text";
						if ($configuracion["tipo_campo"][$j] == "numero") {
							$tipo = "number";
						}
						?>
						<td>
							<span>
								<?= $valores != null && isset($valores[$j]) && isset($valores[$j][$i]) ? $valores[$j][$i] : ""  ?>
							</span>
						</td>
						<?php
					} ?>
					<?php
				}
				?>
			</tr>
			<?php
		}
		?>
	</tbody>
</table>

<script>
	function _w_table_colspan(_w_table_id,_w_table_rownum,_w_table_maxcolnum){
		if(_w_table_maxcolnum == void 0){_w_table_maxcolnum=0;}
		_w_table_firsttd = "";
		_w_table_currenttd = "";
		_w_table_SpanNum = 0;
		$(_w_table_id + " thead tr:nth-child(" + _w_table_rownum + ")").each(function(i){
			_w_table_Obj = $(this).children();
			_w_table_Obj.each(function(i){
				if(i==0){
					_w_table_firsttd = $(this);
					_w_table_SpanNum = 1;
				}else if((_w_table_maxcolnum>0)&&(i>_w_table_maxcolnum)){
					return "";
				}else{
					_w_table_currenttd = $(this);
					if(_w_table_firsttd.text()==_w_table_currenttd.text()){
						_w_table_SpanNum++;
						_w_table_currenttd.hide();
						_w_table_firsttd.attr("colSpan",_w_table_SpanNum);
					}else{
						_w_table_firsttd = $(this);
						_w_table_SpanNum = 1;
					}
				}
			});
		});
	}

	function _w_table_rowspan(_w_table_id,_w_table_colnum, titulos){
		_w_table_firsttd = "";
		_w_table_currenttd = "";
		_w_table_SpanNum = 0;
		if (titulos == true) {
			_w_table_Obj = $(_w_table_id + " tr th:nth-child(" + _w_table_colnum + ")");
			_w_table_Obj.each(function(i){
				if(i==0){
					_w_table_firsttd = $(this);
					_w_table_SpanNum = 1;
				}else{
					_w_table_currenttd = $(this);
					if(_w_table_firsttd.text()==_w_table_currenttd.text()){
						_w_table_SpanNum++;
						_w_table_currenttd.hide();
						_w_table_firsttd.attr("rowSpan",_w_table_SpanNum);
					}else{
						_w_table_firsttd = $(this);
						_w_table_SpanNum = 1;
					}
				}
			});
		}else{
			_w_table_Obj = $(_w_table_id + " tr td:nth-child(" + _w_table_colnum + ")");
			_w_table_Obj.each(function(i){
				if(i==0){
					_w_table_firsttd = $(this);
					_w_table_SpanNum = 1;
				}else{
					_w_table_currenttd = $(this);
					if(_w_table_firsttd.text()==_w_table_currenttd.text()){
						_w_table_SpanNum++;
						_w_table_currenttd.hide();
						_w_table_firsttd.attr("rowSpan",_w_table_SpanNum);
					}else{
						_w_table_firsttd = $(this);
						_w_table_SpanNum = 1;
					}
				}
			});
		}
	}

	$(document).ready(function(){
		<?php
		if (isset($configuracion["etiquetas"])) {
			foreach ($configuracion["etiquetas"] as $key => $x) {
				?>
				_w_table_rowspan("#<?php echo $identificador ?>",<?= $key ?>, false);
				<?php
			}
		} ?>
		for (var i = $("#<?php echo $identificador ?> thead tr th").length - 1; i >= 0; i--) {
			_w_table_colspan("#<?php echo $identificador ?>",i);
			_w_table_rowspan("#<?php echo $identificador ?>",i, true);
		}
	})
</script>