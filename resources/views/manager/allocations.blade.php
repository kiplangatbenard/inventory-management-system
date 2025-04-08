<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gadget Allocations</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #667eea, #764ba2);
            color: #fff;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin: 50px auto;
            padding: 20px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.3);
        }

        h1 {
            text-align: center;
            font-size: 2.5em;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: rgba(255, 255, 255, 0.15);
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }

        th {
            background-color: rgba(0, 0, 0, 0.2);
        }

        tr:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .no-data {
            text-align: center;
            font-size: 1.2em;
            padding: 20px;
        }

        .icon {
            margin-right: 8px;
            color: #fcd34d;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><i class="fas fa-laptop-code icon"></i>Gadget Allocations</h1>

        @if($allocations->isEmpty())
            <p class="no-data"><i class="fas fa-exclamation-circle icon"></i>No allocations found for your department.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th><i class="fas fa-microchip icon"></i>Gadget</th>
                        <th><i class="fas fa-user icon"></i>User</th>
                        <th><i class="fas fa-calendar-alt icon"></i>Allocated At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($allocations as $allocation)
                        <tr>
                            <td>{{ $allocation->gadget->name ?? 'N/A' }}</td>
                            <td>{{ $allocation->user->name ?? 'N/A' }}</td>
                            <td>{{ $allocation->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>
