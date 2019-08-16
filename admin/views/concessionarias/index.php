<?php require_once("cadastrar.php"); ?>
<div class="col-xs-12">
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Concessionarias</h3>
			<div class="box-tools pull-right">
				<div class="has-feedback">

					<button class="btn btn-sm btn-info pop" onclick="openFiltro('<?php echo $viewData['pageController']; ?>')">
						<i class="glyphicon glyphicon-search"></i>
					</button>
					<?php if ($this->user->hasPermission('concessionaria_view') && $this->user->hasPermission('concessionaria_add')) : ?>
					<button class="btn btn-sm btn-info pop" data-toggle="modal" data-target="#modalCadastro<?php echo ucfirst($viewData['pageController']) ?>">
						<i class="fa fa-fw fa-plus-circle"></i>
					</button>
					<?php endif; ?>
					<a href="<?php echo BASE_URL; ?>concessionarias" type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></a>
				</div>
			</div>
		</div>

		<div class="box-body no-padding">
			<?php include_once("filtro.php"); ?>
			<div class="table-responsive mailbox-messages">
				<table class="table table-hover table-striped table-bordered">
					<?php if (count($tableDados) > 0) : ?>
					<tbody>
						<div class="box">
							<div class="box-body table-responsive no-padding">
								<table class="table table-hover">
									<tbody>
										<tr>
											<th style="width: 22%;">Ações</th>
											<th>ID</th>
											<th>Razão Social</th>
											<th class="text-center">Qnt de Serviços </th>
										</tr>
										<?php foreach ($tableDados as $inf) : ?>
										<?php
												$count_sev = 0;
												$array = $this->concessionaria->getInfo($inf['id'], '1');
												$count_sev = isset($array['servicos_concessionaria']) ? count($array['servicos_concessionaria']) : $count_sev;
												?>
										<tr>
											<td>
												<?php if ($this->user->hasPermission('concessionaria_view') && $this->user->hasPermission('concessionaria_edit')) : ?>
												<a type="button" class="btn btn-info" href="<?php echo BASE_URL ?>concessionarias/edit/<?php echo $inf['id'] ?>"><i class="fa fa-fw fa-edit"></i></a>
												<?php endif; ?>
												<a type="button" class="btn btn-danger" href="<?php echo BASE_URL ?>concessionarias/delete/<?php echo $inf['id'] ?>"><i class="fa fa-fw fa-trash"></i></a>
											</td>
											<td><?php echo $inf['id'] ?></td>
											<td><?php echo $inf['razao_social'] ?></td>
											<td class="text-center"><?php echo $count_sev ?></td>
										</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
					</tbody>
					<?php else : ?>
					<tr>
						<td style="width: 50%;text-align: center;"> Não foram encontrados resultados </td>
					</tr>
					<?php endif; ?>
				</table>
			</div>
			<div class="pull-left" style="right: 10px;">
				<p> Quantidade de Concessionarias: <?php echo $getCount; ?> </p>
			</div>
		</div>
		<div class="box-footer no-padding">
			<div class="mailbox-controls">
				<ul class="pagination pagination-sm pull-right">
					<?php for ($q = 1; $q <= $p_count; $q++) : ?>
					<li class="<?php echo ($q == $p) ? 'active' : '' ?> ">
						<a href="<?php echo BASE_URL; ?>concessionarias?p=<?php $w = $_GET;
																				$w['p'] = $q;
																				echo http_build_query($w); ?>"><?php echo $q; ?></a>
					</li>
					<?php endfor; ?>
				</ul>
			</div>
		</div>
	</div>
</div>

<script>
	<?php if (isset($_GET['modalcadastro'])) : error_log(print_r($_GET,1));?>
	var id = '<?php echo ucfirst($viewData['pageController']) ?>';
	console.log(id);
	$(function() {
		$('#modalCadastro' + id).modal('show');
	});
	<?php endif; ?>
</script>