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
                                        href="">{{ __('admin/subCategories/category.page_main') }} </a>
                                </li>
                                <li class="breadcrumb-item"><a
                                        href="{{route('admin.index.subCategories')}}"> {{ __('admin/subCategories/category.sub_categories') }} </a>
                                </li>
                                <li class="breadcrumb-item active">
                                    {{ __('admin/subCategories/category.add_sub_category') }}

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
                                        id="basic-layout-form"> {{ __('admin/subCategories/category.add_sub_category') }} </h4>
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
                                              action="{{route('admin.store.subCategories')}}"
                                              method="post"
                                              enctype="multipart/form-data">
                                            @csrf
                                            @method('POST')
                                            <div class="form-body">
                                                <h4 class="form-section"><i
                                                        class="ft-home"></i> {{ __('admin/subCategories/category.data_category') }}</h4>
                                                <div class="form-group">
                                                    <label for="projectinput1">
                                                        {{ __('admin/subCategories/category.image_category') }}
                                                    </label>
                                                    <input type="file"
                                                           class="form-control"
                                                           placeholder="  "
                                                           value=""
                                                           name="image">
                                                    @error("image")
                                                    <span class="text-danger"> {{$message}}</span>
                                                    @enderror
                                                </div>

                                                <div class="row">

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="projectinput1">
                                                                {{ __('admin/subCategories/category.name_category') }}
                                                            </label>
                                                            <input type="text"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   value="{{old('name')}}"                                                                   name="name">
                                                            @error("name")
                                                            <span class="text-danger"> {{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label
                                                                for="projectinput1"> {{ __('admin/subCategories/category.name_by_url') }}</label>
                                                            <input type="text" id="name"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   value="{{old('slug')}}"
                                                                   name="slug">
                                                            @error("slug")
                                                            <span class="text-danger"> {{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="projectinput2"> {{ __('admin/subCategories/category.select_category') }}</label>
                                                            <select name="parent_id" class="select2 form-control">
                                                                <optgroup label="{{ __('admin/subCategories/category.select_category') }} ">
                                                                    @if($mainCategory && $mainCategory -> count() > 0)
                                                                        @foreach($mainCategory as $category)
                                                                            <option
                                                                                value="{{$category -> id }}">{{$category -> name}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </optgroup>
                                                            </select>
                                                            @error('parent_id')
                                                            <span class="text-danger"> {{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group mt-1">
                                                            <label for="switcheryColor4" class="card-title ml-1">
                                                                {{ __('admin/subCategories/category.status') }}
                                                            </label>
                                                            <input type="checkbox" value="1"
                                                                   name="is_active"
                                                                   id="switcheryColor4"
                                                                   class="switchery" data-color="success"
                                                                   checked />

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
                                                    <i class="ft-x"></i> {{ __('admin/subCategories/category.back') }}
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> {{ __('admin/subCategories/category.save') }}
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
