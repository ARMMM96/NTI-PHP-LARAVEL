<!DOCTYPE html>
<html>

<head>
    <title>PDO - Read Records - PHP CRUD Tutorial</title>

    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />

    <!-- custom css -->
    <style>
        .m-r-1em {
            margin-right: 1em;
        }

        .m-b-1em {
            margin-bottom: 1em;
        }

        .m-l-1em {
            margin-left: 1em;
        }

        .mt0 {
            margin-top: 0;
        }

    </style>

</head>

<body>

    <!-- container -->
    <div class="container">


        <div class="page-header">
            <h1>Read Todos </h1>      {{  "Welcome , ".auth()->user()->name  }}
            <br>

          @php

            // dd(session()->has('test'));

            echo session()->get('Message');
          @endphp

            <br>



        </div>

        <a href="{{url('/Todo/create')}}">+ Todo</a>   ||     <a href="{{url('/Student/LogOut')}}">+ LogOut</a>

        <table class='table table-hover table-responsive table-bordered'>
            <!-- creating our table heading -->
            <tr>
                <th>ID</th>
                <th>title</th>
                <th>Content</th>
                <th>Image</th>
                <th>AddedBy</th>
                <th>Show Details</th>
                <th>action</th>
            </tr>


        @foreach ($data as $value )


            <tr>
                <td>{{ $value->id}}</td>
                <td>{{ $value->title }}</td>
                <td>{{ substr($value->content,0,50)}}</td>

                <td><img src="{{url('/todoImages/'.$value->image)}}" alt=""  width="50" height="50"></td>
                <td>{{$value->userName}}</td>

               <td> <a href='{{url('/Todo/'.$value->id)}}' class='btn btn-primary m-r-1em'>Show</a></td>


                <td>
                    <a href='' data-toggle="modal" data-target="#modal_single_del{{ $value->id}}" class='btn btn-danger m-r-1em'>Remove </a>
                    <a href='{{url('/Todo/'.$value->id.'/edit')}}' class='btn btn-primary m-r-1em'>Edit</a>
                </td>
            </tr>




            <div class="modal" id="modal_single_del{{ $value->id}}" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">delete confirmation</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                       </button>
                        </div>

                        <div class="modal-body">
                          Remove   {{$value->title}} !!!!
                        </div>
                        <div class="modal-footer">
                            <form action="{{url('/Todo/'.$value->id)}}" method="post">

                                @csrf
                                @method('delete')

                                <div class="not-empty-record">
                                    <button type="submit" class="btn btn-primary">Delete</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>




       @endforeach

            <!-- end table -->
        </table>

    </div>
    <!-- end .container -->


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <!-- Latest compiled and minified Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- confirm delete record will be here -->

</body>

</html>
