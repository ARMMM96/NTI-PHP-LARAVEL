<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>







    <div class="container">
        <h2>Edit Todo</h2>

        @if ($errors->any())

            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form action="{{ url('Todo/'.$data->id) }}" method="post" enctype="multipart/form-data">

            @csrf
            @method("put")


            <div class="form-group">
                <label for="exampleInputName">Title</label>
                <input type="text" class="form-control" id="exampleInputName" aria-describedby="" name="title"
                    placeholder="Enter Title" value="{{ $data->title }}">
            </div>


            <div class="form-group">
                <label for="exampleInputEmail">Content</label>
                <textarea name="content" class="form-control" id="" cols="30"
                    rows="10">  {{ $data->content }}  </textarea>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword">Image</label>
                <input type="file" id="exampleInputPassword1" name="image">
            </div>
            <p>

                <img src="{{ url('/todoImages/' . $data->image) }}" alt="" width="200" height="200">

            </p>


            <button type="submit" class="btn btn-primary">Edit</button>
        </form>
    </div>


    <br>






</body>

</html>
