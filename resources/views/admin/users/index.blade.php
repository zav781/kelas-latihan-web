@extends('admin.template')
@section('title', 'Halaman Kelola User')
@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5>Halaman Kelola User</h5>
                <div class="d-flex g-2">
                    <button class="btn btn-primary" id="btnAdd">Tambah User</button>
                </div>

            </div>
            <div class="table-responsive">
                <table class="table table-bordered w-100" id="tb_user">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $('document').ready(function() {
            $('#tb_user').DataTable({
                ajax: {
                    url: '{{ route('list-users') }}',
                    dataSrc: "data",
                    method: "GET",
                    headers: {
                        'Authorization': 'Bearer' + API_TOKEN
                    }
                },
                columns: [{
                        data: null,
                        render: function(data, type, row, meta) {
                            return meta.row + 1;
                        },
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'phone'
                    },
                    {
                        data: 'address'
                    },
                    {
                        data: 'role'
                    },
                    {
                        data: null,
                        render: function(data, type, row, meta) {
                            return `
                                <button class="btn btn-warning btn-edit" data-id="${row.id}">Edit</button>
                                <button class="btn btn-danger btn-delete" data-id="${row.id}">Delete</button>
                            `
                        }
                    }

                ],
                initComplete:function(settings, json){
                    if (json.message){
                        
                    }
                }
            });
        })
    </script>
@endpush