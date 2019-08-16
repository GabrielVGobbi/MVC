<?php
//error_log(print_r($viewData, 1));
?>

<div class="col-md-12">
	<div class="nav-tabs-custom">
		<form method="POST" enctype="multipart/form-data">
			<div class="tab-content">
				<input type="hidden" class="form-control" name="id" id="id" autocomplete="off" value="<?php echo $tableInfo['id']; ?>">
				<div class="tab-pane active" id="dados">
					<div class="box box-default box-solid">
						<div class="row">
							<div class="col-md-12">
								<div class="box-header with-border">
									<h3 class="box-title">Dados</h3>
								</div>
								<div class="box-body" style="">
									<div class="col-md-6">
										<div class="form-group">
											<label>Razão Social</label>
											<input type="text" class="form-control" name="razao_social" id="razao_social" autocomplete="off" value="<?php echo $tableInfo['razao_social']; ?>">
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>

					<div class="box box-default box-solid">
						<div class="row">
							<div class="col-md-12">
								<div class="box-header with-border">
									<h3 class="box-title">Serviços</h3>
									<div class="box-tools pull-right">
										<button type="button" class="btn btn-box-tool new_service"><i class="fa fa-plus-circle"></i></button>
									</div>
								</div>
								<div class="box-body" style="">
									<div id="service_ok">
										<?php if (count($servicos_concessionaria) > 0) : ?>
											<?php foreach ($servicos_concessionaria as $scon) : ?>
												<div class="col-md-12">
													<div class="input-group" style="width: 50%;">
														<input type="text" class="form-control" name="servico_concessionaria" id="servico_concessionaria" autocomplete="off" value="<?php echo $scon['sev_nome']; ?>">
														<div class="input-group-btn">
															<div class="btn btn-info" title="" data-toggle="modal" data-target="#view_tarefas<?php echo $scon['id']; ?>" data-original-title="Ver Tarefas">
																<i class="ion ion-clipboard"></i>
															</div>
														</div>
													</div>
												</div>
												<?php require("view_tarefas.php"); ?>
											<?php endforeach; ?>
										<?php else : ?>
											Não foram encontrados resultados.
										<?php endif; ?>
									</div>

									<div class="col-md-10" style="display:none;" id="new_service">
										<div class="input-group">
											<label>Adicionar novo Sub-Serviço</label>
											<select class="form-control select2-add-service select2-hidden-accessible service_add" data-placeholder="Selecione o serviço" style="width: 100%;" name="servico[]" id="new_servico[]" aria-hidden="true" required>
												<option> selecione </option>
												<?php foreach ($tableInfo['servico_not_concessionaria'] as $sev) : ?>
													<option value="<?php echo $sev['id']; ?>"><?php echo $sev['sev_nome'] ?></option>
												<?php endforeach; ?>
											</select>
											<!--<span onclick="add_service()" style="cursor: pointer;border-color: #f00;border-left: 1%;" class="input-group-addon span-artist"><i class="fa fa-check has-error"></i></span>-->
										</div>
									</div>
									<div class="col-md-12" style="margin-top:10px;display:none;" id="etapas_col">
										<div class="box box-primary">
											<div class="box-header">
												<i class="ion ion-clipboard"></i>
												<h3 class="box-title title-etapas">Etapas</h3>
											</div>
											<div class="box-body">
												<div class="col-md-10"> 
													<div class="form-group">
														<label>Sub-Serviço</label>
														<input type="text" class="form-control" name="etapas[nome_etapa][]" id="etapas[]" autocomplete="off">

													</div>
												</div>


												<div class="col-md-2">
													<label>Prazo</label>
													<div class="input-group">
														<input type="text" class="form-control" name="etapas[prazo_etapa][]" id="etapas[]" autocomplete="off">
														<div class="input-group-btn">
															<div class="btn btn-default">
																<i></i> Dias
															</div>
														</div>
													</div>
												</div>
												<div class="etapa_add"> </div>
											</div>
											<div class="box-footer clearfix no-border">
												<button type="button" class="btn btn-default pull-right new_etapa"><i class="fa fa-plus"></i> Add Etapa</button>
											</div>
										</div>
									</div>


								</div>

							</div>
						</div>
					</div>


					<!--
					<div class="box box-default box-solid">
						<div class="row">
							<div class="col-md-12">
								<div class="box-header with-border">
									<h3 class="box-title">Documentos</h3>
									<div class="box-tools pull-right">
										<button type="button" class="btn btn-box-tool new_objeto"><i class="fa fa-plus-circle"></i></button>
									</div>
								</div>
								<div class="box-body" style="">
									<div class="col-md-6">
										<?php if (count($documentos_concessionaria) > 0) : ?>
																							<?php foreach ($documentos_concessionaria as $docs) : ?>
																																				<div class="input-group">
																																					<input type="text" class="form-control" name="documentos_concessionaria" id="documentos_concessionaria" autocomplete="off" value="<?php echo $docs['docs_nome']; ?>">
																																					<span class="input-group-btn">
																																						<a href="<?php echo BASE_URL ?>assets/documentos/<?php echo $docs['docs_nome']; ?>" target="_blank" class="btn btn-info btn-flat" data-toggle="tooltip" title="" data-original-title="Ver Documento">
																																							<i class="fa fa-info"></i></a>
																																					</span>
																																				</div>
																							<?php endforeach; ?>
										<?php else : ?>
																							Não foram encontrados resultados.
										<?php endif; ?>
										<div class="objeto"> </div>
									</div>
								</div>
							</div>
						</div>
					</div>
-->
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Salvar</button>
				<a href="<?php echo BASE_URL; ?>concessionarias" class="btn btn-danger">Voltar</a>
			</div>

	</div>
	</form>


</div>

</div>