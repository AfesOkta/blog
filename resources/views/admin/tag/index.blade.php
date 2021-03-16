@extends('admin.layouts.home')
@section('sub-judul','Tag')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/modules/datatables/datatables.css') }}">
<link rel="stylesheet" href="{{ asset('assets/modules/select2/dist/css/select2.css') }}">
<link rel="stylesheet" href="{{ asset('assets/modules/jquery-toast/jquery.toast.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/custome.css') }}">
    {{-- <style>
        .modal-backdrop {
            z-index: -1;
        }
    </style> --}}
@endsection

@section('content')

    @if(Session::has('success'))
  	<div class="alert alert-success" role="alert">
      {{ Session('success') }}
	</div>
	@endif

	<div class="card">
        <div class="card-header">
            <div class="col-12 col-sm-12">
                <b>Daftar Tag<b>
                <button class="btn btn-primary dropdown-toggle float-right" type="button"
                        data-toggle="dropdown"><i class="fas fa-plus-square"></i>
                    <span class="caret"></span></button>
                <div class="dropdown-menu dropdown-menu-puskesmas dropdown-menu-right" role="menu">
                    <a class="dropdown-item" role="presentation"
                        href="javascript:void(0)" onClick="open_container();" title="Tambah Tag">Add</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-sm table-bordered" id="table-1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Tag</th>
                                <th>Slug</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('admin.components.modal')
@endsection

@section('plugin')

@endsection

@section('js')
    <script src="{{asset('assets/modules/datatables/datatables.js')}}"></script>
    <script src="{{asset('assets/modules/jquery-toast/jquery.toast.min.js')}}"></script>
    <script>

        $(function () {
            var table = $('#table-1').DataTable({
                //dom: '<"col-md-6"l><"col-md-6"f>rt<"col-md-6"i><"col-md-6"p>',
                processing: true,
                serverSide: true,
                method: 'get',
                ajax: '{{route('tag.json')}}',
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: true, orderable: true},
                    // {data: 'user_posyandu.posyandu_kode', name: 'user_posyandu.posyandu_kode', searchable: true, orderable: true},
                    {data: 'name', name: 'name', searchable: true, orderable: true},
                    {data: 'slug', name: 'slug', searchable: true, orderable: true},
                    {data: 'action', className: 'tdCenter', searchable: false, orderable: false}
                ],
            });

            $('body #composemodal').on('click','.save',function(e){
                e.preventDefault();
                let name = $('.name_').val();
                let tag_id = $('.tag_id').val();
                $('.save').attr("disabled","disabled");
                if (name == '' || name == null || name == undefined) {
                    $.toast({
                        heading: 'Warning',
                        text: 'Tag harus diisi !!!',
                        showHideTransition: 'plain',
                        icon: 'warning'
                    });
                    $('.save').removeAttr("disabled");
                }else{
                    if (tag_id == null || tag_id == "" || tag_id == undefined) {
                        url = "{{route('tag.store')}}";
                    }else{
                        url = "{{route('tag.update')}}";
                    }
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        data: {
                            _token: '{{ csrf_token() }}',
                            name: name,
                            tag_id: tag_id,
                        },
                        url: url,
                        success: function (data) {
                            if (data.status) {
                                $.toast({
                                    heading: 'Success',
                                    text: data.message,
                                    showHideTransition: 'slide',
                                    icon: 'success'
                                }),
                                location.reload();
                            } else {
                                $.toast({
                                    heading: 'Error',
                                    text: data.message,
                                    showHideTransition: 'plain',
                                    icon: 'error'
                                });
                                $('.save').removeAttr("disabled");
                            }
                        },
                        error: function (data) {
                            $.toast({
                                heading: 'Error',
                                text: data.message,
                                showHideTransition: 'plain',
                                icon: 'error'
                            });
                            $('.save').removeAttr("disabled");
                        }
                    });
                }
            });
        });

        function open_container()
        {
            // var size='standard';
            var content =
                            '<div class="row">'+
                                '<div class="col-lg-12 col-sm-12">'+
                                    '<div class="form-group">'+
                                        // '<label for="nama_">Nama Kategori</label>'+
                                        '<input type="text" class="form-control name_" id="name_" placeholder="Nama Tag">'+
                                    '</div>'+
                                '</div>'+
                            '</div>';
            var title   = 'New Tag';
            // var footer  = '<button type="button" class="btn btn-primary">Save changes</button>';
            setModalBox(content, title);
            $('#composemodal').modal('show');
        }

        function setModalBox(content, title)
        {
            document.getElementById('modal-body').innerHTML=content;
            document.getElementById('composemodalTitle').innerHTML=title;
            $('#composemodal').attr('class', 'modal fade')
                .attr('aria-labelledby','myModalLabel');
            $('.modal-dialog').attr('class','modal-dialog');
        }

        var edit = function(id) {
            $.ajax({
                type: "get",
                url: "{{ url('tag/get') }}/"+id,
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    var content =
                                    '<div class="row">'+
                                        '<div class="col-lg-12 col-sm-12">'+
                                            '<div class="form-group">'+
                                                '<input type="text" class="form-control name_" id="name_" value="'+data.name+'" placeholder="Nama Tag">'+
                                                '<input type="text" class="form-control tag_id" maxlength="5" id="tag_id" placeholder="Id kader" value="'+data.id+'" style="display:none">'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>';
                    var title   = 'Edit Tag';
                    // var footer  = '<button type="button" class="btn btn-primary">Save changes</button>';
                    setModalBox(content, title);
                    $('#composemodal').modal('show');
                },
                error: function() {
                    $.toast({
                        heading: 'Error',
                        text: "Kategori tidak ditemukan",
                        showHideTransition: 'plain',
                        icon: 'error'
                    })
                }
            })
        }

        var hapus = function(id){
            swal({
                title: "Yakin?",
                text: "Data Tag mau dihapus?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Ya, hapus saja!",
                closeOnConfirm: false
            }).then(function () {
                $.ajax({
                    type: "POST",
                    dataType: 'json',
                    data: {_token: '{{ csrf_token() }}', id: id},
                    url: "{{ route('tag.delete') }}",
                    success: function (data) {
                        if (data.status) {
                            $.toast({
                                    heading: 'Success',
                                    text: data.message,
                                    showHideTransition: 'slide',
                                    icon: 'success'
                                }),
                            location.reload();
                        } else {
                            $.toast({
                                heading: 'Error',
                                text: "Data kader tidak dapat dihapus",
                                showHideTransition: 'plain',
                                icon: 'error'
                            })
                        }
                    },
                    error: function (data) {
                        $.toast({
                            heading: 'Error',
                            text: "Data kader tidak ditemukan",
                            showHideTransition: 'plain',
                            icon: 'error'
                        })
                    }
                });
            });
        }
    </script>
@endsection
