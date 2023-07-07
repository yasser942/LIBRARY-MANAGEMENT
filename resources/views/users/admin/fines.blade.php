<!DOCTYPE html>

<html>
  <head>
    <title>LMS</title>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, user-scalable=no"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
      <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
      <link rel="stylesheet" href="{{ asset('css/add_book.css') }}" />
  </head>
  <body>
    <div class="navigation-wrap bg-light start-header start-style">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <nav class="navbar navbar-expand-md navbar-light">
              <a
                class="navbar-brand"
                href="/"
                target="_blank"
                ><h1><i class="fa fa-book"></i> LMS</h1></a>

              <button
                class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation"
              >
                <span class="navbar-toggler-icon"></span>
              </button>

              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto py-4 py-md-0">
                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 active">
                        @auth()
                            <a
                                class="nav-link dropdown-toggle"
                                data-toggle="dropdown"
                                href="#"
                                role="button"
                                aria-haspopup="true"
                                aria-expanded="false"
                            ><h5>Profile</h5></a
                            >
                            <div class="dropdown-menu">
                                <a class="dropdown-item"><h5>{{ auth()->user()->name }}</h5></a>
                                <a class="dropdown-item"><h5>{{ auth()->user()->email }}</h5></a>
                                <a class="dropdown-item" href="{{ route('users.edit', auth()->user()->id) }}"><h5>Update Profile</h5></a>
                                <form action="{{ route('users.logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item" style="cursor: pointer;">
                                        <h5>Logout</h5>
                                    </button>
                                </form>
                            </div>
                    </li>

                    @if(auth()->user()->role=='admin')
                        <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                            <a class="nav-link" href="{{route('admin.dashboard')}}"><h5>Dashboard</h5></a>
                        </li>
                    @endif

                    @else
                        <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                            <a class="nav-link" href="/login"><h5>Login/SignUp</h5></a>
                        </li>

                    @endauth

                </ul>
              </div>
            </nav>
          </div>
        </div>
      </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>

    <div class = "container" >
        <h1>Unpaid Fines </h1>

            @if(count($usersWithFines)!==0)

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">User</th>
                        <th scope="col">Fines</th>
                        <th scope="col">Total Fine</th>
                        <th scope="col">Action</th>


                    </tr>
                    </thead>
                    <tbody>
                    @foreach($usersWithFines as $user)

                        <tr>
                            <td> {{$user->id}} </td>
                            <td>{{$user->name}} </td>
                            <td> {{$user->totalFine }} </td>
                            <td>
                                <form action="{{ route('admin.deleteFines', $user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete Fines</button>
                                </form>
                            </td>

                        </tr>
                    @endforeach



                    </tbody>
                </table>
            </div>
        @else
            <p><h2>No Books Borrowed Yet</h2></p>
            @endif



    </div>



  @include('components.footer')



    <script
      src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
      integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
      crossorigin="anonymous"
    ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
      integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
      integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
      crossorigin="anonymous"
    ></script>
  </body>
</html>

