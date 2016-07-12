@extends('layouts.admin')

@section('content')
    <div class="container" id="vue-container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Roles Management</div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <div>

                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    @foreach($roles as $key => $role)
                                        <li role="presentation" class="{{ $key == 0 ? 'active' : '' }}"><a
                                                    href="#{{$role->name}}" aria-controls="{{$role->name}}" role="tab"
                                                    data-toggle="tab">{{$role->full_name}}</a></li>
                                    @endforeach
                                </ul>

                                <!-- Tab panes -->

                                <div class="tab-content">

                                    @foreach($roles as $key => $role)
                                        <div role="tabpanel" class="tab-pane {{ $key == 0 ? 'active' : '' }}"
                                             id="{{$role->name}}">
                                            <form>
                                                <ul>
                                                    @foreach(App\Menu::topLevel() as $menu)
                                                        <li><label for="{{$menu->name}}">{{ $menu->name }}</label>
                                                            <input type="checkbox"
                                                                   name="{{$menu->name}}"
                                                                   id="{{$menu->name}}"
                                                                   value="{{$menu->id}}" {{ $menu->hasPermission($role->id) ? 'checked' : '' }}
                                                                   class="checkedMenus"
                                                                   v-model="{{ 'checkedMenus'.$role->id }}">
                                                        </li>
                                                        @if ($menu->hasChildren())
                                                            <ul>
                                                                @foreach ($menu->getChildren() as $sub_menu)
                                                                    <li>
                                                                        <label for="{{$sub_menu->name}}">{{ $sub_menu->name }}</label>
                                                                        <input type="checkbox"
                                                                               name="{{$sub_menu->name}}"
                                                                               id="{{$sub_menu->name}}"
                                                                               value="{{$sub_menu->id}}" {{ $sub_menu->hasPermission($role->id) ? 'checked' : '' }}
                                                                               v-model="{{ 'checkedMenus'.$role->id }}"
                                                                               class="checkedMenus">
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </form>
                                        </div>
                                    @endforeach
                                        @{{ checkedMenus1 | json }}
                                        @{{ checkedMenus2 | json }}
                                </div>

                                <hr>

                                <button class="btn btn-small btn-info pull-right" @click="saveFormDetails()">
                                Submit</button>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ url('js/view-admin-users-roles.js') }}"></script>
@endsection
