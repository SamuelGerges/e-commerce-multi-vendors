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
                                        href="">{{ __('admin/products/product.page_main') }} </a>
                                </li>
                                <li class="breadcrumb-item"><a
                                        href="{{route('admin.index.products')}}"> {{ __('admin/products/product.products') }} </a>
                                </li>
                                <li class="breadcrumb-item active"> {{ __('admin/products/product.edit') }}
                                    - {{$product -> name}}
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
                                        id="basic-layout-form"> {{ __('admin/products/product.edit_product') }} </h4>
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
                                              action="{{route('admin.general.update.products',$product -> id)}}"
                                              method="post"
                                              enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')

                                            <input name="id" value="{{$product -> id}}" type="hidden">
                                            <div class="form-body">
                                                <h4 class="form-section"><i
                                                        class="ft-home"></i> {{ __('admin/products/product.data_product') }}
                                                </h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label
                                                                for="projectinput1"> {{ __('admin/products/product.name_product') }}</label>
                                                            <input type="text"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   value="{{$product -> name}}"
                                                                   name="name">
                                                            @error("name")
                                                            <span class="text-danger"> {{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label
                                                                for="projectinput1"> {{ __('admin/products/product.name_by_url') }}</label>
                                                            <input type="text" id="name"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   value="{{$product -> slug}}"
                                                                   name="slug">
                                                            @error("slug")
                                                            <span class="text-danger"> {{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">
                                                                {{ __('admin/products/product.description') }}
                                                            </label>
                                                            <textarea type="text"
                                                                      class="form-control"
                                                                      placeholder=""
                                                                      value=""
                                                                      name="description"
                                                                      id="description">{{ $product->description }}
                                                            </textarea>
                                                            @error("description")
                                                            <span class="text-danger"> {{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label
                                                                for="projectinput1"> {{ __('admin/products/product.short_description') }}</label>
                                                            <textarea type="text" id="name"
                                                                      class="form-control"
                                                                      placeholder="  "
                                                                      value=""
                                                                      name="short_description">{{ $product->short_description }}
                                                                </textarea>
                                                            @error("short_description")
                                                            <span class="text-danger"> {{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="prjectinput1">
                                                                {{ __('admin/products/product.select_category') }}
                                                            </label>
                                                            <select name="categories[]" class="select2 form-control"
                                                                    multiple>
                                                                <optgroup
                                                                    label="{{ __('admin/products/product.select_category') }} ">
                                                                    @if($categories && $categories -> count() > 0)
                                                                        @foreach($categories as $index => $category)
                                                                            <option value="{{$category -> id }}"
                                                                                    @foreach($product->categories as $cat_pivot)
                                                                                        @if($category->id === $cat_pivot->pivot->category_id) selected @endif
                                                                                @endforeach
                                                                            >{{$category -> name}}
                                                                            </option>
                                                                        @endforeach
                                                                    @endif
                                                                </optgroup>
                                                            </select>
                                                            @error('categories'.$index.'id')
                                                            <span class="text-danger"> {{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="prjectinput1">
                                                                {{ __('admin/products/product.select_tag') }}
                                                            </label>
                                                            <select name="tags[]" class="select2 form-control" multiple>
                                                                <optgroup
                                                                    label="{{ __('admin/products/product.select_tag') }} ">
                                                                    @if($tags && $tags -> count() > 0)
                                                                        @foreach($tags as $tag)
                                                                            <option value="{{$tag -> id }}"
                                                                                    @foreach($product->tags as $tag_pivot)
                                                                                        @if($tag->id === $tag_pivot->pivot->tag_id) selected @endif
                                                                                    @endforeach
                                                                            >{{$tag -> name}}
                                                                            </option>
                                                                        @endforeach
                                                                    @endif
                                                                </optgroup>
                                                            </select>
                                                            @error('tags')
                                                            <span class="text-danger"> {{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="prjectinput1">
                                                                {{ __('admin/products/product.select_brand') }}
                                                            </label>
                                                            <select name="brand_id" class="select2 form-control">
                                                                <optgroup
                                                                    label="{{ __('admin/products/product.select_brand') }} ">
                                                                    @if($brands && $brands -> count() > 0)
                                                                        @foreach($brands as $brand)
                                                                            <option
                                                                                value="{{$brand -> id }}"
                                                                                @if($brand->id == $product->brand_id) selected @endif
                                                                            >
                                                                                {{$brand -> name}}
                                                                            </option>
                                                                        @endforeach
                                                                    @endif
                                                                </optgroup>
                                                            </select>
                                                            @error('brand_id')
                                                            <span class="text-danger"> {{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group mt-1">
                                                            <label for="switcheryColor4" class="card-title ml-1">
                                                                {{ __('admin/products/product.status') }}
                                                            </label>
                                                            <input type="checkbox" value="1"
                                                                   name="is_active"
                                                                   id="switcheryColor4"
                                                                   class="switchery" data-color="success"
                                                                   @if($product -> is_active === true)checked @endif/>

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
                                                    <i class="ft-x"></i> {{ __('admin/categories/category.back') }}
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> {{ __('admin/categories/category.update') }}
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
                    @section('script')
                        <script>
                            $('input:radio[name="type"]').change(
                                function () {
                                    if (this.checked && this.value === '2') {
                                        $('#cats_list').removeClass('hidden');
                                    } else {
                                        $('#cats_list').addClass('hidden');
                                    }
                                });
                        </script>

@endsection
