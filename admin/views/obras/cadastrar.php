<div class="modal fade bd-example-modal-lg" id="modalCadastro" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" enctype="multipart/form-data" action="<?php echo BASE_URL ?>servicos/add_action">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h2 class="modal-title fc-center" align="center" id="">Cadastro de Obra</h2>
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
                                                    <input type="text" class="form-control" name="sev_nome" id="sev_nome" autocomplete="off">
                                                </div>

                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Concessionaria</label>
                                                    <select class="form-control select2 concessionaria_select" style="width: 100%;" name="servico[]" id="id_concessionaria" aria-hidden="true" required>
                                                        <option value="">selecione</option>
                                                        <?php foreach ($viewData['concessionaria'] as $com) : ?>
                                                            <option value="<?php echo $com['id']; ?>"><?php echo $com['razao_social'] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Tipo de Obra/Serviço</label>
                                                    <select class="form-control select2 servico_select" style="width: 100%;" name="servico[]" id="id_servico" aria-hidden="true" required>
                                                        <option value="">selecione</option>
                                                        <?php foreach ($viewData['servico'] as $sev) : ?>
                                                            <option value="<?php echo $sev['id']; ?>"><?php echo $sev['sev_nome'] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Cliente</label>
                                                    <select class="form-control select2" style="width: 100%;" name="servico[]" id="servico[]" aria-hidden="true" required>
                                                        <option value="">selecione</option>
                                                        <?php foreach ($viewData['clientes'] as $cli) : ?>
                                                            <option value="<?php echo $cli['id']; ?>"><?php echo $cli['cliente_nome'] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="box box-primary span_etapa" style="display:none;">
                                                    <div class="box-header">
                                                        <i class="ion ion-clipboard"></i>
                                                        <h3 class="box-title">Tarefas de ""</h3>
                                                    </div>
                                                    <div class="box-body">
                                                        <ul class="todo-list">
                                                            <div class="" id="id_sub_etapas"> </div>
                                                        </ul>
                                                    </div>
                                                    <div class="box-footer clearfix no-border">
                                                        <button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add item</button>
                                                    </div>
                                                </div>

                                                <div class="box box-primary result_null" style="display:none;">
                                                    <div class="box-header">

                                                    </div>
                                                    <div class="box-body">
                                                        <div style="text-align: center;">
                                                            <span class="" id="result_null">  </span>
                                                        </div>
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


<script type="text/javascript">
    $(function() {
        $('#id_servico').change(function() {

            var select = $('.concessionaria_select').select2('data');
            if (select) {
                console.log(select[0].id);
            }


            if ($(this).val()) {
                $.getJSON('ajax/search_categoria?search=', {
                    id_servico: $(this).val(),
                    id_concessionaria: select[0].id,
                    ajax: 'true'
                }, function(j) {
                    var options = '';

                    console.log(j);

                    if (j.length != 0) {
                        for (var i = 0; i < j.length; i++) {
                            options += '<input type="text" disabled class="form-control" value="' + j[i].nome_sub_categoria + '"></input>';
                        }
                        $('#id_sub_etapas').html(options).show();
                        $('.span_etapa').show();
                        $('.result_null').hide();

                    } else {
                        options = 'Não existem Etapas desse serviço com essa concessionaria. Por favor, refaça a busca'
                        $('.span_etapa').hide();

                        $('#result_null').html(options).show();
                        $('.result_null').show();
                    }


                });
            } else {
                $('#id_sub_etapas').html('selecione o Serviço');
            }
        });
    });
</script>