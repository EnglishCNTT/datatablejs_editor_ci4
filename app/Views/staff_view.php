<!-- app/Views/staff_view.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>DataTable with Inline Editing</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/v/dt/jqc-1.12.4/dt-2.0.7/b-3.0.2/sl-2.0.2/datatables.min.css" />
    <link rel="stylesheet" href="Editor-PHP-2.3.2/css/editor.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.5.2/css/dataTables.dateTime.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> <!-- Thêm thư viện jQuery -->
    <script src="https://cdn.datatables.net/v/dt/jqc-1.12.4/dt-2.0.7/b-3.0.2/sl-2.0.2/datatables.min.js"></script>
    <script src="Editor-PHP-2.3.2/js/dataTables.editor.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.5.2/js/dataTables.dateTime.min.js"></script>



</head>

<body>
    <table id="example" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>First name</th>
                <th>Last name</th>
                <th>Position</th>
                <th>Email</th>
                <th>Office</th>
                <th>Extn</th>
                <th>Age</th>
                <th width="18%">Start date</th>
                <th>Salary</th>
            </tr>
        </thead>
    </table>
    <script>
        $(document).ready(function() {
            var editor = new $.fn.dataTable.Editor({
                ajax: {
                    create: {
                        type: 'POST',
                        url: '<?= base_url('staff/create') ?>'
                    },
                    edit: {
                        type: 'PUT',
                        url: '<?= base_url('staff/update') ?>' + '/_id_',

                    },
                    remove: {
                        type: 'DELETE',
                        url: '<?= base_url('staff/delete') ?>' + '/_id_',
                    }
                },
                table: "#example",
                idSrc: "id",
                fields: [{
                        label: "Id:",
                        name: "id"
                    },
                    {
                        label: "First name:",
                        name: "first_name"
                    },
                    {
                        label: "Last name:",
                        name: "last_name"
                    },
                    {
                        label: "Position:",
                        name: "position"
                    },
                    {
                        label: "Email:",
                        name: "email"
                    },
                    {
                        label: "Office:",
                        name: "office"
                    },
                    {
                        label: "Extn:",
                        name: "extn"
                    },
                    {
                        label: "Age:",
                        name: "age"
                    },
                    {
                        label: "Start date:",
                        name: "start_date",
                        type: "datetime"
                    },
                    {
                        label: "Salary:",
                        name: "salary"
                    }
                ]
            });




            $('#example').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    url: "<?= base_url('staff') ?>",
                    type: "GET"
                },
                "columns": [{
                        "data": "id"
                    }, {
                        "data": "first_name"
                    },
                    {
                        "data": "last_name"
                    },
                    {
                        "data": "position"
                    },
                    {
                        "data": "email"
                    },
                    {
                        "data": "office"
                    },
                    {
                        "data": "extn"
                    },
                    {
                        "data": "age"
                    },
                    {
                        "data": "start_date"
                    },
                    {
                        "data": "salary"
                    }
                ],
                "layout": {
                    topStart: {
                        buttons: [{
                                extend: 'create',
                                editor: editor
                            },
                            {
                                extend: 'edit',
                                editor: editor
                            },
                            {
                                extend: 'remove',
                                editor: editor
                            }
                        ]
                    }
                },
                "select": true
            });
            $('#example').on('click', 'tbody td:not(:first-child, :last-child)', function(e) {
                editor.inline(this);
            });




        });
    </script>
</body>

</html>