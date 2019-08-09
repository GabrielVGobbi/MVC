<?php require_once("cadastrar.php"); ?>
<div class="col-xs-12">
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title"><?php echo ucfirst($viewData['pageController']); ?></h3>
			<div class="box-tools pull-right">
				<div class="has-feedback">

					<button class="btn btn-sm btn-info pop" onclick="openFiltro('<?php echo $viewData['pageController']; ?>')">
						<i class="glyphicon glyphicon-search"></i>
					</button>
					<?php if ($this->user->hasPermission('obra_view') && $this->user->hasPermission('obra_add')) : ?>
						<button class="btn btn-sm btn-info pop" data-toggle="modal" data-target="#modalCadastro">
							<i class="fa fa-fw fa-plus-circle"></i>
						</button>
					<?php endif; ?>
					<a href="<?php echo BASE_URL; ?>obras" type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></a>

				</div>
			</div>
		</div>

		<div class="box-body no-padding">
			<?php include_once("filtro.php"); ?>


			<?php foreach ($tableDados as $obr) : ?>
				<?php include("visualizar.php"); ?>
				<a data-toggle="modal" data-target="#modalVisualizar<?php echo $obr[0]; ?>" style="color: #000;    cursor: pointer; ">
					<div class="col-md-4" style="margin-top:20px;">
						<div class="box box-success" style="    border-left: 1px solid;border-right: 1px solid;border-bottom: 1px solid;">
							<div class="box box-widget widget-user">
								<div class="widget-user-header bg-default-active">
									<h3 class="widget-user-username">Obra: <?php echo $obr[0]; ?></h3>
									<h4 class="widget-user-desc"><?php echo $obr['obr_razao_social']; ?></h4>
								</div>

								<div class="box-footer">
									<div class="row">
										<div class="col-sm-4 border-right">
											<div class="description-block">
												<h5 class="description-header">Serviço</h5>
												<span class="description-text"><?php echo $obr['sev_nome']; ?></span>
											</div>
										</div>
										<div class="col-sm-5 border-right">
											<div class="description-block">
												<h5 class="description-header">Concessionaria</h5>
												<span class="description-text"><?php echo $obr['razao_social']; ?></span>
											</div>
										</div>
										<div class="col-sm-3">
											<div class="description-block">
												<h5 class="description-header">Etapas</h5>
												<span class="description-text"><?php echo $obr['id']; ?></span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</a>
			<?php endforeach; ?>

		</div>


		<div class="box-footer no-padding">
			<div class="mailbox-controls">
				<ul class="pagination pagination-sm pull-right">
					<?php for ($q = 1; $q <= $p_count; $q++) : ?>
						<li class="<?php echo ($q == $p) ? 'active' : '' ?> ">
							<a href="<?php echo BASE_URL; ?>obras?p=<?php $w = $_GET;
																	$w['p'] = $q;
																	echo http_build_query($w); ?>"><?php echo $q; ?></a>
						</li>
					<?php endfor; ?>
				</ul>
			</div>
		</div>
	</div>
</div>