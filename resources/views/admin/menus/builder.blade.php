@extends('layouts.backend.app')

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
                  Menu Builder (<code>{{$menu->name}}</code>)
                </div>
            </div>
            <div class="page-title-actions">
                    <a href="{{route('admin.menus.index')}}" class="btn-shadow btn btn-danger mr-2">
                        <span class="btn-icon-wrapper pr-1 opacity-7">
                            <i class="fas fa-arrow-circle-left"></i>
                        </span>
                       Go  Back
                    </a>
                    <a href="{{route('admin.menus.item.create', $menu->id)}}" class="btn-shadow btn btn-primary">
                        <span class="btn-icon-wrapper pr-1 opacity-7">
                            <i class="fas fa-plus-circle"></i>
                        </span>
                       Create Menu Item
                    </a>
            </div>    
        </div>
    </div>       

    <div class="row">
        <div class="col-md-12">

                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">How to use !</h5>
                            <p>You can output a menu anywhere on your site by calling <code>menu('name')</code></p>
                        </div>
                    </div>

                    <div class="main-card mb-3 card menu-builder">
                        <div class="card-body">
                            <h5 class="card-title">Drag and Drop the menu item below to re-arrange them</h5>
                            <div class="dd">
                                <ol class="dd-list">
                                    @forelse ($menu->menuItems as $item)
                                        <li class="dd-item" data-id="{{$item->id}}">

                                            <div class="pull-right item_actions">
                                                <a href="{{route('admin.menus.item.edit', ['id' => $menu->id, 'itemId' => $item->id])}}" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-edit mr-1"></i> Edit
                                                </a>
                                                    <button type="button" onclick="removeData('{{$item->id}}')" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash mr-1"></i> Delete
                                                    </button>
                                                    <form id="delete-form-{{$item->id}}" action="{{route('admin.menus.item.destroy', ['id' => $menu->id, 'itemId' => $item->id])}}" method="post" style="display: none">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                            </div>

                                            <div class="dd-handle">
                                                @if ($item->type == 'divider')
                                                <strong>Divider: {{$item->divider_title}} </strong>
                                                @else
                                                <span> {{$item->title}} </span>
                                                <small class="text-danger url"> {{$item->url}} </small>
                                                @endif
                                            </div>      
                                            
                                            {{-- For Children --}}
                                            @if (!$item->childs->isEmpty())
                                            <ol class="dd-list">
                                                @foreach ($item->childs as $childItem)
                                                    <li class="dd-item" data-id="{{$childItem->id}}">
            
                                                        <div class="pull-right item_actions">
                                                            <a href="{{route('admin.menus.item.edit', ['id' => $childItem->id, 'itemId' => $childItem->id])}}" class="btn btn-primary btn-sm">
                                                                <i class="fas fa-edit mr-1"></i> Edit
                                                            </a>
                                                                <button type="button" onclick="removeData('{{$childItem->id}}')" class="btn btn-danger btn-sm">
                                                                    <i class="fas fa-trash mr-1"></i> Delete
                                                                </button>
                                                                <form id="delete-form-{{$childItem->id}}" action="{{route('admin.menus.item.destroy', ['id' => $childItem->id, 'itemId' => $childItem->id])}}" method="post" style="display: none">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                </form>
                                                        </div>
            
                                                        <div class="dd-handle">
                                                            @if ($childItem->type == 'divider')
                                                            <strong>Divider: {{$childItem->divider_title}} </strong>
                                                            @else
                                                            <span> {{$childItem->title}} </span>
                                                            <small class="text-danger url"> {{$childItem->url}} </small>
                                                            @endif
                                                        </div>      
                                                    </li>
                                                @endforeach
                                            </ol>
                                            @endif
                                        
                                        </li>
                                    @empty
                                        <div class="text-center text-danger">
                                            <strong> Menu item not found. </strong>
                                        </div>
                                    @endforelse
                                </ol>
                            </div>
                        </div>
                    </div>

        </div>
    </div>
@endsection

@push('js')
    <script>
     $(function () {
            $('.dd').nestable({maxDepth: 2});
            $('.dd').on('change', function (e) {
                $.post('{{ route('admin.menus.order',$menu->id) }}', {
                    order: JSON.stringify($('.dd').nestable('serialize')),
                    _token: '{{ csrf_token() }}'
                }, function (data) {
                    toastr["success"]("Menu changed successfully");
                    toastr.options = {
                    "progressBar": true,
                    "positionClass": "toast-bottom-right",
                    }
                });
            });
        });
    </script>
@endpush