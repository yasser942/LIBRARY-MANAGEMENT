<!DOCTYPE html>

<html lang="en">
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
  <div>
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
                            <a class="nav-link" href="{{route('user.dashboard')}}"><h5>Dashboard</h5></a>
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
         <div class="table-responsive">
                @auth
                    @if (auth()->user()->role=='admin')
                    <table class="table table-hover">

                      <thead>
                      <tr>
                        <th scope="col">U_ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Address</th>
                        <th scope="col">Unpaid Fines</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                       @if (auth()->user()->id !=$user->id)
                       <tr onclick="window.location='{{ route('fines', $user) }}';" style="cursor: pointer;">
                        <td> {{$user->id}}</td>
                        <td> {{$user->name}} </td>
                        <td> {{$user->email}} </td>
                        <td>{{ $user->address}} </td>
                        <td> {{$user->fines_count}} </td>
                        </tr>
                       @endif
                    @endforeach
                  </table>
                    @else
                    <table class="table table-hover">

                      <thead>
                      <tr>

                        <th scope="col">Name</th>
                        <th scope="col">Follower/Following</th>

                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                       @if (auth()->user()->id !=$user->id)
                       <tr>

                        <td> {{$user->name}} </td>
                        <td>



                               @if (Auth::check())
                                   @if (Auth::user()->follows->contains($user))
                                       <form action="{{ route('user.unfollow', $user) }}" method="POST">
                                           @csrf
                                           @method('POST')
                                           <button type="submit" class="btn btn-danger btn-rounded btn-sm m-0">Unfollow</button>
                                       </form>
                                   @else
                                       <form action="{{ route('user.follow', $user) }}" method="POST">
                                           @csrf
                                           <button type="submit" class="btn btn-primary btn-rounded btn-sm m-0">Follow</button>
                                       </form>
                                   @endif
                               @endif


                           </td>


                        </tr>
                       @endif
                    @endforeach
                  </table>
                    @endif
                @endauth
            </div>
    </div>
  </div>

  <!--footer-->
    <footer class="footer" id="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <h3><i class="fa fa-book"></i> LMS</h3>
                <br>

                <ul class="nav">
                    <li class="nav-item"><a href="" class="nav-link pl-0"><i class="fa fa-facebook fa-lg"></i></a></li>
                    <li class="nav-item"><a href="" class="nav-link"><i class="fa fa-twitter fa-lg"></i></a></li>
                    <li class="nav-item"><a href="" class="nav-link"><i class="fa fa-github fa-lg"></i></a></li>
                    <li class="nav-item"><a href="" class="nav-link"><i class="fa fa-instagram fa-lg"></i></a></li>
                </ul>
                <br>
            </div>
            <div class="col-md-2">
                <h5 class="text-md-right">Contact Us</h5>
                <hr>
            </div>
            <div class="col-md-5">
                <form>
                    <fieldset class="form-group">
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                    </fieldset>
                    <fieldset class="form-group">
                        <textarea class="form-control" id="exampleMessage" placeholder="Message"></textarea>
                    </fieldset>
                    <fieldset class="form-group text-xs-right">
                        <button type="button" class="btn btn-primary btn-lg">Send</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    </footer>

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
