<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Data Projects</title>
    <style>
        body{
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h2{
            text-align: center;
            margin-bottom: 20px;
        }

        .subtitle{
            text-align: center;
            margin-bottom: 20px;

        }

        table{
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td{
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        th{
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h2>LAPORAN DATA PROJECT</h2>
    <div class="subtitle">Tanggal Cetak: {{ date('d-m-Y') }}</div>
    <table>
        <thead>
            <th>No</th>
            <th>Foto</th>
            <th>Judul Project</th>
            <th>Deskripsi</th>
            <th>Teknologi</th>
            <th>Status</th>
        </thead>
        <tbody>
            @foreach ($projects as $project)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if ($project->image && file_exists(public_path('images/' . $project->image)))
                            <img src="{{ asset('images/' . $project->image) }}" alt="Foto" width="100px">
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $project->title }}</td>
                    <td>{{ $project->description }}</td>
                    <td>{{ $project->teknologi }}</td>
                    <td>{{ $project->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>