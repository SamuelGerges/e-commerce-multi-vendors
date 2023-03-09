<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="nav-item active">
                <a href="{{route('admin.home')}}"><i class="la la-mouse-pointer"></i>
                    <span class="menu-title" data-i18n="nav.add_on_drag_drop.main">
                        {{ __('admin/includes/sidebar.main_page') }}
                    </span>
                </a>
            </li>

            <li class="nav-item  open ">
                <a href=""><i class="la la-home"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">
                        {{ __('admin/includes/sidebar.languages') }}
                    </span>
                    <span class="badge badge badge-info badge-pill float-right mr-2"></span>
                </a>
                <ul class="menu-content">
                    <li class="active">
                        <a class="menu-item" href="" data-i18n="nav.dash.ecommerce">
                            {{ __('admin/includes/sidebar.view_all') }}
                        </a>
                    </li>
                    <li>
                        <a class="menu-item" href="" data-i18n="nav.dash.crypto">
                            {{ __('admin/includes/sidebar.add_new_language') }}
                        </a>
                    </li>
                </ul>
            </li>


            @can('categories')
                <li class="nav-item">
                    <a href="{{route('admin.index.categories')}}">
                        <i class="la la-group"></i>
                        <span class="menu-title"
                              data-i18n="nav.dash.main">{{ __('admin/includes/sidebar.categories') }} </span>
                        <span class="badge badge badge-danger badge-pill float-right mr-2">
                        {{\App\Models\Category::count()}}
                    </span>
                    </a>
                    <ul class="menu-content">
                        <li class="active">
                            <a class="menu-item" href="{{route('admin.index.categories')}}"
                               data-i18n="nav.dash.ecommerce"> {{ __('admin/includes/sidebar.view_all') }}
                            </a>
                        </li>
                        <li>
                            <a class="menu-item" href="{{route('admin.create.categories')}}"
                               data-i18n="nav.dash.crypto">{{ __('admin/includes/sidebar.add_new_category') }}
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan
            @can('brands')
                <li class="nav-item">
                    <a href="">
                        <i class="la la-group"></i>
                        <span class="menu-title"
                              data-i18n="nav.dash.main">{{ __('admin/includes/sidebar.brands') }}
                    </span>
                        <span class="badge badge badge-success badge-pill float-right mr-2">
                        {{\App\Models\Brand::count()}}
                    </span>
                    </a>
                    <ul class="menu-content">
                        <li class="active">
                            <a class="menu-item" href="{{route('admin.index.brands')}}" data-i18n="nav.dash.ecommerce">
                                {{ __('admin/includes/sidebar.view_all') }}
                            </a>
                        </li>
                        <li>
                            <a class="menu-item" href="{{route('admin.create.brands')}}" data-i18n="nav.dash.crypto">
                                {{ __('admin/includes/sidebar.add_brand') }}
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan
            @can('tags')
                <li class="nav-item">
                    <a href="">
                        <i class="la la-group"></i>
                        <span class="menu-title"
                              data-i18n="nav.dash.main">{{ __('admin/includes/sidebar.tags') }}
                        </span>
                        <span class="badge badge badge-success badge-pill float-right mr-2">
                         {{\App\Models\Tag::count()}}
                        </span>
                    </a>
                    <ul class="menu-content">
                        <li class="active">
                            <a class="menu-item" href="{{route('admin.index.tags')}}" data-i18n="nav.dash.ecommerce">
                                {{ __('admin/includes/sidebar.view_all') }}
                            </a>
                        </li>
                        <li>
                            <a class="menu-item" href="{{route('admin.create.tags')}}" data-i18n="nav.dash.crypto">
                                {{ __('admin/includes/sidebar.add_tag') }}
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan
            @can('products')
                <li class="nav-item">
                    <a href="">
                        <i class="la la-group"></i>
                        <span class="menu-title"
                              data-i18n="nav.dash.main">{{ __('admin/includes/sidebar.products') }}
                    </span>
                        <span class="badge badge badge-success badge-pill float-right mr-2">
                        {{\App\Models\Product::count()}}
                    </span>
                    </a>
                    <ul class="menu-content">
                        <li class="active">
                            <a class="menu-item" href="{{route('admin.index.products')}}"
                               data-i18n="nav.dash.ecommerce">
                                {{ __('admin/includes/sidebar.view_all') }}
                            </a>
                        </li>
                        <li>
                            <a class="menu-item" href="{{ route('admin.general.create.products') }}"
                               data-i18n="nav.dash.crypto">
                                {{ __('admin/includes/sidebar.add_new_product') }}
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan
            @can('attributes')
                <li class="nav-item">
                    <a href="">
                        <i class="la la-group"></i>
                        <span class="menu-title"
                              data-i18n="nav.dash.main">{{ __('admin/includes/sidebar.attributes') }}
                    </span>
                        <span class="badge badge badge-success badge-pill float-right mr-2">
                        {{\App\Models\Attribute::count()}}
                    </span>
                    </a>
                    <ul class="menu-content">
                        <li class="active">
                            <a class="menu-item" href="{{route('admin.index.attributes')}}"
                               data-i18n="nav.dash.ecommerce">
                                {{ __('admin/includes/sidebar.view_all') }}
                            </a>
                        </li>
                        <li>
                            <a class="menu-item" href="{{ route('admin.create.attributes') }}"
                               data-i18n="nav.dash.crypto">
                                {{ __('admin/includes/sidebar.add_new_attribute') }}
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan
            @can('options')
                <li class="nav-item">
                    <a href="">
                        <i class="la la-group"></i>
                        <span class="menu-title"
                              data-i18n="nav.dash.main">{{ __('admin/includes/sidebar.options') }}
                    </span>
                        <span class="badge badge badge-success badge-pill float-right mr-2">
                        {{\App\Models\Option::count()}}
                    </span>
                    </a>
                    <ul class="menu-content">
                        <li class="active">
                            <a class="menu-item" href="{{route('admin.index.options')}}" data-i18n="nav.dash.ecommerce">
                                {{ __('admin/includes/sidebar.view_all') }}
                            </a>
                        </li>
                        <li>
                            <a class="menu-item" href="{{ route('admin.create.options') }}" data-i18n="nav.dash.crypto">
                                {{ __('admin/includes/sidebar.add_new_option') }}
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan

            @can('roles')
                <li class="nav-item">
                    <a href="">
                        <i class="la la-male"></i>
                        <span class="menu-title"
                              data-i18n="nav.dash.main">{{ __('admin/includes/sidebar.roles') }}
                    </span>
                        <span class="badge badge badge-success badge-pill float-right mr-2"></span>
                    </a>
                    <ul class="menu-content">
                        <li class="active">
                            <a class="menu-item" href="{{ route('admin.index.roles') }}" data-i18n="nav.dash.ecommerce">
                                {{ __('admin/includes/sidebar.view_all') }}
                            </a>
                        </li>
                        <li>
                            <a class="menu-item" href="{{ route('admin.create.roles') }}" data-i18n="nav.dash.crypto">
                                {{ __('admin/includes/sidebar.add_role') }}
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan
            @can('users')
                <li class="nav-item">
                    <a href="">
                        <i class="la la-male"></i>
                        <span class="menu-title"
                              data-i18n="nav.dash.main">{{ __('admin/includes/sidebar.users') }}
                    </span>
                        <span class="badge badge badge-success badge-pill float-right mr-2"></span>
                    </a>
                    <ul class="menu-content">
                        <li class="active">
                            <a class="menu-item" href="{{ route('admin.index.users') }}" data-i18n="nav.dash.ecommerce">
                                {{ __('admin/includes/sidebar.view_all') }}
                            </a>
                        </li>
                        <li>
                            <a class="menu-item" href="{{ route('admin.create.users') }}" data-i18n="nav.dash.crypto">
                                {{ __('admin/includes/sidebar.add_user') }}
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan

            {{--            vendors--}}
            <li class="nav-item">
                <a href="">
                    <i class="la la-male"></i>
                    <span class="menu-title"
                          data-i18n="nav.dash.main">{{ __('admin/includes/sidebar.vendors') }}
                    </span>
                    <span class="badge badge badge-success badge-pill float-right mr-2"></span>
                </a>
                <ul class="menu-content">
                    <li class="active">
                        <a class="menu-item" href="" data-i18n="nav.dash.ecommerce">
                            {{ __('admin/includes/sidebar.view_all') }}
                        </a>
                    </li>
                    <li>
                        <a class="menu-item" href="" data-i18n="nav.dash.crypto">
                            {{ __('admin/includes/sidebar.add_vendor') }}
                        </a>
                    </li>
                </ul>
            </li>

            <li class=" nav-item">
                <a href="#"><i class="la la-television">
                    </i>
                    <span class="menu-title" data-i18n="nav.templates.main">
                        {{__('admin/includes/sidebar.settings')}}
                    </span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a class="menu-item" href="#" data-i18n="nav.templates.vert.main">
                            {{__('admin/includes/sidebar.shipping_method')}}
                        </a>
                        <ul class="menu-content">
                            <li>
                                <a class="menu-item" href="{{ route('admin.edit.shipping.method','free') }}"
                                   data-i18n="nav.templates.vert.classic_menu">
                                    {{__('admin/includes/sidebar.free_shipping')}}
                                </a>
                            </li>
                            <li>
                                <a class="menu-item" href="{{ route('admin.edit.shipping.method','inner') }}">
                                    {{__('admin/includes/sidebar.local_shipping')}}
                                </a>
                            </li>
                            <li>
                                <a class="menu-item" href="{{ route('admin.edit.shipping.method','outer') }}"
                                   data-i18n="nav.templates.vert.compact_menu">
                                    {{__('admin/includes/sidebar.outer_shipping')}}
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="menu-item" href="#" data-i18n="nav.templates.vert.main">
                            {{__('admin/includes/sidebar.sliders')}}
                        </a>
                        <ul class="menu-content">
                            <li>
                                <a class="menu-item" href="{{ route('admin.create.sliders') }}"
                                   data-i18n="nav.templates.vert.classic_menu">
                                    {{__('admin/includes/sidebar.add_sliders')}}
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
</div>
