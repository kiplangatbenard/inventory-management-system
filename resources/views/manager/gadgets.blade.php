<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manager Gadget Requests</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #00c6ff, #0072ff);
            color: #fff;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1000px;
            margin: 50px auto;
            padding: 25px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
        }

        h1 {
            text-align: center;
            font-size: 2.5em;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 14px 20px;
            text-align: left;
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }

        th {
            background-color: rgba(0, 0, 0, 0.2);
        }

        tr:hover {
            background-color: rgba(255, 255, 255, 0.07);
        }

        .no-data {
            text-align: center;
            font-size: 1.2em;
            padding: 20px;
        }

        .icon {
            margin-right: 8px;
            color: #fbbf24;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><i class="fas fa-toolbox icon"></i>Manager Gadget Requests</h1>

        @if($gadgets->isEmpty())
            <p class="no-data"><i class="fas fa-exclamation-circle icon"></i>No gadgets found.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th><i class="fas fa-id-badge icon"></i>ID</th>
                        <th><i class="fas fa-laptop icon"></i>Name</th>
                        <th><i class="fas fa-cube icon"></i>Type</th>
                        <th><i class="fas fa-barcode icon"></i>Serial Number</th>
                        <th><i class="fas fa-check-circle icon"></i>Condition</th>
                        <th><i class="fas fa-toggle-on icon"></i>Status</th>
                    </tr>
                </thead>
                <tbody>
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
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>
