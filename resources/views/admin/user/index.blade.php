@extends('admin.layouts.home')

@section('title', 'Data Users')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/select2/dist/css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/jquery-toast/jquery.toast.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custome.css') }}">
@endsection

@section('content')
{{-- <x-section-header heading="Users" breadcrumb="Users" /> --}}

<div class="card">
    <div class="card-header">
        <div class="col-12 col-sm-12">
            <b>Daftar Users<b>
            <button class="btn btn-primary dropdown-toggle float-right" type="button"
                    data-toggle="dropdown"><i class="fas fa-plus-square"></i>
                <span class="caret"></span></button>
            <div class="dropdown-menu dropdown-menu-puskesmas dropdown-menu-right" role="menu">
                <a class="dropdown-item" role="presentation"
                    href="javascript:void(0)" onClick="open_container();" title="Tambah User">Add</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="table-1" style="width:100%">
                    <thead>
                        <th class="text-center thColor">
                        #
                        </th>
                        {{-- <th class="tdLeft thColor">Posyandu</th> --}}
                        <th class="tdLeft thColor">Username</th>
                        <th class="tdLeft thColor">Email</th>
                        <th class="tdCenter thColor">Action</th>
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
    <script src="{{asset('assets/modules/datatables/datatables.js')}}"></script>
    <script src="{{asset('assets/modules/jquery-toast/jquery.toast.min.js')}}"></script>
@endsection

@section('js')
    <script>
        function open_container()
        {
            // var size='standard';
            var content =
                            '<div class="row">'+
                                '<div class="col-lg-12 col-sm-12">'+
                                    '<div class="form-group">'+
                                        // '<label for="nama_">Nama Kategori</label>'+
                                        '<input type="text" class="form-control nama_" id="nama_" placeholder="Nama User">'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                            '<div class="row">'+
                                '<div class="col-lg-12 col-sm-12">'+
                                    '<div class="form-group">'+
                                        '<input type="email" class="form-control email_" id="email_" placeholder="Email" required>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                            '<div class="row">'+
                                '<div class="col-lg-12 col-sm-12">'+
                                    '<div class="form-group">'+
                                        '<input type="password" class="form-control password_" id="password_" placeholder="Password" required autocomplete="new-password">'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                            '<div class="row">'+
                                '<div class="col-lg-12 col-sm-12">'+
                                    '<div class="form-group">'+
                                        '<input type="password" class="form-control confirm_password" id="confirm_password" placeholder="Confirmation Password" required autocomplete="new-password">'+
                                    '</div>'+
                                '</div>'+
                            '</div>';
            var title   = 'New User';
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
