@extends('admin.layouts.home')
@section('sub-judul','Post')
@section('content')

    @if(Session::has('success'))
  	<div class="alert alert-success" role="alert">
      {{ Session('success') }}
	</div>
	@endif

	<div class="card">
        <div class="card-header">
            <div class="col-12 col-sm-12">
                <b>Daftar Posts<b>
                <button class="btn btn-primary dropdown-toggle float-right" type="button"
                        data-toggle="dropdown"><i class="fas fa-plus-square"></i>
                    <span class="caret"></span></button>
                <div class="dropdown-menu dropdown-menu-puskesmas dropdown-menu-right" role="menu">
                    <a class="dropdown-item" role="presentation"
                        href="javascript:void(0)" onClick="open_container();" title="Tambah Posting">Add</a>
                    <a class="dropdown-item" href="javascript:void(0)" title="Daftar Post Non Active">List Non Active</a>
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
                                <th>Nama Post</th>
                                <th>Kategori</th>
                                <th>Daftar Tags</th>
                                <th>Creator</th>
                                <th>Thumbnail</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($post as $result => $hasil)
                            <tr>
                                <td>{{ $result + $post->firstitem() }}</td>
                                <td>{{ $hasil->judul }}</td>
                                <td>{{ $hasil->category->name }}</td>
                                <td>@foreach($hasil->tags as $tag)
                                    <ul>
                                        <h6><span class="badge badge-info">{{ $tag->name }}</span></h6>
                                    </ul>
                                    @endforeach
                                </td>
                                <td>{{$hasil->users->name }}</td>
                                <td><img src="{{ asset( $hasil->gambar ) }}" class="img-fluid" style="width:100px"></td>
                                <td>
                                    <form action="{{ route('post.destroy', $hasil->id )}}" method="POST">
                                        @csrf
                                        @method('delete')
                                    <a href="{{ route('post.edit', $hasil->id ) }}" class="btn btn-primary btn-sm">Edit</a>
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
	{{ $post->links() }}

@endsection
