$(function() {
    //Initialize Select2 Elements
    $('.select2').select2()

    $('.select2-add-service').select2()


    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
        //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
        //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
        //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
        //Date range as a button
    $('#daterange-btn').daterangepicker({
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            startDate: moment().subtract(29, 'days'),
            endDate: moment()
        },
        function(start, end) {
            $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
        }
    )

    //Date picker
    $('#datepicker').datepicker({
        autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        })
        //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass: 'iradio_minimal-red'
        })
        //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
        //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
        showInputs: false
    })
})
$(function() {



    $('input[type="checkbox"]').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass: 'iradio_flat-blue'
    });

    //marcar todos os CheckBox
    $('#marcarTodos').on('ifChecked', function(event) {
        $('.check').each(function() {
            $(this).iCheck('check');
        });
    });

    //Desmarcar todos os checkbox 
    $('#marcarTodos').on('ifUnchecked', function(event) {
        $('.check').each(function() {
            $(this).iCheck('uncheck');
        });
    });


    $('#mercado_live').on('ifChecked', function(event) {
        $('.dados-ml').show();
    });

    $('#mercado_live').on('ifUnchecked', function(event) {
        $('.dados-ml').hide();
    });

    $(".mailbox-star").click(function(e) {
        e.preventDefault();
        //detect type
        var $this = $(this).find("a > i");
        var glyph = $this.hasClass("glyphicon");
        var fa = $this.hasClass("fa");

        if (glyph) {
            $this.toggleClass("glyphicon-star");
            $this.toggleClass("glyphicon-star-empty");
        }

        if (fa) {
            $this.toggleClass("fa-star");
            $this.toggleClass("fa-star-o");
        }
    });
});

function openFiltro($name) {
    $('#filtro_' + $name).toggle();
}

$(function() {

    $('.new_servico').on('click', function(e) {

        e.preventDefault();

        html = '<label>Nome</label>        <input type="text" class="form-control" name="razao_social" id="razao_social" autocomplete="off" value="">';

        $('.servico').append(html);


    });

    $('.new_documento').on('click', function(e) {

        e.preventDefault();

        html = '<label>Nome</label>        <input type="text" class="form-control" name="nome_documento[]" id="nome_documento" autocomplete="off" value="">';

        $('.documento').append(html);


    });

    $('.new_etapa').on('click', function(e) {

        e.preventDefault();

        html = '<div class="col-md-10"><div class="form-group"><label>Sub-Serviço</label> <input type="text" class="form-control" name="etapas[nome_etapa][]" id="etapas[]" autocomplete="off"></div></div>';

        html += '<div class="col-md-2"> <label>Prazo</label><div class="input-group"><input type="text" class="form-control" name="etapas[prazo_etapa][]" id="etapas[]" autocomplete="off"><div class="input-group-btn"><div class="btn btn-default"><i></i> Dias </div> </div></div></div>';

        $('.etapa_add').append(html);


    });

    $('.new_service').on('click', function(e) {

        $('#new_service').toggle();
        $('#service_ok').toggle();

    });

    $('.new_obra').on('click', function(e) {

        $('#new_obra').toggle();
        $('#obra_ok').toggle();

        $('.file_doc').attr('name','documento_arquivo');

    });


    $('.service_add').on('change', function(e) {

        if ($(".service_add>option:selected").text() != 'selecione') {

            var servico = '"' + $(".service_add>option:selected").text() + '"';
            $(".title-etapas").html("Adicionar Etapas para o Serviço " + servico);
            $('#etapas_col').toggle();
        }

    });




});

function add_service(obj) {
    var name = $('.select2-search__field').val()
    console.log(name);

    if (name != '' && name != undefined) {

        swal({
                title: "Tem certeza",
                text: "Você esta adicionando um Serviço: " + name,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {

            });
    } else {
        swal({
                title: "Por favor",
                text: "O Campo de adição não pode ser vazio!!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {

            });
    }
}

function darAcessoCliente(id){

    $('#acessoUsuario'+id).modal('toggle');
}