<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pegawai</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 20px;
            padding: 0;
            background-color: #f4f4f9;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 20px auto;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .study-message {
            font-weight: bold;
            color: #FF5733;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Profil Pegawai</h1>

        <table>
            <tr>
                <th>Nama</th>
                <td>{{ $data['name'] }}</td>
            </tr>
            <tr>
                <th>Umur</th>
                <td>{{ $data['my_age'] }} tahun</td>
            </tr>
            <tr>
                <th>Hobi</th>
                <td>
                    <ul>
                        @foreach($data['hobbies'] as $hobby)
                            <li>{{ $hobby }}</li>
                        @endforeach
                    </ul>
                </td>
            </tr>
            <tr>
                <th>Tanggal Harus Wisuda</th>
                <td>{{ \Carbon\Carbon::parse($data['tgl_harus_wisuda'])->format('d F Y') }}</td>
            </tr>
            <tr>
                <th>Jarak Hari dari Tanggal Wisuda</th>
                <td>{{ $data['time_to_study_left'] }} hari lagi</td>
            </tr>
            <tr>
                <th>Semester Saat Ini</th>
                <td>{{ $data['current_semester'] }}</td>
            </tr>
            <tr>
                <th>Status Studi</th>
                <td class="study-message">{{ $data['Pesan'] }}</td>
            </tr>
            <tr>
                <th>Cita-cita</th>
                <td>{{ $data['future_goal'] }}</td>
            </tr>
        </table>
    </div>

</body>
</html>
