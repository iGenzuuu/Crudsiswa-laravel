<x-layout title="Data Siswa">
    <div class="card-header bg-white d-flex justify-content-between align-items-center mb-3">
        <h1 class="fs-5 m-0">Data Siswa</h1>
        <a href="{{ route('students.create') }}" class="btn btn-primary">Tambah</a>
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
            <table class="table table-hover shadow-none" id="students-datatable">
                <thead>
                    <tr>
                        <th scope="col">Nama</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">Tanggal Lahir</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Action</th>
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
                var datatableOptions = $('#students-datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    autoWidth: false,
                    ordering: false,
                    ajax: '{{ route('getstudent') }}',
                    columns: [{
                            data: 'name'
                        },
                        {
                            data: 'gender',
                        },
                        {
                            data: 'date',
                        },
                        {
                            data: 'address',
                        },
                        {
                            data: 'action',
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

            function editStudentHandler(id) {
                var url = '{{route('students.edit', ':id')}}';
                url = url.replace(':id', id);
                window.location.href = url;
            }

            function deleteStudentHandler(id, name) {
                var text = 'Apakah kamu yakin ingin menghapus siswa ' + name + '?';
                if (confirm(text) == true) {
                    deleteStudent(id)
                }
            }

            function deleteStudent(id) {
                var url = '{{ route('students.destroy', ':id') }}';
                url = url.replace(':id', id);
                $.ajax({
                    type: 'delete',
                    url: url,
                    cache: false,
                    success: function(response) {
                        if (response.statusCode == 200) {
                            $('#alert').append(
                                '<div class="alert alert-success alert-dismissible fade show mb-2">' + response
                                .message +
                                '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
                                )
                            $('#students-datatable').DataTable().ajax.reload();
                        } else {
                            $('#alert').append('<div class="alert alert-danger alert-dismissible fade show mb-2">' +
                                response.message +
                                '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
                                )
                        }
                    },
                    error: function(error) {
                        console.log(error)
                    }
                })
            }
            // function searchStudent(request) {
            //     $('#spinner').hide()
            //     $('#icon-search').show()
            //     $.ajax({
            //         type: 'get',
            //         url: '{{ route('search') }}',
            //         data: {
            //             search: request
            //         },
            //         dataType: 'json',
            //         cache: false,
            //         success: function(response) {
            //             appendData(response)
            //         },
            //         error: function(error) {
            //             console.log(error)
            //         }
            //     })
            // }

            // function appendData(data) {
            //     var htmlView = '';
            //     if (data.length <= 0) {
            //         htmlView += `
    //             <tr>
    //                 <td colspan="999" class="text-center">Tidak Ada Data</td>
    //             </tr>`;
            //     }

            //     for (let i = 0; i < Math.min(10, data.length); i++) {
            //     //edit
            //     var edit= '{{ route('students.edit', ':id') }}';
            //     edit = edit.replace(':id', data[i].id);

            //     //delete
            //     var destroy= '{{ route('students.destroy', ':id') }}';
            //     destroy = destroy.replace(':id', data[i].id);
            //     htmlView += `
    //         <tr>
    //             <th scope="row">` + (i + 1) + `</th>
    //             <td>` + data[i].name + `</td>
    //             <td>` + data[i].gender + `</td>
    //             <td>` + data[i].date + `</td>
    //             <td>` + data[i].address + `</td>
    //             <td class="d-flex gap-2">
    //                 <a class="btn btn-warning" href="`+ edit +`">Edit</a>
    //                 <form action="`+ destroy +`" method="POST">
    //                     <input type="hidden" name="_token" id="csrf-token" value="{{ csrf_token() }}" />
    //                     <input type="hidden" name="_method" value="delete">
    //                     <button class="btn btn-danger"
    //                         onclick="return confirm('Apakah kamu yakin ingin menghapus siswa `+ data[i].name +`')">Delete</button>
    //                 </form>
    //             </td>
    //         </tr>`
            //     }

            //     $('tbody').html(htmlView);
            // }

            // function doneSearch() {
            //     $('#icon-search').hide()
            //     $('#spinner').show()
            // }
        </script>
    @endpush
</x-layout>
