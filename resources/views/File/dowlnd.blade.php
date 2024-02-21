<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Map and Modify</title>
</head>
<body>
    <h1>Modified Data</h1>

    {{-- Display the mapped data --}}
    @if (!empty($mappedData))
        <ul>
            @foreach ($mappedData as $data)
                <li>{{ $data['truncated_data'] }}</li>
            @endforeach
        </ul>
    @else
        <p>No data available.</p>
    @endif

    {{-- Provide a link to download the modified file --}}
    @if (!empty($downloadLink))
    <a href="{{ route('file.downloadTextFile') }}" download>Download Modified File</a>
    @endif
</body>
</html>
