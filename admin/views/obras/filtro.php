<div class="box box-default box-solid collapsed" id="filtro_<?php echo $viewData['pageController']; ?>" style="display:none;">
    <div class="box-body" style="">
        <form method="GET">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="fl_art_nome">Numero Obra</label>
                            <input class="form-control" id="filtro_id_inventario" name="filtros[id]" placeholder="" autocomplete="off">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="fl_art_nome">Nome da Obra</label>
                            <input class="form-control" id="filtro_descricao" name="filtros[nome_obra]" placeholder="" autocomplete="off">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="fl_art_nome">Cliente</label>
                            <input class="form-control" id="filtro_descricao" name="filtros[cliente_nome]" placeholder="" autocomplete="off">
                        </div>
                    </div>
            
                </div>

                <div class="pull-right">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </div>
            </div>
        </form>
    </div>
</div>