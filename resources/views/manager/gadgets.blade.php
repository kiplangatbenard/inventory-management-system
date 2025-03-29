<!DOCTYPE html>
<html>
<head>
    <title>Manager Gadget Requests</title>
</head>
<body>
    <h1>Manager Gadget Requests</h1>

    @if($gadgets->isEmpty())
        <p>No gadgets found.</p>
    @else
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Type</th>
                <th>Serial Number</th>
                <th>Condition</th>
                <th>Status</th>
            </tr>
            @foreach($gadgets as $gadget)
                <tr>
                    <td>{{ $gadget->id }}</td>
                    <td>{{ $gadget->name }}</td>
                    <td>{{ $gadget->type }}</td>
                    <td>{{ $gadget->serial_number }}</td>
                    <td>{{ $gadget->condition }}</td>
                    <td>{{ $gadget->status }}</td>
                </tr>
            @endforeach
        </table>
    @endif

</body>
</html>
