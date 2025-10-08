<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Export PDF' }}</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 6px;
            text-align: left;
        }

        th {
            background-color: #f3f3f3;
        }
    </style>
</head>

<body>
    <h2>{{ $title ?? 'Export Data' }}</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                @foreach($columns as $col)
                <th>{{ $col['label'] }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($data as $row)
            <tr>
                <td>{{ $row['autonumber'] }}</td>
                @foreach($columns as $col)
                @php
                $value = $row[$col['field']] ?? '-';

                // mapping otomatis kolom active
                if ($col['field'] === 'active') {
                $value = ($value == 1) ? 'Yes' : 'No';
                }

                if ($col['field'] === 'status') {
                if ($value == 1) {
                $value = '<span class="kt-badge kt-badge-primary"> Pending </span>';
                } elseif ($value == 2) {
                $value = '<span class="kt-badge kt-badge-success"> Success </span>';
                } elseif ($value == 3) {
                $value = 'Failed';
                } else {
                $value = '-';
                }
                }
                @endphp


                <td>{!! $value !!}</td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>