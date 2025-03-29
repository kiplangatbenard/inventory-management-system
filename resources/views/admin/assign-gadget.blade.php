@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Assign Gadget to {{ $employee->name }}</h2>
    <form action="{{ route('admin.storeAssignedGadget', $employee->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="gadget" class="form-label">Select Gadget</label>
            <select class="form-control" id="gadget" name="gadget_id" required>
                @foreach($gadgets as $gadget)
                    <option value="{{ $gadget->id }}">{{ $gadget->name }} ({{ $gadget->serial_number }})</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Assign Gadget</button>
    </form>
</div>
@endsection
