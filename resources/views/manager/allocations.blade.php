<!DOCTYPE html>
<html>
<head>
    <title>Gadget Allocations</title>
</head>
<body>
    <h1>Gadget Allocations</h1>

    @if($allocations->isEmpty())
        <p>No allocations found for your department.</p>
    @else
        <table border="1">
            <tr>
                <th>Gadget</th>
                <th>User</th>
                <th>Allocated At</th>
            </tr>
            @foreach($allocations as $allocation)
                <tr>
                    <td>{{ $allocation->gadget->name ?? 'N/A' }}</td>
                    <td>{{ $allocation->user->name ?? 'N/A' }}</td>
                    <td>{{ $allocation->created_at }}</td>
                </tr>
            @endforeach
        </table>
    @endif
</body>
</html>
