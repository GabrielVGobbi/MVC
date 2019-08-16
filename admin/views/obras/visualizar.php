<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalVisualizar<?php echo $obr[0]; ?>">
<?php $documento_obra = $this->documento->getDocumentoObra($obr[0]); ?>

    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" enctype="multipart/form-data" action="<?php echo BASE_URL ?>obras/edit/<?php echo $obr[0]; ?>">
                <input type="hidden" value="<?php echo $obr[0]; ?>" name="id_obra">
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
                                                    <input type="text" class="form-control" name="obra_nome" id="obra_nome" value="<?php echo $obr['obr_razao_social']; ?>" autocomplete="off">
                                                </div>

                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Concessionaria</label>
                                                    <input type="text" class="form-control" disabled name="concessionaria_nome" id="concessionaria_nome" value="<?php echo $obr['razao_social']; ?>" autocomplete="off">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Tipo de Obra/Serviço</label>
                                                    <input type="text" class="form-control" disabled name="servico_nome" id="servico_nome" value="<?php echo $obr['sev_nome']; ?>" autocomplete="off">
                                                </div>
                                            </div>

                                            <div class="col-md-10" style="margin-bottom:6px;">
                                                <label>Cliente</label>
                                                <input type="text" class="form-control" disabled name="cliente_nome" id="cliente_nome" value="<?php echo $obr['cliente_nome']; ?>" autocomplete="off">
                                            </div>

                                            <div class="col-md-2" style="margin-bottom:6px;">
                                                <label>Data de Criação</label>
                                                <input type="text" class="form-control" disabled name="data_obra" id="data_obra" value="<?php echo $obr['data_obra']; ?>" autocomplete="off" required>
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
                                                        $etapas = $this->obra->getEtapas($obr[0]); ?>
                                                        <?php foreach ($etapas as $etp) : ?>
                                                        <?php
                                                            $prazo_etapa =  $etp['prazo_etapa'];
                                                            $prazo_restante =  date('d/m/y', strtotime('+' . $etp['prazo_etapa'] . 'days', strtotime($obr['data_obra'])));

                                                            $data_hoje = date('d-m-Y');




                                                            $data_inicial = $obr['data_obra'];
                                                            $nova_data = controller::SomarData($data_inicial, $etp['prazo_etapa']);


                                                            $data1 = new DateTime($data_hoje);
                                                            $data2 = new DateTime($nova_data);

                                                            $intervalo = $data1->diff($data2);


                                                            $mes = ($intervalo->m != '0' ? $intervalo->m . ' meses e ' : "");
                                                            $msg = 'Restam: ' . $mes . '' . $intervalo->d . ' Dia(s)';


                                                            if (strtotime(date('d-m-Y')) > strtotime($nova_data)) {
                                                                $check = 'danger';
                                                                $atraso = 'danger';
                                                                $msg = 'Atrasado em ' . $intervalo->d . ' Dia(s)';
                                                            } elseif (strtotime(date('d-m-Y')) == strtotime($nova_data)) {
                                                                $check = 'warning';
                                                                $msg = 'Entrega Hoje';
                                                            } elseif (strtotime(date('d-m-Y')) < strtotime($nova_data)) {
                                                                $check = 'success';
                                                                $msg = $mes . $intervalo->d . ' Dia(s) Restante(s)';
                                                            }
                                                            if ($etp['check'] == '1') {
                                                                $msg = 'Concluido';
                                                                $check = 'success';
                                                                $atraso = 'success';
                                                            }

                                                            ?>
                                                        <li>
                                                            <input class="checkEtapa<?php echo $obr[0];?>" name="check[]" <?php echo ($etp['check'] == '0' ? '' : 'checked'); ?> type="checkbox" value="<?php echo $etp['id']; ?>">
                                                            <span class="text"><?php echo $etp['etp_nome']; ?></span>
                                                            <small style="    font-size: 12px;" class="label label-<?php echo $check; ?>"><i class="fa fa-clock-o"></i> <?php echo $msg; ?></small>
                                                            
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

                            <div class="box box-default box-solid">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Documentos</h3>
                                            <div class="box-tools pull-right">
                                                <button type="button" class="btn btn-box-tool new_obra"><i class="fa fa-plus-circle"></i></button>
                                            </div>
                                        </div>
                                        <div class="box-body" style="">
                                            <div id="obra_ok">
                                                <?php if (count($documento_obra) > 0) : ?>
                                                <?php foreach ($documento_obra as $doc) : ?>
                                                <div class="col-md-12">
                                                    <div class="input-group" style="width: 50%;">
                                                        <input type="text" class="form-control" autocomplete="off" value="<?php echo $doc['docs_nome']; ?>">
                                                        <div class="input-group-btn">
                                                            <a href="<?php echo BASE_URL ?>assets/documentos/<?php echo $doc['docs_nome']; ?>" target="_blank" class="btn btn-info btn-flat" data-toggle="tooltip" title="" data-original-title="Ver Documento">
                                                                <i class="fa fa-info"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php endforeach; ?>
                                                <?php else : ?>
                                                Não foram encontrados resultados.
                                                <?php endif; ?>
                                            </div>

                                            <div class="col-md-10" style="display:none;" id="new_obra">
                                                <label>Adicionar novo Documento</label>
                                                <div class="input-group">
                                                    <input class="form-control" name="" placeholder="Nome do Documento">
                                                    <div class="input-group-btn">
                                                        <div class="btn btn-default btn-file">
                                                            <i class="fa fa-paperclip"></i> PDF
                                                            <input type="file" class="btn btn-success file_doc">
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
                            <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
                                <i class="fa fa-download"></i> Generate PDF
                            </button>
                            <button type="submit" class="btn btn-primary pull-right" style="margin-right: 5px;">
                                <i class="fa fa-download"></i> Salvar
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(function() {
        $('.checkEtapa'+<?php echo $obr[0];?>).on('ifChecked', function(event) {
            var q = $(this).val();
            checked = '1';
            idobra = <?php echo $obr[0]; ?>;
            console.log(q);

            $.ajax({

                url: BASE_URL + 'ajax/updateEtapa',
                type: 'POST',
                data: {
                    id_etapa: q,
                    checked: checked,
                    id_obra: idobra
                },
                dataType: 'json',
                success: function(json) {


                },
            });
        });


        $('.checkEtapa'+<?php echo $obr[0];?>).on('ifUnchecked', function(event) {
            var q = $(this).val();
            checked = '0';
            idobra = <?php echo $obr[0]; ?>;
            console.log(q);

            $.ajax({

                url: BASE_URL + 'ajax/updateEtapa',
                type: 'POST',
                data: {
                    id_etapa: q,
                    checked: checked,
                    id_obra: idobra
                },
                dataType: 'json',
                success: function(json) {


                },
            });
        });


    });
</script>