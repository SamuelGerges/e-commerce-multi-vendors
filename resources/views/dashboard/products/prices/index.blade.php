@extends('layouts.admin')
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"> {{ __('admin/products/product.products') }} </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{route('admin.home')}}">{{ __('admin/products/product.page_main') }}</a>
                                </li>
                                <li class="breadcrumb-item active"> {{ __('admin/products/product.products') }}
                                </li>
                            </ol>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{route('admin.general.create.products')}}">{{ __('admin/products/product.add_new_product') }}</a>
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
                                    <h4 class="card-title">{{ __('admin/products/product.all_products') }} </h4>
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
                                                <th>{{ __('admin/products/product.name_product')}}</th>
                                                <th>{{ __('admin/products/product.name_by_url')}}</th>
                                                <th>{{ __('admin/products/product.price')}}</th>
                                                <th>{{ __('admin/products/product.status') }}</th>
                                                <th>{{ __('admin/products/product.create_at')}}</th>
                                                <th>{{ __('admin/products/product.operations')}}</th>
                                            </tr>
                                            @isset($products)
                                                @foreach($products as $product)
                                                    <tr>
                                                        <td>{{$product->name}}</td>
                                                        <td>{{$product->slug}}</td>
                                                        <td>{{$product->price}}</td>
                                                        <td>{{$product->getActive()}}</td>
                                                        <td>{{$product->created_at}}</td>
                                                        <td>
                                                            <div class="btn-group" role="group"
                                                                 aria-label="Basic example">
                                                                <a href="{{route('admin.general.edit.products',$product->id)}}"
                                                                   class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">
                                                                    {{ __('admin/products/product.edit') }}
                                                                </a>
                                                                <a href="{{route('admin.general.delete.products',$product->id)}}"
                                                                   class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">
                                                                    {{ __('admin/products/product.delete') }}
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
{{--                                        {{$products->links()}}--}}

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
