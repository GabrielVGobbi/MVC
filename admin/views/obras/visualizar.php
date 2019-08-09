<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalVisualizar<?php echo $obr[0]; ?>">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" enctype="multipart/form-data" action="<?php echo BASE_URL ?>obras/add_action">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h2 class="modal-title fc-center" align="center" id="">Visualização de Obra</h2>
                        </div>

                        <div class="modal-body">
                            <div class="box box-default box-solid">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Dados</h3>
                                        </div>
                                        <div class="box-body" style="">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Nome da Obra</label>
                                                    <input type="text" class="form-control" name="obra_nome" id="obra_nome" value="<?php echo $obr['obr_razao_social']; ?>" autocomplete="off" required>
                                                </div>

                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Concessionaria</label>
                                                    <input type="text" class="form-control" name="concessionaria_nome" id="concessionaria_nome" value="<?php echo $obr['razao_social']; ?>" autocomplete="off" required>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Tipo de Obra/Serviço</label>
                                                    <input type="text" class="form-control" name="servico_nome" id="servico_nome" value="<?php echo $obr['sev_nome']; ?>" autocomplete="off" required>
                                                </div>
                                            </div>

                                            <div class="col-md-12" style="margin-bottom:6px;">
                                                <label>Cliente</label>
                                                <input type="text" class="form-control" name="cliente_nome" id="cliente_nome" value="<?php echo $obr['cliente_nome']; ?>" autocomplete="off" required>

                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-md-12">


                                        <div class="box-body">
                                            <div class="box box-primary">
                                                <div class="box-header ">
                                                    <i class="ion ion-clipboard"></i>

                                                    <h3 class="box-title">Etapas</h3>


                                                </div>
                                                <div class="box-body">
                                                    <ul class="todo-list ">
                                                        <?php $etapas = array();
                                                        $etapas = $this->servico->getEtapas($obr['id_concessionaria'], $obr['id_servico']); ?>
                                                        <?php foreach ($etapas as $etp) : ?>
                                                            <li>
                                                                <input type="checkbox" value="">
                                                                <span class="text"><?php echo $etp['etp_nome']; ?></span>
                                                                <small class="label label-danger"><i class="fa fa-clock-o"></i> 2 mins</small>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                </div>
                                                <div class="box-footer clearfix no-border">
                                                </div>
                                            </div>
                                        </div>

                                    </div>


                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
                                <i class="fa fa-download"></i> Generate PDF
                            </button> </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>