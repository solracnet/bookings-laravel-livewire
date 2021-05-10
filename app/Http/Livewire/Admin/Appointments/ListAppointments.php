<?php

namespace App\Http\Livewire\Admin\Appointments;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\Appointment;

class ListAppointments extends AdminComponent
{

    protected $listeners = ['deleteConfirmed' => 'deleteAppointment'];

    public $appointmentIdBeingRemoved = null;

    public $selectedRows = [];
    public $selectPageRows = false;

    public function confirmAppointmentRemoval($id)
    {
        $this->appointmentIdBeingRemoved = $id;

        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function deleteAppointment()
    {
        Appointment::findOrFail($this->appointmentIdBeingRemoved)->delete();

        $this->dispatchBrowserEvent('show-delete-message', ['message' => 'Appointment deleted successfully!']);
    }

    public function updatedSelectPageRows($value)
    {
        if ($value){
            $this->selectedRows = $this->appointments->pluck('id');
        }else{
            $this->reset(['selectedRows', 'selectPageRows']);
        }
    }

    public function getAppointmentsProperty()
    {
        return Appointment::with('client')->latest()->paginate(10);
    }

    public function deleteSelectedRows()
    {
        $appointmentsToDelete = Appointment::whereIn('id', $this->selectedRows);
        $appointmentsToDelete->delete();
        $this->dispatchBrowserEvent('show-delete-message', ['message' => 'Appointments deleted successfully!']);

        $this->reset(['selectedRows', 'selectPageRows']);
    }

    public function markAllAsScheduled()
    {
        $appointments = Appointment::whereIn('id', $this->selectedRows);
        $appointments->update(['status' => 'SCHEDULED']);
        $this->dispatchBrowserEvent('show-delete-message', ['message' => 'Appointments updated successfully!']);

        $this->reset(['selectedRows', 'selectPageRows']);
    }

    public function markAllAsClosed()
    {
        $appointments = Appointment::whereIn('id', $this->selectedRows);
        $appointments->update(['status' => 'CLOSED']);
        $this->dispatchBrowserEvent('show-delete-message', ['message' => 'Appointments updated successfully!']);

        $this->reset(['selectedRows', 'selectPageRows']);
    }

    public function render()
    {

        return view('livewire.admin.appointments.list-appointments', [
            'appointments' => $this->appointments
        ]);
    }
}
