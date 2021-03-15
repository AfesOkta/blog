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
                    <table class="table table-striped table-hover table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Tag</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tag as $result => $hasil)
                            <tr>
                                <td>{{ $result + $tag->firstitem() }}</td>
                                <td>{{ $hasil->name }}</td>
                                <td>
                                    <form action="{{ route('tag.destroy', $hasil->id )}}" method="POST">
                                        @csrf
                                        @method('delete')
                                    <a href="{{ route('tag.edit', $hasil->id ) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
	{{ $tag->links() }}

    @include('admin.components.modal')
@endsection

@section('plugin')
    <script src="{{asset('assets/modules/datatables/datatables.js')}}"></script>
    <script src="{{asset('assets/modules/jquery-toast/jquery.toast.min.js')}}"></script>
@endsection

@section('js')
    <script>

        $(document).off('focusin.modal');

        function open_container()
        {
            // var size='standard';
            var content =
                            '<div class="row">'+
                                '<div class="col-lg-12 col-sm-12">'+
                                    '<div class="form-group">'+
                                        // '<label for="nama_">Nama Kategori</label>'+
                                        '<input type="text" class="form-control nama_" id="nama_" placeholder="Nama Tag">'+
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

    </script>
@endsection
