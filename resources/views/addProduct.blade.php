@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header text-white bg-primary">
                @lang('app.pform_t')
            </div>
            <form role="form" method="POST" action="{{ route('additem.route') }}" class="needs-validation"
                  enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>@lang('app.n_item_a')</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter name" required/>
                            </div>
                            <div class="form-group">
                                <label>@lang('app.n_item_b')</label>
                                <input type="text" class="form-control" name="description"
                                       placeholder="Enter description" required/>
                            </div>
                            <div class="form-group">
                                <label>@lang('app.n_item_c')</label>
                                <input type="number" class="form-control" name="price" placeholder="Enter price"
                                       required/>
                            </div>
                            <div class="form-group">
                                <label>@lang('app.n_item_d')</label>
                                <input type="text" class="form-control" name="country" placeholder="Enter country"
                                       required/>
                            </div>
                            <div class="form-group">
                                <label>@lang('app.n_item_e')</label>
                                <select class="form-control" name="category" required>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>@lang('app.n_item_f')</label>
                                <input type="file" class="form-control-file" id="img" name="img"
                                       onchange="loadFile(event)">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <img class="img-fluid" src="{{ asset('storage/items/item.jpg') }}"
                                 alt="Card image cap" id="output"/>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">@lang('app.pform_g')</button>
                </div>
            </form>
        </div>
    </div>

@endsection
