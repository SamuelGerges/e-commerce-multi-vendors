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
                                        href="{{route('admin.index.products')}}"> {{ __('admin/products/product.images') }} </a>
                                </li>
                                <li class="breadcrumb-item active">
                                    {{ __('admin/products/product.images') }}
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
                                        id="basic-layout-form"> {{ __('admin/products/product.images') }} </h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i>
                                    </a>
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
                                              action="{{route('admin.save.images.update.products')}}"
                                              method="post"
                                              enctype="multipart/form-data">
                                            @csrf
                                            @method('POST')
                                            <div class="form-body">

                                                <div class="form-body">

                                                    <h4 class="form-section"><i class="ft-home"></i>
                                                        {{ __('admin/products/product.images_of_product') }}
                                                    </h4>

                                                    <input type="hidden" name="product_id" value="{{$id}}">

                                                    <div class="form-group">
                                                        <div id="dpz-multiple-files" class="dropzone dropzone-area">
                                                            <div class="dz-message">{{ __('admin/products/product.text_label') }}</div>
                                                        </div>
                                                        <br><br>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1"
                                                        onclick="history.back();">
                                                    <i class="ft-x"></i> {{ __('admin/products/product.back') }}
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> {{ __('admin/products/product.save') }}
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
                            var uploadedDocumentMap = {}
                            Dropzone.options.dpzMultipleFiles = {
                                paramName: "images", // The name that will be used to transfer the file
                                //autoProcessQueue: false,
                                maxFilesize: 5, // MB
                                clickable: true,
                                addRemoveLinks: true,
                                acceptedFiles: 'image/*',
                                dictFallbackMessage: " ?????????????? ?????????? ?????? ???? ???????? ?????????? ???????? ???????????? ???????????? ???????????????? ",
                                dictInvalidFileType: "?????????????? ?????? ?????? ?????????? ???? ?????????????? ",
                                dictCancelUpload: "?????????? ?????????? ",
                                dictCancelUploadConfirmation: " ???? ?????? ?????????? ???? ?????????? ?????? ?????????????? ?? ",
                                dictRemoveFile: "?????? ????????????",
                                dictMaxFilesExceeded: "?????????????? ?????? ?????? ???????? ???? ?????? ",
                                headers: {
                                    'X-CSRF-TOKEN':
                                        "{{ csrf_token() }}"
                                }
                                ,
                                url: "{{ route('admin.images.update.products') }}", // Set the url
                                success:
                                    function (file, response) {
                                        $('form').append('<input type="hidden" name="images[]" value="' + response.name + '">')
                                        uploadedDocumentMap[file.name] = response.name
                                    }
                                ,
                                removedfile: function (file) {
                                    file.previewElement.remove()
                                    var name = ''
                                    if (typeof file.file_name !== 'undefined') {
                                        name = file.file_name
                                    } else {
                                        name = uploadedDocumentMap[file.name]
                                    }
                                    $('form').find('input[name="images[]"][value="' + name + '"]').remove()
                                }
                                ,
                                // previewsContainer: "#dpz-btn-select-files", // Define the container to display the previews
                                init: function () {
                                    @if(isset($event) && $event->document)
                                    var files =
                                        {!! json_encode($event->document) !!}
                                        for (var i in files) {
                                        var file = files[i]
                                        this.options.addedfile.call(this, file)
                                        file.previewElement.classList.add('dz-complete')
                                        $('form').append('<input type="hidden" name="images[]" value="' + file.file_name + '">')
                                    }
                                    @endif
                                }
                            }
                        </script>

@endsection

