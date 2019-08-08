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
				<div class="col-md-6" style="margin-top:20px;">
					<div class="box box-success">
						<div class="box-header with-border">
							<h3 class="box-title">Obra: <?php echo $obr[0]; ?> - <?php echo $obr['obr_razao_social']; ?></h3>
						</div>
						<div class="box-body">
							<dl class="">
								<dt>Description lists</dt>
								<dd>A description list is perfect for defining terms.</dd>
								<dt>Euismod</dt>
								<dd>Vestibulum id ligula porta felis euismod semper eget lacinia odio sem nec elit.</dd>
								<dd>Donec id elit non mi porta gravida at eget metus.</dd>
								<dt>Malesuada porta</dt>
								<dd>Etiam porta sem malesuada magna mollis euismod.</dd>
								<dt>Felis euismod semper eget lacinia</dt>
								<dd>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo
									sit amet risus.
								</dd>
							</dl>
						</div>
					</div>
				</div>
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