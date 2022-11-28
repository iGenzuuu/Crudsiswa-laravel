<x-layout title="Data User">
    <div class="card-header bg-white d-flex justify-content-between align-items-center mb-3">
        <h1 class="fs-5 m-0">Data User</h1>
    </div>
    <div class="card-body">
        <div id="alert">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show mb-2">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
        <div class="table-responsive">
            <table class="table table-hover shadow-none" id="users-datatable">
                <thead>
                    <tr>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">Bergabung Pada</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function() {
                initiateDatatable();
            })

            function initiateDatatable() {
                var datatableOptions = $('#users-datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    autoWidth: false,
                    ordering: false,
                    ajax: '{{ route('getuser') }}',
                    columns: [{
                            data: 'name'
                        },
                        {
                            data: 'email',
                        },
                        {
                            data: 'created_at',
                        },
                    ],
                    language: {
                        search: "_INPUT_",
                        searchPlaceholder: "Cari Data",
                        lengthMenu: "Tampilkan _MENU_ baris",
                        zeroRecords: "Tidak ada data",
                        infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                        info: "Menampilkan _START_ ke _END_ dari _TOTAL_ data",
                        paginate: {
                            previous: '<i class="fa fa-angle-left"></i>',
                            next: "<i class='fa fa-angle-right'></i>",
                        }
                    },
                    dom: 'lfrtip',
                });
            }
        </script>
    @endpush
</x-layout>
