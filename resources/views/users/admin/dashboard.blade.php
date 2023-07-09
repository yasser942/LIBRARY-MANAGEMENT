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
                  @auth


                  <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 active">
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
                        <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                            <a class="nav-link" href="{{route('chatify',auth()->user()->id)}}"><h5>Chat Members</h5></a>
                        </li>


                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                       <a class="nav-link" href="{{route('admin.registeredusers')}}"><h5>Members List</h5></a>
                   </li>
                   @else


                  <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                    <a class="nav-link" href="/login"><h5>Login/SignUp</h5></a>
                  </li>
                  @endauth
                  @auth


                  @if ( auth()->user()->role == 'admin')

                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                    <a
                      class="nav-link dropdown-toggle"
                      data-toggle="dropdown"
                      href="#"
                      role="button"
                      aria-haspopup="true"
                      aria-expanded="false"
                      ><h5>Manage Books/Shelf</h5>
                    </a>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="{{route('admin.add_book')}}"><h5>Add Book</h5></a>
                      <a class="dropdown-item" href="{{route('admin.book_show')}}"><h5>Books Detail</h5></a>
                      <a class="dropdown-item" href="#"><h5>Onhold Detail</h5></a>
                        <a class="dropdown-item" href="{{route('admin.borrowed-books')}}"><h5>Borrow Detail</h5></a>
                        <a class="dropdown-item" href="{{route('shelves.index')}}"><h5>View Shelf</h5></a>
                      <a class="dropdown-item" href="/edit_shelf"><h5>Edit Shelf</h5></a>
                        <a class="dropdown-item" href="/return_book"><h5>Return Book</h5></a>
                    </div>
                  </li>
                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                        <a class="nav-link" href="{{route('fines')}}"><h5>Manage Fines</h5></a>
                     </li>
                     @endif
                     @endauth

                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                        <a class="nav-link" href="/books"><h5>Books</h5></a>
                     </li>

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

    <div class="container">
        <div class="row home_img">
            <div class="col-lg-7 col-md-7 col-sm-12">
                <div class="card" >
                  <img src="{{ asset('images/bglib-dashboard.png') }}" />

                </div>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-12">
                <div class="card txt" >
                    <h1>WELCOME  TO  DASHBOARD</h1>
                    <h4>Librarian can add/delete/view/issue books, manage fines and edit shelf.</h4>
                    <h5>*****</h5>
                </div>

            </div>

            <div class="row mt-5">
                <div class="col-md-3">
                    <div class="circular-progress" id="user-progress">
                        <span class="progress-value">0</span>
                    </div>
                    <h1 class="card txt">Total Users</h1>
                </div>
                <div class="col-md-3">
                    <div class="circular-progress" id="book-progress">
                        <span class="progress-value">0</span>
                    </div>
                    <h1 class="card txt">Total Distinct Books</h1>
                </div>
                <div class="col-md-3">
                    <div class="circular-progress" id="available-progress">
                        <span class="progress-value">0</span>
                    </div>
                    <h1 class="card txt">Available Books</h1>
                </div>
                <div class="col-md-3">
                    <div class="circular-progress" id="borrowed-progress">
                        <span class="progress-value">0</span>
                    </div>
                    <h1 class="card txt">Borrowed Books</h1>
                </div>

                <div class="col-md-3  mt-5">
                    <div class="circular-progress" id="Shelf_1">
                        <span class="progress-value">0</span>
                    </div>
                    <h1 class="card txt">Shelf 1</h1>
                </div>
                <div class="col-md-3  mt-5">
                    <div class="circular-progress" id="Shelf_2">
                        <span class="progress-value">0</span>
                    </div>
                    <h1 class="card txt">Shelf 2</h1>
                </div>
                <div class="col-md-3  mt-5">
                    <div class="circular-progress" id="Shelf_3">
                        <span class="progress-value">0</span>
                    </div>
                    <h1 class="card txt">Shelf 3</h1>
                </div>
                <div class="col-md-3  mt-5">
                    <div class="circular-progress" id="Shelf_4">
                        <span class="progress-value">0</span>
                    </div>
                    <h1 class="card txt">Shelf 4</h1>
                </div>



            </div>
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

    <script>
        var users = {{$userCount}};
        var books = {{$bookCount}};
        var available_books = {{$availableBooksCount}};
        var borrowed_books = {{$borrowedBooksCount}};

        var shelves = [
            @foreach ($shelves as $shelf)
        {
            name: "{{ $shelf->name }}",
            totalBooks: {{$shelf->occupied_count}},
            capacity: {{ $shelf->capacity }},
            availableSpace: {{ $shelf->capacity - $shelf->books_count }}
        },
        @endforeach
    ];
    </script>
    <script src="{{asset('js/script.js')}}"></script>
  </body>
</html>
