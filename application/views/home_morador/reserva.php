<div class="container mt-3">
	<?php  print validation_errors(); ?>
	<div class="row">
		<div class="col-md-6">
			<h1>Reservar</h1>
			<form action="salvarReserva" method="post">
				<div class="form-group">
				    <label for="dia">Dia reserva</label>
				    <input type="date" class="form-control" name="dia" id="dia"/>
				</div>
				<div class="form-group">
					<label for="local">Local reserva</label>
					<select name="local" class="form-control">
						<option value="">Selecione</option>
						<?php foreach ($tipo_reserva as $key => $value): ?>
							<option value="<?= $value['id_tipo_reserva']?>"><?= $value['nome_reserva']?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="form-group">
					<button type="submit" id="reservar" class="btn btn-primary">Reservar</button>
				</div>
			</form>
		</div>
		<div class="col-md-6">
			<h1>Reservados</h1>
			<ul class="reservas">
				<?php foreach ($reserva as $key => $value): ?>
					<li><p><i class="fa fa-check-circle-o" aria-hidden="true"></i> <strong><?= $value['nome_reserva'] ?></strong> agendado na data <strong><?= formataDataToView($value['dia_reserva']) ?></strong></p></li>
				<?php endforeach ?>
			</ul>
			
		</div>
	</div>
</div>
<?php
echo "<pre>"; 
//print_r($reserva); 
//print_r($tipo_reserva); 
echo "</pre>"; ?>