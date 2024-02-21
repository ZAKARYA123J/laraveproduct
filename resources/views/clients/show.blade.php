<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>

    <div class="container mt-4">
    <h2 class="text-center mb-4">Client List</h2>

        @if(count($clients) > 0)
            <div class="row">
                @foreach($clients as $client)
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Name: {{ $client->name }}</h5>

                                @if($client->status == 'approve')
                                    <p class="card-text text-success">Status : <strong>Approve</strong></p>
                                @elseif($client->status == 'notify')
                                    <p class="card-text text-warning">Status : <strong>Notify</strong></p>
                                @elseif($client->status == 'delete')
                                    <p class="card-text text-danger">Status : <strong>Deleted</strong></p>
                                @else
                                    <p class="card-text text-muted">Unknown Status</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <a class="btn btn-secondary" href="{{ route('clients.create') }}">Add Client</a>
        @else
            <p class="text-center">No clients found.</p>
        @endif
    </div>
 


</body>
</html>
