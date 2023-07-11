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

                    @auth
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
                      <a class="dropdown-item"><h5>{{auth()->user()->name}}</h5></a>
                      <a class="dropdown-item"><h5>{{auth()->user()->email}}</h5></a>
                      <a class="dropdown-item" href="{{ route('users.edit', auth()->user()->id) }}"><h5>Update Profile</h5></a>
                         <form action="{{ route('users.logout') }}" method="POST">
                          @csrf
                          <button type="submit" class="dropdown-item" style="cursor: pointer;">
                              <h5>Logout</h5>
                          </button>
                      </form>
                    </div>
                  </li>
                        @else

                        <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                          <a class="nav-link" href="/login"><h5>Login/SignUp</h5></a>
                        </li>
                    @endauth

                    @auth
                    @if (auth()->user()->role == 'admin')
                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                     <a class="nav-link" href="{{route('admin.dashboard')}}"><h5>Dashboard</h5></a>
                  </li>



                    @else
                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                     <a class="nav-link" href="/user_dashboard"><h5>Dashboard</h5></a>
                  </li>
                    @endif
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
         <div class="table-responsive scrollable-table">
                <table class="table table-hover">

                    <thead>
                    <tr>
                      <th scope="col">book_id</th>
                      <th scope="col">ISBN</th>
                      <th scope="col">title</th>
                      <th scope="col">author</th>
                      <th scope="col">Year of publication</th>
                      <th scope="col">shelf_Id</th>
                      <th scope="col">count</th>
                      <th scope="col">Borrow Count</th>
                      <th scope="col">Category</th>
                      <th scope="col">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($books as $book)
                  <tr>
                  <td> {{ $book->id}} </td>
                  <td> {{ $book->isbn}} </td>
                  <td> {{ $book->title}} </td>
                  <td> {{ $book->author}} </td>
                  <td> {{ $book->year}} </td>
                  <td> {{ $book->shelf_id}} </td>
                  <td> {{ $book->count}} </td>
                  <td> {{$book->borrows_count }} </td>
                  <td> {{ $book->category}} </td>
                  <td>
                    <div class="d-flex">
                      <a href="{{route('admin.edit_book_form',$book->id)}}" class="btn btn-primary mr-2">Edit</a>
                      <form action="{{route('admin.removeBook',$book->id)}}" method="POST">
                          @csrf
                          @method('DELETE')
                          <input type="hidden" name="redirect_url" value="{{ url()->current() }}">
                          <button type="submit" class="btn btn-danger">Delete</button>
                      </form>
                  </div>
                </td>
                  </tr>
                  @endforeach



                  </tbody>


                </table>
            </div>
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
