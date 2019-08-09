<section class="content">
  <div class="row">
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3><?php echo $count_obras; ?></h3>

          <p> Obras</p>
        </div>
        <div class="icon">
          <i class="fa fa-building-o"></i>
        </div>
        <a href="<?php echo BASE_URL; ?>obras" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-green">
        <div class="inner">
          <h3><?php echo $count_cliente; ?></h3>
          <p>Clientes</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3><?php echo $count_concessionaria; ?></h3>

          <p>Concessionarias</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-red">
        <div class="inner">
          <h3><?php echo $count_servico; ?></h3>
          <p>Serviços</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-lg-9 col-xs-12">
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Etapas a seguir</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table class="table no-margin">
              <thead>
                <tr>
                  <th>Etapa ID</th>
                  <th>Item</th>
                  <th>Obra</th>
                  <th>Status</th>
                  <th>Check</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><a href="pages/examples/invoice.html">ET9842</a></td>
                  <td>Projeção 1</td>
                  <td>Casa Marcos</td>
                  <td><span class="label label-success">Concluido</span></td>
                  <td>
                  <input type="checkbox" class="flat-red" checked="" style="position: absolute; opacity: 0;">                  </td>
                </tr>
                <tr>
                  <td><a href="pages/examples/invoice.html">ET1848</a></td>
                  <td>Projeção 2</td>
                  <td>Casa Marcos</td>
                  <td><span class="label label-warning">Pendente</span></td>
                  <td>
                  <input type="checkbox" class="flat-red"  style="position: absolute; opacity: 0;">                  </td>
                </tr>
                <tr>
                  <td><a href="pages/examples/invoice.html">ET7429</a></td>
                  <td>Construção 3</td>
                  <td>Casa Nelly</td>
                  <td><span class="label label-danger">Atenção</span></td>
                  <td>
                  <input type="checkbox" class="flat-red"  style="position: absolute; opacity: 0;">
                  </td>
                </tr>
                <tr>
                  <td><a href="pages/examples/invoice.html">ET7429</a></td>
                  <td>Projeção 3</td>
                  <td>Casa Marcos</td>
                  <td><span class="label label-info">Processando</span></td>
                  <td>
                  <input type="checkbox" class="flat-red"  style="position: absolute; opacity: 0;">                  </td>
                </tr>
                <tr>
                  <td><a href="pages/examples/invoice.html">ET1848</a></td>
                  <td>Construção 6</td>
                  <td>Casa Nelly</td>
                  <td><span class="label label-warning">Pendente</span></td>
                  <td>
                  <input type="checkbox" class="flat-red"  style="position: absolute; opacity: 0;">                  </td>
                </tr>
                <tr>
                  <td><a href="pages/examples/invoice.html">ET7429</a></td>
                  <td>Pintura 4</td>
                  <td>Casa Gabriel</td>
                  <td><span class="label label-danger">Atenção</span></td>
                  <td>
                  <input type="checkbox" class="flat-red" style="position: absolute; opacity: 0;">                  </td>
                </tr>
                <tr>
                  <td><a href="pages/examples/invoice.html">ET9842</a></td>
                  <td>Pintura 6</td>
                  <td>Casa Gabriel</td>
                  <td><span class="label label-success">Concluido</span></td>
                  <td>
                  <input type="checkbox" class="flat-red" checked="" style="position: absolute; opacity: 0;">                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="box-footer clearfix">
          <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All</a>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Atalho</h3>
        </div>
        <div class="box-body">
          <a class="btn btn-app">
            <i class="fa fa-plus-circle"></i> Add Obra
          </a>
          <a class="btn btn-app">
            <i class="fa fa-bar-chart"></i> Relatorio
          </a>

        </div>
      </div>
    </div>
  </div>
  </div>