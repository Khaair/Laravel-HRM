@extends('layout')

@section('content')
<div class="container">
    <h1>Inventory</h1>
    <a class="btn btn-success" href="javascript:void(0)" id="createNewInventory"> Create New Item</a>
    <br><br>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th width="150px">Action</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    <!-- Modal for inventory form -->
    <div class="modal fade" id="ajaxModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                </div>
                <div class="modal-body">
                    <form id="inventoryForm" name="inventoryForm" class="form-horizontal">
                        <input type="hidden" name="inventory_id" id="inventory_id">
                        <div class="form-group">
                            <label for="name" class="col-sm-12 control-label">Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Item Name" value="" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-sm-12 control-label">Description</label>
                            <div class="col-sm-12">
                                <textarea class="form-control" id="description" name="description" placeholder="Enter Item Description" required></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="price" class="col-sm-12 control-label">Price</label>
                            <div class="col-sm-12">
                                <input type="number" class="form-control" id="price" name="price" placeholder="Enter Item Price" value="" required>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script type="text/javascript">
$(function () {

    // Setup - AJAX DataTables
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('inventory.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'description', name: 'description'},
            {data: 'price', name: 'price'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    // Create new inventory item
    $('#createNewInventory').click(function () {
        $('#saveBtn').val("create-inventory");
        $('#inventory_id').val('');
        $('#inventoryForm').trigger("reset");
        $('#modelHeading').html("Create New Item");
        $('#ajaxModel').modal('show');
    });

    // Edit inventory item
    $('body').on('click', '.editInventory', function () {
        var inventory_id = $(this).data('id');
        $.get("{{ route('inventory.index') }}" +'/edit/' + inventory_id, function (data) {
            $('#modelHeading').html("Edit Item");
            $('#saveBtn').val("edit-inventory");
            $('#ajaxModel').modal('show');
            $('#inventory_id').val(data.id);
            $('#name').val(data.name);
            $('#description').val(data.description);
            $('#price').val(data.price);
        })
    });

    // Save inventory item
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Saving...');
        $.ajax({
            data: $('#inventoryForm').serialize(),
            url: "{{ route('inventory.store') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {
                $('#inventoryForm').trigger("reset");
                $('#ajaxModel').modal('hide');
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
                $('#saveBtn').html('Save changes');
            }
        });
    });

    // Delete inventory item
    $('body').on('click', '.deleteInventory', function () {
        var inventory_id = $(this).data("id");
        if(confirm("Are you sure want to delete?")) {
            $.ajax({
                type: "DELETE",
                url: "{{ route('inventory.destroy', '') }}/" + inventory_id,
                success: function (data) {
                    table.draw();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }
    });
});
</script>
@endsection
