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
			<div class="" style="margin-top:20px;">
				<?php foreach ($tableDados as $obr) : ?>

					<div class="col-md-12">
						<a type="button" style="cursor: pointer;" data-widget="collapse">
							<div class="box box-default collapsed-box">
								<div class="box-header with-border">
									<h3 class="box-title">Obra: <?php echo $obr['id'];?> - Cliente: <?php echo $obr['obr_razao_social'];?></h3>
									<div class="box-tools pull-right">
										<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
										</button>
									</div>
								</div>
						</a>
						<div class="box-body">
							The body of the box
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>

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