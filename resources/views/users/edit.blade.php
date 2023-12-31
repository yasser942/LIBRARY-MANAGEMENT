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
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />

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
                    @auth
                    @if ( auth()->user()->role == 'admin')
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
    <div class="container">
      <div class="row py-5 mt-4 align-items-center">
        <!-- For Demo Purpose -->
        <div class="col-md-5 pr-lg-5 mb-5 mb-md-0">
          <img
            src="{{ asset('images\login.png')}}"
            alt=""
            class="img-fluid mb-3 d-none d-md-block"
          />
          <h1>Update Profile</h1>
        </div>

        <!-- Update Profile Form -->
        <div class="col-md-7 col-lg-6 ml-auto">
          @if($errors->any())

          <div>
              <ul>
                  @foreach ($errors->all() as $error)
                  <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
                    <strong>{{ $error }}</strong>
                  </div>

                  @endforeach
              </ul>
          </div>
      @endif

          <form action="{{route('users.update',auth()->user()->id)}}" method="post">
            @csrf
            @method('PUT')
            <div class="row">

              <!-- Name -->
              <div class="input-group col-lg-6 mb-4">
                <div class="input-group-prepend">
                  <span
                    class="input-group-text bg-white px-4 border-md border-right-0"
                  >
                    <i class="fa fa-user text-muted"></i>
                  </span>
                </div>
                <input
                  id="name"
                  type="text"
                  name="name"
                  placeholder="Name"
                  required
                  class="form-control bg-white border-left-0 border-md"
                  value="{{auth()->user()->name}}"
                />
              </div>

                <!-- Address -->
              <div class="input-group col-lg-6 mb-4">
                <div class="input-group-prepend">
                  <span
                    class="input-group-text bg-white px-4 border-md border-right-0"
                  >
                    <i class="fa fa-address-card text-muted"></i>
                  </span>
                </div>
                <input
                  id="address"
                  type="text"
                  name="address"
                  placeholder="Address"
                  required
                  class="form-control bg-white border-left-0 border-md"
                  value="{{auth()->user()->address}}"

                />
              </div>

              <!-- Email Address -->
              <div class="input-group col-lg-12 mb-4">
                <div class="input-group-prepend">
                  <span
                    class="input-group-text bg-white px-4 border-md border-right-0"
                  >
                    <i class="fa fa-envelope text-muted"></i>
                  </span>
                </div>
                <input
                  id="email"
                  type="email"
                  name="email"
                  placeholder="Email Address"
                  required
                  class="form-control bg-white border-left-0 border-md"
                  value="{{auth()->user()->email}}"
                />

              </div>


              <!-- Password -->
              <div class="input-group col-lg-6 mb-4">
                <div class="input-group-prepend">
                  <span
                    class="input-group-text bg-white px-4 border-md border-right-0"
                  >
                    <i class="fa fa-lock text-muted"></i>
                  </span>
                </div>
                <input
                  id="password"
                  type="password"
                  name="password"
                  placeholder="Password"
                  required
                  class="form-control bg-white border-left-0 border-md"
                />
              </div>

                <!--Confirm Password -->
              <div class="input-group col-lg-6 mb-4">
                <div class="input-group-prepend">
                  <span
                    class="input-group-text bg-white px-4 border-md border-right-0"
                  >
                    <i class="fa fa-lock text-muted"></i>
                  </span>
                </div>
                <input
                  id="password_confirmation"
                  type="password"
                  name="password_confirmation"
                  placeholder="Confirm Password"
                  required
                  class="form-control bg-white border-left-0 border-md"
                />
              </div>

              <!-- Submit Button -->
              <div class="form-group col-lg-12 mx-auto mb-0">
                <button type="submit" class="btn btn-primary btn-block py-2">
                  <span class="font-weight-bold">Update Profile</span>
                </button>
              </div>


            </div>
          </form>
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
  </body>
</html>
