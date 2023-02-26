@extends('layouts.dashboard')
@prepend('appTitle')
    <title>{{ config('app.name') }} | Add product</title>
@endprepend
@prepend('css')
    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            position: unset !important;
        }
    </style>
@endprepend
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.products.index') }}">Products</a></li>
                        <li class="breadcrumb-item active"><a>Add product</a></li>
                    </ol>
                </div>
                <h4 class="page-title"> Add product</h4>
                @include('partials.dashboard.errorsMessage')
                @include('partials.dashboard.demoMessage')

                @if ($categories->isEmpty())
                    <div class="alert alert-info">
                        <i class="dripicons-information me-2"></i>
                        Please add <a href="{{ route('dashboard.categories.create') }}"> category </a> first
                    </div>
                @endif

            </div>

            <div class="card">
                <div class="card-body">
                    <div class="page-title-box">
                        <form action="{{ route('dashboard.products.store') }}" method="POST">
                            @csrf
                            <div class="row g-2">
                                <div class="mb-3 col-sm-6 col-md-6">
                                    <label for="title" class="form-label"> Title *</label>
                                    <input type="text" class="form-control  @error('title') is-invalid  @enderror"
                                        id="title" name="title" value="{{ old('title') }}">
                                </div>

                                <div class="mb-3 col-sm-6 col-md-6">
                                    <label for="status-select" class="form-label"> Category *</label>
                               
                                    <select class="form-select   @error('category_id') is-invalid  @enderror"
                                        id="status-select" name="category_id">
                                        <option value=""> Select</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" @if(old('category_id') == $category->id ) selected @endif> {{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                </div>


                            </div>


                            <div class="row g-2">
                                <div class="mb-3 col-md-12 variable-product">

                                    @if (old('product_option_size'))
                                        @foreach (old('product_option_size') as $key => $product_option_size)
                                            <div class="row  g-2 product-option" {{ $loop->first ? 'id=option' : '' }}>
                                                <div class="mb-3 col-md-3">
                                                    <div class="form-group">
                                                        <label class="form-label">Size *</label>
                                                        <input type="number"
                                                            class="form-control 
                                                        @error('product_option_size.' . $key) is-invalid  @enderror
                                                        "
                                                            name="product_option_size[]" value="{{ $product_option_size }}"
                                                            placeholder="eg: 37">
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-md-3">
                                                    <div class="form-group">
                                                        <label class="form-label">Color *</label>
                                                        <input type="color"
                                                            class="form-control 
                                                        @error('product_option_color.' . $key) is-invalid  @enderror
                                                        "
                                                            name="product_option_color[]"
                                                            value="{{ old('product_option_color')[$key] ?? '' }}"
                                                            placeholder="eg: #000000">
                                                    </div>
                                                </div>

                                                <div class="mb-3 col-md-3">
                                                    <div class="form-group">
                                                        <label class="form-label">Price (in USD) *</label>
                                                        <input type="text"
                                                            class="form-control 
                                                        @error('product_option_price.' . $key) is-invalid  @enderror
                                                        "
                                                            name="product_option_price[]"
                                                            value="{{ old('product_option_price')[$key] ?? '' }}"
                                                            placeholder="eg: 20">
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-md-3">
                                                    <div class="form-group">
                                                        <label class="form-label">Quantity *</label>
                                                        <input type="number"
                                                            class="form-control 
                                                        @error('product_option_quantity.' . $key) is-invalid  @enderror
                                                        "
                                                            name="product_option_quantity[]"
                                                            value="{{ old('product_option_quantity')[$key] ?? '' }}"
                                                            placeholder="eg: 30">
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="row  g-2 product-option" id="option">
                                            <div class="mb-3 col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label">Size </label>
                                                    <input type="number"
                                                        class="form-control  @error('product_option_size') is-invalid  @enderror"
                                                        name="product_option_size[]" value="" placeholder="eg: 37">
                                                </div>
                                            </div>

                                            <div class="mb-3 col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label">Color </label>
                                                    <input type="color"
                                                        class="form-control  @error('product_option_color') is-invalid  @enderror"
                                                        name="product_option_color[]" value="#000000"
                                                        placeholder="eg: #000000">
                                                </div>
                                            </div>

                                            <div class="mb-3 col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label">Price (in USD) </label>
                                                    <input type="text"
                                                        class="form-control  @error('product_option_price') is-invalid  @enderror"
                                                        name="product_option_price[]" placeholder="eg: 40">
                                                </div>
                                            </div>
                                            <div class="mb-3 col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label">Quantity </label>
                                                    <input type="number"
                                                        class="form-control  @error('product_option_quantity') is-invalid  @enderror"
                                                        name="product_option_quantity[]" value=""
                                                        placeholder="eg: 30">
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <button type="button" class="btn btn-dark btn-xs float-right mt-2"
                                        id="add_more_option">
                                        <i class="ti-plus"></i> {{ 'Add new line' }}
                                    </button>
                                </div>

                            </div>

                            <image-input-component title="Image(400X250)" :is-required={{ true }}>
                            </image-input-component>


                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="customCheck" name="status"
                                            checked>
                                        <label class="form-check-label" for="customCheck"> Can be displayed?</label>
                                    </div>

                                </div>
                            </div>

                            <a href="{{ route('dashboard.products.index') }}" class="btn btn-secondary">
                                Back

                            </a>

                            <button type="submit" class="btn btn-primary">
                                Save

                            </button>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@prepend('js')
    <script>
        $(document).on('click', '#add_more_option', function() {
            var new_option = $("#option").clone();
            new_option.removeAttr('id');
            new_option.find('input').val("");
            new_option.find('input').removeAttr("style");
            new_option.prepend(
                '<div class="col-md-12"><i class="mdi mdi-close-circle float-right text-danger remove-product-option"></i></div>'
            );
            $(this).before(new_option);
        });

        $(document).on('click', '.remove-product-option', function() {
            $(this).parent().parent().remove();
        });
    </script>
@endprepend
