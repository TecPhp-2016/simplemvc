<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>ID</th>
			<th>Nombre</th>
			<th>Edad</th>
		</tr>
	</thead>
	<tbody>
		<?php

		foreach ($usuarios as $key => $usuario) {
			$linkToEdit = '../../mvc/user/update?id=' . $usuario['id'];
			echo "<tr><td><a href='$linkToEdit'>{$usuario['id']}</a></td><td>{$usuario['name']}</td><td>{$usuario['age']}</td></tr>";
		}

		?>
	</tbody>
</table>

<table id='tablaUsuarios'></table>





<div class="box">
	<div class="box-header">
		<h3 class="box-title">Data Table With Full Features</h3>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
		<div class="row">
			<div class="col-sm-4">
				<div class="dataTables_length" id="example1_length">
					<label>Show
						<select name="example1_length" aria-controls="example1" class="form-control input-sm">
							<option value="10">10</option>
							<option value="25">25</option>
							<option value="50">50</option>
							<option value="100">100</option>
						</select> entries
					</label>
				</div>
			</div>
			<div class="col-sm-4">
				<div id="example1_filter" class="dataTables_filter">
					<label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="example1"></label>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
					<thead>
						<tr role="row">
							<th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column descending" aria-sort="ascending" style="width: 249px;">ID</th>
							<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Nombre: activar para ordenar por nombre acendente" style="width: 306px;">Nombre</th>
							<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Edades: activar orden acendente" style="width: 271px;">Edad</th>
					</thead>
					<tbody>

						<?php

							foreach ($usuarios as $key => $usuario) {
								$trCssClass = $key % 2 == 0 ? 'odd' : 'even';
								$linkToEdit = '../../mvc/user/update?id=' . $usuario['id'];
								echo "<tr class='$trCssClass'>
										<td class='sorting_1'>
											<a href='$linkToEdit'>{$usuario['id']}</a>
										</td>
										<td>
											{$usuario['name']}
										</td>
										<td>
											{$usuario['age']}
										</td>
									</tr>";
							}

						?>
	
					</tbody>

					<tfoot>
						<tr>
							<th rowspan="1" colspan="1">ID</th>
							<th rowspan="1" colspan="1">Nombre</th>
							<th rowspan="1" colspan="1">Edad</th>
					</tfoot>

			</table>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-5">
			<div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 21 to 30 of 57 entries</div>
		</div>
		<div class="col-sm-7">
			<div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
				<ul class="pagination">
				<li class="paginate_button previous" id="example1_previous"><a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0">Previous</a></li>
				<li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0">1</a></li>
				<li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="2" tabindex="0">2</a></li>
				<li class="paginate_button active"><a href="#" aria-controls="example1" data-dt-idx="3" tabindex="0">3</a></li>
				<li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="4" tabindex="0">4</a></li>
				<li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="5" tabindex="0">5</a></li>
				<li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="6" tabindex="0">6</a></li>
				<li class="paginate_button next" id="example1_next"><a href="#" aria-controls="example1" data-dt-idx="7" tabindex="0">Next</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>
