@extends('backend.layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-7 col-12 h-100">
        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <th>User id</th>
                        <th>Title</td>
                        <th>Thumbnail</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($services as $service)
                    <tr>
                        <td>{{ $service->user_id }}</td>
                        <td>{{ $service->title }}</td>
                        <td>
                            <img width="70px" src="{{ asset('uploads/service') }}/{{ $service->thumbnail }}" alt="">
                        </td>
                        <td>{{ $service->description }}</td>
                        <td class="d-flex align-items-center"><i class="fa fa-circle text-{{ $service->status != 2 ? 'success':'warning' }} mr-1"></i>{{ $service->status != 2 ? 'Active':'Deactive' }}</td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('service.edit', $service->id) }}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>

                                <form action="{{ route('service.destroy',$service->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger shadow btn-xs sharp btn sweet-success-cancel"><i class="fa fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-5 col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('service.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="my-3">
                        <select name="user_id" id="" class="form-control">
                            <option value="">-- User Id --</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="my-3">
                        <input type="text" class="form-control" name="title" placeholder="Title">
                    </div>
                    <div class="my-3">
                        <input type="file" class="form-control" name="thumbnail" placeholder="Thumbnail">
                    </div>
                    <div class="my-3">
                        <textarea name="description" class="form-control" id="" cols="30" rows="10" placeholder="Description"></textarea>
                    </div>

                    <button type="submit" class="btn btn-rounded btn-info"><span class="btn-icon-left text-info"><i class="fa fa-plus color-info"></i>
                    </span>Add</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
