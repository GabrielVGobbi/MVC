<div class="modal fade bd-example-modal-lg" id="modalCadastro" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" enctype="multipart/form-data" action="<?php echo BASE_URL ?>concessionarias/add_action">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h2 class="modal-title fc-center" align="center" id="">Cadastro de Concessionaria</h2>
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
                                                    <label>Razão Social</label>
                                                    <input type="text" class="form-control" name="razao_social" id="razao_social" autocomplete="off">
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
                                            <h3 class="box-title">Serviço</h3>
                                            <div class="box-tools pull-right">
                                                <button type="button" class="btn btn-box-tool new_objeto"><i class="fa fa-plus-circle"></i></button>
                                            </div>
                                        </div>
                                        <div class="box-body" style="">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Nome</label>
                                                    <select class="form-control select2" style="width: 100%;" name="servico[]" id="servico[]" aria-hidden="true" required>
                                                        <?php foreach ($viewData['servico'] as $sev) : ?>
                                                            <option value="<?php echo $sev['id']; ?>"><?php echo $sev['sev_nome'] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
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
                                            <h3 class="box-title">Etapas</h3>
                                            <div class="box-tools pull-right">
                                                <button type="button" class="btn btn-box-tool new_etapa"><i class="fa fa-plus-circle"></i></button>
                                            </div>
                                        </div>
                                        <div class="box-body" style="">
                                            <div class="" style="">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Sub-Serviços</label>
                                                        <input type="text" class="form-control" name="etapas[]" id="etapas[]" autocomplete="off">
                                                        <div class="etapa_add"> </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </div>
                </div> 
            </form>
        </div>
    </div>

</div>