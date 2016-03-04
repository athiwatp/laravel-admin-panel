@extends('layouts.admin')

@section('content')
    <div class="container" id="vue-container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Administrator Management</div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Last Login</th>
                                    <th>Options</th>
                                </tr>
                                <tr v-for="user in users">
                                    <td>@{{ user.name }}</td>
                                    <td>@{{ user.email }}</td>
                                    <td>@{{ user.roles[0].full_name }}</td>
                                    <td>@{{ user.last_login }}</td>
                                    <td>
                                        <button class="btn btn-small btn-info" @click="ShowRecord(user.id)">
                                        Edit</button>
                                        <button v-show="!user.roles[0] || user.roles[0].name != `super`" class="btn btn-small btn-danger" @click="RemoveRecord(user.id)">
                                        Delete</button>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ url('js/view-admin-users-administrator.js') }}"></script>
@endsection
