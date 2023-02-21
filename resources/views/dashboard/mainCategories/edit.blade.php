@extends('layouts.admin')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="">{{ __('admin/mainCategories/category.page_main') }} </a>
                                </li>
                                <li class="breadcrumb-item"><a
                                        href="{{route('admin.index.categories')}}"> {{ __('admin/mainCategories/category.main_categories') }} </a>
                                </li>
                                <li class="breadcrumb-item active"> {{ __('admin/mainCategories/category.edit') }}
                                    - {{$mainCategory -> name}}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title"
                                        id="basic-layout-form"> {{ __('admin/mainCategories/category.edit_main_category') }} </h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                @include('dashboard.includes.alerts.success')
                                @include('dashboard.includes.alerts.errors')
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form"
                                              action="{{route('admin.update.categories',$mainCategory -> id)}}"
                                              method="post"
                                              enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')

                                            <input name="id" value="{{$mainCategory -> id}}" type="hidden">
                                            <div class="form-group">
                                                <div class="text-center">
                                                    <img
                                                        src=""
                                                        class="rounded-circle height-150"
                                                        alt="{{__('admin/mainCategories/category.alt')}}">
                                                </div>
                                            </div>
                                            <div class="form-body">
                                                <h4 class="form-section"><i
                                                        class="ft-home"></i> {{ __('admin/mainCategories/category.data_category') }}
                                                </h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label
                                                                for="projectinput1"> {{ __('admin/mainCategories/category.name_category') }}</label>
                                                            <input type="text"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   value="{{$mainCategory -> name}}"
                                                                   name="name">
                                                            @error("name")
                                                            <span class="text-danger"> {{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label
                                                                for="projectinput1"> {{ __('admin/mainCategories/category.name_by_url') }}</label>
                                                            <input type="text" id="name"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   value="{{$mainCategory -> slug}}"
                                                                   name="slug">
                                                            @error("slug")
                                                            <span class="text-danger"> {{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group mt-1">
                                                            <label for="switcheryColor4" class="card-title ml-1">
                                                                {{ __('admin/mainCategories/category.status') }}
                                                            </label>
                                                            <input type="checkbox" value="1"
                                                                   name="is_active"
                                                                   id="switcheryColor4"
                                                                   class="switchery" data-color="success"
                                                                   @if($mainCategory -> is_active === true)checked @endif/>

                                                            @error("is_active")
                                                            <span class="text-danger">{{$message}} </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1"
                                                        onclick="history.back();">
                                                    <i class="ft-x"></i> {{ __('admin/mainCategories/category.back') }}
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> {{ __('admin/mainCategories/category.update') }}
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- // Basic form layout section end -->
                        </div>
                    </div>
@endsection
