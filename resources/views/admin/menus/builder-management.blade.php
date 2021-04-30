@extends('layouts.backend.app')
@section('title', 'Menu Item Management | Dashboard')

@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-menu icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>
                   @if ( isset($menuItem))
                       Edit Menu Item
                   @else
                       Add New Menu Item to (<code>{{$menu->name}}</code>)
                   @endif
                </div>
            </div>
            <div class="page-title-actions">
                    <a href="{{route('admin.menus.builder', $menu->id)}}" class="btn-shadow btn btn-danger">
                        <span class="btn-icon-wrapper pr-1 opacity-7">
                            <i class="fas fa-arrow-circle-left"></i>
                        </span>
                       Go  Back
                    </a>
            </div>    
        </div>
    </div>       

    <div class="row">

    <div class="col-md-12">
        <form action="{{ isset($menuItem) ? route('admin.menus.item.update', ['id' => $menu->id, 'itemId' => $menuItem->id]) : route('admin.menus.item.store', $menu->id) }}" method="POST">
            @csrf
            @isset($menuItem)
                @method('PUT')
            @endisset

            <div class="row mb-5">
                <div class="col-md-8 m-auto">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Manage Menu</h5>

                            <div class="form-group">
                                <label for="type"> Type </label>
                                <select name="type" id="type" class="custom-select" onchange="setItemType()">
                                    <option value="item" @isset($menuItem) {{$menuItem->type == 'item' ? 'selected' : ''}} @endisset> Menu Item </option>
                                    <option value="divider" @isset($menuItem) {{$menuItem->type == 'divider' ? 'selected' : ''}} @endisset>Ddivider </option>
                                </select>
                            </div>
                        
                            <!-- For Divider Fields -->
                            <div id="divider-fields">
                                <div class="position-relative form-group">
                                    <label for="divider_title">Title of the Divider</label>
                                    <input name="divider_title" id="divider_title" value="{{ $menuItem->divider_title ?? old('divider_title')}}" type="text" class="form-control @error('divider_title') is-invalid @enderror">

                                    @error('divider_title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        
                            <!-- For Item Fields -->
                            <div id="item-fields">
                                <div class="position-relative form-group">
                                    <label for="title">Title </label>
                                    <input name="title" id="title" value="{{ $menuItem->title ?? old('title')}}" type="text" class="form-control @error('title') is-invalid @enderror">
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="position-relative form-group">
                                    <label for="url">URL for the menu item</label>
                                    <input name="url" id="url" value="{{ $menuItem->url ?? old('url')}}" type="text" class="form-control @error('url') is-invalid @enderror" placeholder="/admin/name..">
                                    @error('url')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="target"> Open In </label>
                                    <select name="target" id="target" class="custom-select @error('target') is-invalid @enderror">
                                        <option value="_self" @isset($menuItem) {{$menuItem->target == '_self' ? 'selected' : ''}} @endisset>
                                            Same Tab/Window 
                                        </option>
                                        <option value="_blank" @isset($menuItem) {{$menuItem->target == '_blank' ? 'selected' : ''}} @endisset>
                                            New Tab/Window 
                                        </option>
                                    </select>
                                </div>
                                <div class="position-relative form-group">
                                    <label for="icon_class">Icon class 
                                        <a href="https://demo.dashboardpack.com/architectui-html-free/elements-icons.html" target="_blank">(Icon class)</a>
                                    </label>
                                    <input name="icon_class" id="icon_class" value="{{ $menuItem->icon_class ?? old('icon_class')}}" type="text" class="form-control @error('icon_class') is-invalid @enderror">
                                    @error('icon_class')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        
                                    @isset($menuItem)
                                        <button type="submit" class="mt-1 btn btn-success">
                                            <i class="fas fa-save mr-1"></i> 
                                                Save Changes
                                        </button>
                                        @else
                                        <button type="submit" class="mt-1 btn btn-primary">
                                            <i class="fas fa-plus-circle mr-1"></i> 
                                            Submit
                                        </button>
                                    @endisset       
                                
                        </div>
                    </div>
                </div>
            </div>
</form>
</div>
</div>
@endsection

@push('js')
    <script>
        function setItemType(){
            if ($('select[name="type"]') .val() == 'divider') {
                $('#divider-fields').removeClass('d-none');
                $('#item-fields').addClass('d-none');
            } else {
                $('#divider-fields').addClass('d-none');
                $('#item-fields').removeClass('d-none');
            }
        }
        setItemType();
    </script>
@endpush
