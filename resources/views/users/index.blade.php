@extends('layouts.main', ['activePage' => 'users', 'titlePage' => 'Usuarios'])
@section('content')
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header card-header-info">
                    <h4 class="card-title">Usuários</h4>
                    <p class="card-category">Usuários registrados</p>
                  </div>
                  <div class="card-body">
                    @if (session('success'))
                    <div class="alert alert-success" role="success">
                      {{ session('success') }}
                    </div>
                    @endif
                    <div class="row">
                      <div class="col-12 text-right">
                        @can('user_create')
                        <a href="{{ route('users.create') }}" class="btn btn-sm btn-facebook">Novo Usuário</a>
                        @endcan
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table class="table">
                        <thead class="text-dark">
                          <th>ID</th>
                          <th>Nome</th>
                          <th>E-mail</th>
                          <th>Username</th>
                          <th>Nome completo</th>
                          <th>Roles</th>
                          <th class="text-right">Ações</th>
                        </thead>
                        <tbody>
                          @foreach ($users as $user)
                            <tr>
                              <td>{{ $user->id }}</td>
                              <td>{{ $user->name }}</td>
                              <td>{{ $user->email }}</td>
                              <td>{{ $user->username }}</td>
                              <td>{{ $user->fullname }}</td>
                              <td>
                                  @forelse ($user->roles as $role)
                                    <span class="badge badge-info">{{ $role->name }}</span>
                                  @empty
                                    <span class="badge badge-danger">No roles</span>
                                  @endforelse
                                </td>
                              <td class="td-actions text-right">
                                @can('user_show')
                                <a href="{{ route('users.show', $user->id) }}" class="btn btn-info"><i class="material-icons">person</i></a>
                                @endcan
                                @can('user_edit')
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning"><i class="material-icons">edit</i></a>
                                @endcan
                                @can('user_destroy')
                                <form action="{{ route('users.delete', $user->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Deseja realmente excluir?')">
                                @csrf
                                @method('DELETE')
                                    <button class="btn btn-danger" type="submit" rel="tooltip">
                                    <i class="material-icons">close</i>
                                    </button>
                                </form>
                                @endcan
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="card-footer mr-auto">
                    {{ $users->links() }}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
