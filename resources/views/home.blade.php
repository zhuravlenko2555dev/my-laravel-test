@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tokens</h3>
                </div>

                <div class="card-body table-responsive">
                    <table class="table table-valign-middle">
                        <thead>
                        <tr>
                            <th>№</th>
                            <th>Name</th>
                            <th>Created at</th>
                            <th>Last used at</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tokens as $i => $token)
                            <tr>
                                <td>{{($i + 1)}}</td>
                                <td>{{$token->name}}</td>
                                <td>{{$token->created_at}}</td>
                                <td>{{$token->last_used_at}}</td>
                                <td>
                                    <form action="{{ route('deleteToken', $token->id) }}" method="post">
                                        <input type="hidden" name="_method" value="delete">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                        <button type="submit" class="btn btn-danger" name="destroy_device">Delete</button>

                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    @if(isset($createdToken) && !empty($createdToken))
                        <h2>New token: {{$createdToken}}</h2>
                    @endif

                    <form action="{{ route('createToken') }}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="text" name="name" placeholder="Token name (may be empty)">

                        <button type="submit" class="btn btn-primary" name="destroy_device">Create new token</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
