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
                @error('csv_file')
                    <p class="text-danger">{{ $message }}</p>
                @enderror    
            </div>
            <button class="btn btn-primary" type="submit">Import</button>
        </form>
        </div>

        <div class="container text-center pt-5">
            <form action="{{ route('exportFile') }}" method="post" enctype="multipart/form-data">
                @method('get')
                @csrf
            <div class="mb-3">
                <label for="ExpFile" class="form-label">Export file from database</label>
            </div>
            <button class="btn btn-primary" type="submit" id="ExpFile">Export</button>
        </form>
        </div>

        {{-- it fields havn't work yet --}}
        <div class="container text-center pt-5 d-none">
            <form action="{{ route('file.edit') }}" method="post">
                @method('patch')
                @csrf
                <div class="mb-3">
                      <label for="update" class="form-label">Edit data</label>
                </div>
                <div class="py-1">
                    <input type="number" id="resident_id" name="resident_id" placeholder="ID">
                    <input type="text" id="name" name="name" placeholder="name">
                    <input type="text" id="last_name" name="last_name" placeholder="last_name">
                    <input type="number" id="age" name="age" placeholder="age">
                    <input type="text" id="street" name="street" placeholder="street">
                    <input type="text" id="house" name="house" placeholder="house">
                    <input type="text" id="city" name="city" placeholder="city">
                    <input type="text" id="state" name="state" placeholder="state">
                    <input type="text" id="zip" name="zip" placeholder="zip">
                    <input type="text" id="currency" name="currency" placeholder="currency">
                    <input type="text" id="housecolor" name="housecolor" placeholder="housecolor">
                    <input type="date" id="date" name="date">
                </div>
                <button class="btn btn-primary" type="submit" id="update">Update</button>
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


<script type="text/javascript">
window.onload = function() {
    @if(!empty(session('success')) && session('success') === 1)
    $('#exampleModal').modal('show');
    @endif
}
</script>

