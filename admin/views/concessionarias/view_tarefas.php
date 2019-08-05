<div class="modal fade bd-example-modal-lg" id="view_tarefas<?php echo $scon['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="box box-primary">
                <div class="box-header">
                    <i class="ion ion-clipboard"></i>
                    <h3 class="box-title">Tarefas de "<?php echo $scon['sev_nome']; ?>"</h3>
                </div>
                <div class="box-body">
                    <ul class="todo-list ui-sortable">
                        <?php $etapas = array();
                        $etapas = $this->servico->getEtapas($tableInfo['id'], $scon['id']); ?>
                        <?php foreach ($etapas as $etp) : ?>

                            <li>
                                <span class="text"><?php echo $etp['etp_nome']; ?></span>
                                <small class="label label-danger"><i class="fa fa-clock-o"></i> 2 mins</small>
                                <div class="tools">
                                    <i class="fa fa-edit"></i>
                                    <i class="fa fa-trash-o"></i>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="box-footer clearfix no-border">
                    <button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add item</button>
                </div>
            </div>
        </div>
    </div>
</div>