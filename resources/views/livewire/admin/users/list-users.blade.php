<div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Starter Page 1</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active">Users</li>
                </ol>
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="content">
        <div class="container-fluid">

          <div class="row">
            <div class="col-lg-12">
                <div class="d-flex justify-content-end mb-2">
                    <button class="btn btn-primary" wire:click.prevent="addNew">
                        <i class="fa fa-plus-circle mr-2"></i>
                        Add new user
                    </button>
                </div>
              <div class="card">
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Name</th>
                              <th scope="col">Email</th>
                              <th scope="col">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                            <tr>
                              <td scope="row">{{ $loop->iteration }}</td>
                              <td>{{ $user->name }}</td>
                              <td>{{ $user->email }}</td>
                              <td>
                                  <a href="" wire:click.prevent="edit({{ $user }})">
                                      <i class="fa fa-edit mr-2"></i>
                                  </a>
                                  <a href="" wire:click.prevent="confirmRemove({{ $user->id }})">
                                      <i class="fa fa-trash text-danger"></i>
                                  </a>
                              </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">Empty records</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
              </div>
            </div>
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>

      <div class="modal fade" id="form" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">{{ $this->showEditModal ? 'Edit User' : 'Add New User' }}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form id="userForm" autocomplete="off" wire:submit.prevent="{{ $this->showEditModal ? 'updateUser' : 'createUser' }}">
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" wire:model.defer='form.name'
                        class="form-control @error('name') is-invalid @enderror"
                        id="name" aria-describedby="nameHelp" placeholder="Enter full name">
                      @error('name')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" wire:model.defer='form.email'
                            class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="emailHelp" placeholder="Enter your best email here">
                        @error('email')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" wire:model.defer='form.password'
                            class="form-control @error('password') is-invalid @enderror" id="password" aria-describedby="passwordHelp" placeholder="Password">
                        @error('password')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                    <div class="form-group">
                        <label for="passwordConfirmation">Confirme your password</label>
                        <input type="password" wire:model.defer='form.password_confirmation'
                            class="form-control @error('password-confirmation') is-invalid @enderror" id="passwordConfirmation"
                            aria-describedby="passwordConfirmationHelp" placeholder="Confirm your password">
                            @error('password-confirmation')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>

                  </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">
                    <i class="fa fa-times mr-1"></i>
                    Cancel
                </button>
                <button type="submit" form="userForm" class="btn btn-primary">
                    <i class="fa fa-save mr-1"></i>
                    Save
                </button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <h4>Are you sure you want do delete this user?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">
                    <i class="fa fa-times mr-1"></i>
                    Cancel
                </button>
                <button type="button" wire:click.prevent="deleteUser" form="userForm" class="btn btn-danger">
                    <i class="fa fa-trash mr-1"></i>
                    User Delete
                </button>
            </div>
          </div>
        </div>
      </div>
</div>
