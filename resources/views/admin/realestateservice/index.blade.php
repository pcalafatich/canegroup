@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('lang_key','realestateservice')->first()->custom_text }}</title>
@endsection
@section('admin-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><a href="#" data-toggle="modal" data-target="#createFeature" class="btn btn-primary"><i class="fas fa-plus" aria-hidden="true"></i> {{ $websiteLang->where('lang_key','create')->first()->custom_text }} </a></h1>
    <!-- DataTables Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('lang_key','realestateservices_table')->first()->custom_text }}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">{{ $websiteLang->where('lang_key','serial')->first()->custom_text }}</th>
                            <th width="15%">{{ $websiteLang->where('lang_key','name')->first()->custom_text }}</th>
                            <th width="10%">{{ $websiteLang->where('lang_key','img')->first()->custom_text }}</th>
                            <th width="35%">{{ $websiteLang->where('lang_key','description')->first()->custom_text }}</th>
                             <th width="10%">{{ $websiteLang->where('lang_key','status')->first()->custom_text }}</th>
                            <th width="15%">{{ $websiteLang->where('lang_key','action')->first()->custom_text }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($realestateservice as $index => $item)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ $item->name }}</td>
                            <td><img width="120px" src="{{ url($item->image) }}" alt="blog image"></td>
                            <td>{{ $item->description }}</td>
                            <td>
                                @if ($item->status==1)
                                <a href="" onclick="realestateserviceStatus({{ $item->id }})"><input type="checkbox" checked data-toggle="toggle" data-on="{{ $websiteLang->where('lang_key','active')->first()->custom_text }}" data-off="{{ $websiteLang->where('lang_key','inactive')->first()->custom_text }}" data-onstyle="success" data-offstyle="danger"></a>
                                @else
                                    <a href="" onclick="realestateserviceStatus({{ $item->id }})"><input type="checkbox" data-toggle="toggle" data-on="{{ $websiteLang->where('lang_key','active')->first()->custom_text }}" data-off="{{ $websiteLang->where('lang_key','inactive')->first()->custom_text }}" data-onstyle="success" data-offstyle="danger"></a>

                                @endif
                            </td>
                            <td>
                                <a href="#" data-toggle="modal" data-target="#updateFeature-{{ $item->id }}" class="btn btn-primary btn-sm"><i class="fas fa-edit  "></i></a>
                                <a data-toggle="modal" data-target="#deleteModal" href="javascript:;" onclick="deleteData({{ $item->id }})" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- MODAL CREAR SERVICIO CONSULTING -->
    <div class="modal fade" id="createFeature" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                    <div class="modal-header">
                            <h5 class="modal-title">{{ $websiteLang->where('lang_key','realestateservice_form')->first()->custom_text }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                <div class="modal-body">
                    <div class="container-fluid">

                    <form action="{{ route('admin.realestateservice.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="image">{{ $websiteLang->where('lang_key','img')->first()->custom_text }}</label>
                            <input type="file" class="form-control-file" name="image" id="image">
                        </div>

                        <div class="form-group">
                            <label for="name">{{ $websiteLang->where('lang_key','name')->first()->custom_text }}</label>
                            <input type="text" class="form-control" name="name" id="name">
                        </div>

                        <div class="form-group">
                            <label for="description">{{ $websiteLang->where('lang_key','description')->first()->custom_text }}</label>
                            <input type="text" class="form-control" name="description" id="description">
                        </div>


                        <div class="form-group">
                            <label for="status">{{ $websiteLang->where('lang_key','status')->first()->custom_text }}</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1">{{ $websiteLang->where('lang_key','yes')->first()->custom_text }}</option>
                                <option value="0">{{ $websiteLang->where('lang_key','no')->first()->custom_text }}</option>
                            </select>
                        </div>

                        <button type="button" class="btn btn-danger" data-dismiss="modal">{{ $websiteLang->where('lang_key','close')->first()->custom_text }}</button>
                        <button type="submit" class="btn btn-success">{{ $websiteLang->where('lang_key','update')->first()->custom_text }}</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL EDITAR SERVICIO REALESTATE -->
    @foreach ($realestateservice as $item)
        <div class="modal fade" id="updateFeature-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                        <div class="modal-header">
                                <h5 class="modal-title">{{ $websiteLang->where('lang_key','realestateservice_form')->first()->custom_text }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                    <div class="modal-body">
                        <div class="container-fluid">

                            <form action="{{ route('admin.realestateservice.update',$item->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('patch')
                                <div class="form-group">
                                    <label for="image">{{ $websiteLang->where('lang_key','exist_img')->first()->custom_text }}</label>
                                    <div class="my-2">
                                        <img src="{{ url($item->image) }}" alt="realestate service image" width="100px">
                                    </div>
                                    <label for="image">{{ $websiteLang->where('lang_key','img')->first()->custom_text }}</label>
                                    <input type="file" class="form-control-file" name="image" id="image">
                                </div>

                                <div class="form-group">
                                    <label for="name">{{ $websiteLang->where('lang_key','name')->first()->custom_text }}</label>
                                    <input type="text" class="form-control" name="name" id="name" value="{{ $item->name }}">
                                </div>

                                <div class="form-group">
                                    <label for="description">{{ $websiteLang->where('lang_key','description')->first()->custom_text }}</label>
                                    <input type="text" class="form-control" name="description" id="description" value="{{ $item->description }}">
                                </div>


                                <div class="form-group">
                                    <label for="status">{{ $websiteLang->where('lang_key','status')->first()->custom_text }}</label>
                                    <select name="status" id="status" class="form-control">
                                        <option {{ $item->status==1 ? 'selected' : '' }} value="1">{{$websiteLang->where('lang_key','yes')->first()->custom_text }}</option>
                                        <option {{ $item->status==0 ? 'selected' : '' }} value="0">{{ $websiteLang->where('lang_key','no')->first()->custom_text }}</option>
                                    </select>
                                </div>

                                <button type="button" class="btn btn-danger" data-dismiss="modal">{{ $websiteLang->where('lang_key','close')->first()->custom_text }}</button>
                                <button type="submit" class="btn btn-success">{{ $websiteLang->where('lang_key','update')->first()->custom_text }}</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endforeach



    <script>
        function deleteData(id){
            $("#deleteForm").attr("action",'{{ url("admin/realestateservice/") }}'+"/"+id)
        }

        function realestateserviceStatus(id){
        // VERIFICAR MODO DEMO
         var isDemo="{{ env('PROJECT_MODE') }}"
         var demoNotify="{{ env('NOTIFY_TEXT') }}"
         if(isDemo==0){
             toastr.error(demoNotify);
             return;
         }
         // end

            $.ajax({
                type:"get",
                url:"{{url('/admin/realestateservice-status/')}}"+"/"+id,
                success:function(response){
                   toastr.success(response)
                },
                error:function(err){
                    console.log(err);

                }
            })
        }
    </script>
@endsection