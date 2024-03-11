<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Parser for csv</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <style>
            
        </style>
    </head>
    <body>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        <div class="container text-center">
            <form action="{{ route('uploadFile') }}" method="post" enctype="multipart/form-data">
                @method('post')
                @csrf
            <div class="mb-3">
                <label for="formFile" class="form-label">Import file in database</label>
                <input class="form-control" type="file" id="formFile" name="csv_file" accept=".csv">
            </div>
            <button class="btn btn-primary" type="submit">Import</button>
        </form>
        </div>

        <div class="container text-center pt-5">
            <form action="{{ route('exportFile') }}" method="post" enctype="multipart/form-data">
                @method('get')
                @csrf
            <div class="mb-3">
                <label for="formFile" class="form-label">Export file from database</label>
            </div>
            <button class="btn btn-primary" type="submit">Export</button>
        </form>
        </div>

        <div class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  @if(session('success'))
                  <h5 class="modal-title" id="exampleModalLabel">CSV is being processed...</h5>
                  @endif
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
    </body>
</html>

@if(!empty(session('success')) && session('success') === 1)
<script type="text/javascript">
window.onload = function() {
    $('#exampleModal').modal('show');
}
</script>
@endif
