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
                <li class="breadcrumb-item active">Appointments</li>
                </ol>
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="content">
        <div class="container-fluid">

          <div class="row">
            <div class="col-lg-12">
                <div class="d-flex justify-content-between mb-2">
                    <div>
                    @if ($selectedRows)
                    <div class="btn-group">
                        <button type="button" class="btn btn-default">Bulk Actions</button>
                        <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu" style="">
                          <a class="dropdown-item" href="#" wire:click.prevent="deleteSelectedRows">Delete Selected</a>
                          <a class="dropdown-item" href="#" wire:click.prevent="markAllAsScheduled">Mark as Scheduled</a>
                          <a class="dropdown-item" href="#" wire:click.prevent="markAllAsClosed">Mark as Closed</a>
                        </div>
                    </div>
                    <span>Select {{ count($selectedRows) }} appointments</span>
                    @endif
                </div>
                    <a href="{{ route('admin.appointments.create') }}">
                        <button class="btn btn-primary">
                            <i class="fa fa-plus-circle mr-2"></i>
                            Add new user
                        </button>
                    </a>
                </div>
              <div class="card">
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox"
                                        id="checkboxPrimary1"
                                        wire:model="selectPageRows"
                                        >
                                    <label for="checkboxPrimary1">
                                    </label>
                                  </div>
                              </th>
                              <th scope="col">Client Name</th>
                              <th scope="col">Date</th>
                              <th scope="col">Time</th>
                              <th scope="col">Status</th>
                              <th scope="col">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($appointments as $appointment)
                            <tr>
                                <td scope="row">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox"
                                            wire:model='selectedRows'
                                            id="{{ $appointment->id }}"
                                            value="{{ $appointment->id }}"
                                            >
                                        <label for="{{ $appointment->id }}">
                                        </label>
                                      </div>
                                </td>
                              <td>{{ $appointment->client->name }}</td>
                              <td>{{ $appointment->date }}</td>
                              <td>{{ $appointment->time }}</td>
                              <td>
                                <span class="badge badge-{{ $appointment->status_badge }}">{{ $appointment->status }}</span>
                              </td>
                              <td>
                                  <a href="{{ route('admin.appointments.edit', $appointment) }}">
                                      <i class="fa fa-edit mr-2"></i>
                                  </a>
                                  <a href="" wire:click.prevent="confirmAppointmentRemoval({{ $appointment->id }})">
                                      <i class="fa fa-trash text-danger"></i>
                                  </a>
                              </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6">No rows found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    {{ $appointments->links() }}
                </div>
              </div>
            </div>
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>

</div>
