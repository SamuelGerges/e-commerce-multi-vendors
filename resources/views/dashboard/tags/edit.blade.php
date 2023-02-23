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
                                        href="">{{ __('admin/tags/tag.page_main') }} </a>
                                </li>
                                <li class="breadcrumb-item"><a
                                        href="{{route('admin.index.tags')}}"> {{ __('admin/tags/tag.tags') }} </a>
                                </li>
                                <li class="breadcrumb-item active"> {{ __('admin/tags/tag.edit') }}
                                    - {{$tag -> name}}
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
                                        id="basic-layout-form"> {{ __('admin/tags/tag.edit_tag') }} </h4>
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
                                              action="{{route('admin.update.tags',$tag -> id)}}"
                                              method="post"
                                              enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')

                                            <input name="id" value="{{$tag -> id}}" type="hidden">
                                            <h4 class="form-section"><i
                                                    class="ft-home"></i> {{ __('admin/tags/tag.data_tag') }}
                                            </h4>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">
                                                            {{ __('admin/tags/tag.name_tag') }}
                                                        </label>
                                                        <input type="text"
                                                               class="form-control"
                                                               placeholder="  "
                                                               value="{{ $tag->name }}"
                                                               name="name">
                                                        @error("name")
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">
                                                            {{ __('admin/tags/tag.slug') }}
                                                        </label>
                                                        <input type="text"
                                                               class="form-control"
                                                               placeholder="  "
                                                               value="{{ $tag->slug }}"
                                                               name="slug">
                                                        @error("slug")
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1"
                                                        onclick="history.back();">
                                                    <i class="ft-x"></i> {{ __('admin/tags/tag.back') }}
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> {{ __('admin/tags/tag.update') }}
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
