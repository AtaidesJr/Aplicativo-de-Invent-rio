<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventário Tecnokor | Registros</title>
    <?php $this->insert('partials/sessoes') ?>

    <link rel="icon" type="image/x-icon" href="/assets/img/favicon.png" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/DataTables/datatables.min.css">
    <link rel="stylesheet" href="/assets/vendor/libs/datatable/datatables-combinado.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.1/css/buttons.dataTables.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/main.css">
    <!-- Sweet Alert -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .zoom_90 {
            zoom: 0.9;
        }
    </style>

</head>

<body id="retorno" style="background-color: #f2f2f2;">

    <?php $this->insert('partials/mensagens') ?>

    <div class="zoom_90">

        <div class="container-fluid p-3 position-absolute">
            <img src="/assets/img/tecnokor.png" class="rounded mx-auto d-block" style="width: 10%;">
            <div class="row">
                <div class="col">
                    <table id="lista_itens" class="display nowrap compact cell-border table table-sm table-light table-hover caption-top table-bordered" style="width:100%">
                        <hr>
                        <thead>
                            <tr>
                                <th>Usuário</th>
                                <th>Código do Item</th>
                                <th>Descrição do Item</th>
                                <th>Unidade</th>
                                <th>Quantidade</th>
                                <th>Depósito</th>
                                <th>N° do Formulário</th>
                                <th>Data da Leitura</th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                    <hr>
                </div>
            </div>
        </div>

    </div>

    <script src="/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="/assets/DataTables/datatables.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.2.3/js/dataTables.fixedHeader.min.js"></script>
    <script src="https://cdn.datatables.net/scroller/2.4.1/js/dataTables.scroller.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


    <script>
        $('#lista_itens').DataTable({
            responsive: true,
            "language": {
                "lengthMenu": "_MENU_",
                "infoEmpty": "Nenhum registro encontrado",
                "zeroRecords": "Nenhum registro encontrado",
                "info": "Exibindo a página _PAGE_ de _PAGES_ de _TOTAL_ linhas",
                "infoFiltered": "(Filtrado de _MAX_ registros)",
                "search": "Pesquisar : ",
                "paginate": {
                    "first": "Primeiro",
                    "last": "Ultimo",
                    "next": "Proximo",
                    "previous": "Anterior"
                }
            },
            "ajax": '/itens_leitura_datable',
            "processing": true,
            "fixedHeader": true,
            "buttons": [{
                    "extend": "copy",
                    "text": "Copiar"
                },
                {
                    "extend": "excel",
                    "text": "EXCEL",
                },
            ],
            "layout": {
                "topStart": 'buttons'
            },
            "lengthMenu": [
                [20],
                [20],
            ],
            "order": false,
            "scrollCollapse": true,
            "scrollY": '70vh',
            columnDefs: [{
                    "className": "table-light",
                    "targets": 0
                },
                {
                    "className": "table-light",
                    "targets": 1
                },
                {
                    "className": "table-light",
                    "targets": 2
                },
                {
                    "className": "table-light",
                    "targets": 3
                },
                {
                    "className": "text-start table-light",
                    "targets": 4
                },
                {
                    "className": "table-light",
                    "targets": 5
                },
                {
                    "className": "table-light",
                    "targets": 6
                },
                {
                    "className": "table-light",
                    "targets": 7
                },
                {
                    "className": "table-light btn-sm",
                    "targets": 8
                },
            ],
        });
    </script>

</body>

</html>