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
                                        <button class="btn btn-small btn-info" @click="EditRecord(user.id)" data-toggle=
                                        "modal" data-target="#formModal">
                                        Edit</button>
                                        <button v-show="!user.roles[0] || user.roles[0].name != `super`"
                                                class="btn btn-small btn-danger" @click="RemoveRecord(user.id)">
                                        Delete</button>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModallLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form>
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="formModalLabel">@{{ form.title }}</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name" class="control-label">Name:</label>
                                <input type="text" class="form-control" name="name" id="name" v-model="user.name"
                                       value="@{{ user.name }}" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="email" class="control-label">Email:</label>
                                <input type="text" class="form-control" name="email" id="email" v-model="user.email"
                                       value="@{{ user.email }}" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="password" class="control-label">Password:</label>
                                <input type="password" class="form-control" name="password" id="password"
                                       v-model="user.password" value="@{{ user.password }}" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="role" class="control-label">Role:</label>
                                <select class="form-control" name="role" id="role" v-model="user.role">
                                    <option v-for="role in roles" value="@{{ role.id }}">@{{ role.full_name }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" @click="saveFormDetails(user)" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
        <button type="button" class="btn-add-more btn btn-primary glyphicon glyphicon-plus img-circle" @click="
        AddNewRecord()"
        data-toggle="modal" data-target="#formModal"></button>

    </div>



@endsection

@section('scripts')
    <script type="text/javascript" src="{{ url('js/view-admin-users-administrator.js') }}"></script>
@endsection
