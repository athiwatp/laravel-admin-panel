@extends('layouts.admin')

@section('content')
    <div class="container" id="vue-container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Roles Management</div>

                    <div class="panel-body">
                        <div class="table-responsive">

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
