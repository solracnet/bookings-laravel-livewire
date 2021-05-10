@props(['id', 'error'])
<input
    type="text"
    class="form-control datetimepicker-input @error('date') is-invalid @enderror"
    id="{{ $id }}"
    data-toggle="datetimepicker"
    data-target="#{{ $id }}"
    {{ $attributes }}
    onchange="this.dispatchEvent(new InputEvent('input'))"
    />

@push('js')
<script type="text/javascript">
    $('#{{ $id }}').datetimepicker({
        format: 'L'
    });
</script>
@endpush
