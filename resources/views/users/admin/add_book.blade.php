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

                  @if (auth()->user()->role=='admin')
                  <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                    <a class="nav-link" href="{{route('admin.dashboard')}}"><h5>Dashboard</h5></a>
                 </li>
                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                    <a class="nav-link" href="{{route('books.index')}}"><h5>Books</h5></a>
                  </li>
                  @else
                  <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                    <a class="nav-link" href="{{route('books.index')}}"><h5>Books</h5></a>
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

        <div class="col-md-5 pr-lg-5 mb-5 mb-md-0">
          <img src="{{ asset('images/i1.png') }}" alt="" class="img-fluid mb-3 d-none d-md-block" />
          <h1>Adding Book</h1>
        </div>

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
          <form action="{{route('admin.storeBook')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">

              <!-- Title -->
              <div class="input-group col-lg-6 mb-4">
                <div class="input-group-prepend">
                  <span
                    class="input-group-text bg-white px-4 border-md border-right-0"
                  >
                    <i class="fa fa-address-book" aria-hidden="true"></i>
                  </span>
                </div>
                <input
                  id="title"
                  type="text"
                  name="title"
                  placeholder="Title"
                  class="form-control bg-white border-left-0 border-md"
                  value="{{old('title')}}"
                  required
                />
              </div>

              <!-- Author -->
              <div class="input-group col-lg-6 mb-4">
                <div class="input-group-prepend">
                  <span
                    class="input-group-text bg-white px-4 border-md border-right-0"
                  >
                    <i class="fa fa-address-book" aria-hidden="true"></i>
                  </span>
                </div>
                <input
                  id="author"
                  type="text"
                  name="author"
                  placeholder="Author"
                  class="form-control bg-white border-left-0 border-md"
                  value="{{old('author')}}"
                  required
                />
              </div>

              <!-- Category -->
              <div class="input-group col-lg-12 mb-4">
                <div class="input-group-prepend">
                  <span
                    class="input-group-text bg-white px-4 border-md border-right-0"
                  >
                    <i class="fa fa-address-book" aria-hidden="true"></i>
                  </span>
                </div>
                <input
                  id="category"
                  type="text"
                  name="category"
                  placeholder="Category"
                  class="form-control bg-white border-left-0 border-md"
                  value="{{old('category')}}"
                  required
                />
              </div>

              <!-- Isbn Number -->
              <div class="input-group col-lg-12 mb-4">
                <div class="input-group-prepend">
                  <span
                    class="input-group-text bg-white px-4 border-md border-right-0"
                  >
                    <i class="fa fa-list-ol" aria-hidden="true"></i>
                  </span>
                </div>

                <input
                  id="isbn"
                  type="number"
                  name="isbn"
                  placeholder="ISBN"
                  class="form-control bg-white border-md border-left-0 pl-3"
                  value="{{old('isbn')}}"
                  required
                />
              </div>

              <!-- Year -->
              <div class="input-group col-lg-12 mb-4">
                <div class="input-group-prepend">
                  <span
                    class="input-group-text bg-white px-4 border-md border-right-0"
                  >
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                  </span>
                </div>

                <input
                  id="year"
                  type="number"
                  name="year"
                  placeholder="Publication Year"
                  class="form-control bg-white border-md border-left-0 pl-3"
                  value="{{old('year')}}"
                  required
                />
              </div>




              <!-- Image -->
              <div class="input-group col-lg-12 mb-4">
                  <label for="image">Upload Image:</label>
              <input  type="file" id="file" name="image" placeholder="Image" >

              </div>
                <!-- PDF -->
                <div class="input-group col-lg-12 mb-4">

                    <label for="pdf_file">Upload PDF:</label>
                    <input type="file" name="pdf_file" id="pdf_file">

                </div>
              <!-- Submit Button -->
              <div class="form-group col-lg-12 mx-auto mb-0">
                <button class="btn btn-block py-2">
                  <span class="font-weight-bold">Add Book</span>
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
