<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>







    <div class="container">
        <h2>Create Todo</h2>

        @if ($errors->any())

            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form action="{{ url('Todo') }}" method="post" enctype="multipart/form-data">

            @csrf


            <div class="form-group">
                <label for="exampleInputName">Title</label>
                <input type="text" class="form-control" id="exampleInputName" aria-describedby="" name="title"
                    placeholder="Enter Title" value="{{ old('title') }}">
            </div>


            <div class="form-group">
                <label for="exampleInputEmail">Content</label>
                <textarea name="content" class="form-control" id="" cols="30" rows="10" >  {{old('content')}}  </textarea>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword">Image</label>
                <input type="file"id="exampleInputPassword1" name="image">
            </div>


            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>


    <br>






</body>

</html>
