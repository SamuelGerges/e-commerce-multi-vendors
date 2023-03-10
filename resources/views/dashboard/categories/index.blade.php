@extends('layouts.admin')
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"> {{ __('admin/categories/category.categories') }} </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{route('admin.home')}}">{{ __('admin/categories/category.page_main') }}</a>
                                </li>
                                <li class="breadcrumb-item active"> {{ __('admin/categories/category.categories') }}
                                </li>
                            </ol>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{route('admin.create.categories')}}">{{ __('admin/categories/category.add_new_category') }}</a>
                                </li>

                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- DOM - jQuery events table -->
                <section id="dom">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">{{ __('admin/categories/category.all_categories') }} </h4>
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
                                    <div class="card-body card-dashboard">
                                        <table
                                            class="table display nowrap table-striped table-bordered scroll-horizontal">
                                            <thead class="">
                                                <tr>
                                                    <th>{{ __('admin/categories/category.name_category')}}</th>
                                                    <th>{{ __('admin/categories/category.main_category')}}</th>
                                                    <th>{{ __('admin/categories/category.name_by_url')}}</th>
                                                    <th>{{ __('admin/categories/category.status') }}</th>
                                                    <th>{{ __('admin/categories/category.image_category')}}</th>
                                                    <th>{{ __('admin/categories/category.operations')}}</th>
                                                </tr>
                                                @isset($categories)
                                                    @foreach($categories as $category)
                                                        <tr>
                                                        <td>{{$category->name}}</td>
                                                        <td>{{$category->_parent->name ?? __('admin/categories/category.main') }}</td>
                                                        <td>{{$category->slug}}</td>
                                                        <td>{{$category->getActive()}}</td>
                                                        <td>
                                                            <img style="width: 150px; height: 100px;" src=""
                                                                 alt="{{__('admin/categories/category.alt')}}">
                                                        </td>
                                                        <td>
                                                            <div class="btn-group" role="group"
                                                                 aria-label="Basic example">
                                                                <a href="{{route('admin.edit.categories',$category->id)}}"
                                                                   class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">
                                                                    {{ __('admin/categories/category.edit') }}
                                                                </a>
                                                                <a href="{{route('admin.delete.categories',$category->id)}}"
                                                                   class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">
                                                                    {{ __('admin/categories/category.delete') }}
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                @endisset
                                            </thead>
                                        </table>
                                        <div class="justify-content-center d-flex">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{$categories->links()}}
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
