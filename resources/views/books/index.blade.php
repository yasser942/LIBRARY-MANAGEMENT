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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">

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
                      <a class="dropdown-item" href="#">
                          <h5>{{ auth()->user()->name }}</h5>
                      </a>
                      <a class="dropdown-item" href="#">
                          <h5>{{ auth()->user()->email }}</h5>
                      </a>
                      <a class="dropdown-item" href="{{ route('users.edit', auth()->user()->id) }}"><h5>Update Profile</h5></a>

                      <form action="{{ route('users.logout') }}" method="POST">
                          @csrf
                          <button type="submit" class="dropdown-item" style="cursor: pointer;">
                              <h5>Logout</h5>
                          </button>
                      </form>
                  </div>

                    @endauth
                  </li>
                  @auth

              @else
                  <!-- User is not authenticated -->
                  <!-- Display the login/signup link -->
                  <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                      <a class="nav-link" href="{{ route('users.login') }}"><h5>Login/SignUp</h5></a>
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
                   <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                    <a class="nav-link" href="/"><h5>Home</h5></a>
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
    @if (session('success'))
    <div class="alert alert-info alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
      <strong>{{ session('success') }}</strong>
    </div>
   @endif

 <!-- search -->
 <div class = "container my-4">
  <div class="col-md-7 col-lg-8 mx-auto">
    <form action="{{route('bookss.search')}}" method="post">

        @csrf
          <div class="row">

          <!-- Book Name-->
              <div class="input-group col-lg-12 mb-4">
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
                value="{{ request('title') }}"
              />
            </div>

              <!-- Author -->

            <div class="input-group col-lg-12 mb-4">
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
                value="{{ request('author') }}"

              />
            </div>

                <!-- Category -->
            <div class="input-group col-lg-4 mb-4">
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
                value="{{ request('category') }}"

              />
            </div>

            <!-- Isbn Number -->
            <div class="input-group col-lg-4 mb-4">
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
                value="{{ request('isbn') }}"

              />


            </div>

             <!-- Isbn Number -->
             <div class="input-group col-lg-4 mb-4">
              <div class="input-group-prepend">
                <span
                  class="input-group-text bg-white px-4 border-md border-right-0"
                >
                  <i class="fa fa-list-ol" aria-hidden="true"></i>
                </span>
              </div>

              <input
              id="year"
              type="number"
              name="year"
              placeholder="YEAR"
              class="form-control bg-white border-md border-left-0 pl-3"
              value="{{ request('year') }}"

            />


            </div>




            <!-- Submit Button -->
            <div class="form-group col-lg-6 mx-auto mb-0">
              <button type="submit" class="btn btn-primary btn-block py-2">
                <span class="font-weight-bold">Search</span>
              </button>
            </div>

            <!-- Clear Button -->
            <div class="form-group col-lg-6 mx-auto mb-0">
              <button type="button" class="btn btn-secondary btn-block py-2" onclick="clearForm()">
                  <span class="font-weight-bold">Clear</span>
              </button>
            </div>

            <script>
              function clearForm() {
                  document.getElementById('title').value = '';
                  document.getElementById('author').value = '';
                  document.getElementById('category').value = '';
                  document.getElementById('isbn').value = '';
                  document.getElementById('year').value = '';
              }
            </script>
          </div>
      </form>
      </div>
   </div>

     @foreach ($categories as $category)
     <h1>{{ ucfirst($category) }} </h1>
     <div class="container-fluid" id="s">
         <div class="slider owl-carousel">
             @foreach ($books as $book)
                 @if ($book->category == $category)
                     <div class="card">
                      <div class="img">
                        @if ($book->image)
                            <img src="{{ Storage::url($book->image) }}" alt="">
                        @else
                            <img src="{{ asset('Uploads/cover.jpg') }}" alt="">
                        @endif
                    </div>
                         <div class="content">
                             <div class="title">
                                 {{ $book->title }}
                             </div>
                             <div class="sub-title">
                                 By: {{ $book->author }}
                             </div>
                             <p>Publication Year: {{ $book->year }}</p>

                             @auth

                             @if (auth()->user()->role == 'admin')
                             <div class="btn">
                              <div class="btn-group">
                                  <a href="{{route('admin.edit_book_form',['book' => $book->id, 'redirect_url' => url()->current()])}}" class="btn-edit"><button>Edit</button></a>
                                  <form action="{{route('admin.removeBook',$book->id)}}" method="post" >
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="redirect_url" value="{{ url()->current() }}">
                                      <a ><button type="submit">Delete</button></a>

                                  </form>
                              </div>
                          </div>

                             @else
                                     <div class="btn">
                                         <div class="btn-group">
                                             @if (auth()->check() && auth()->user()->role === 'user')
                                                 @if (!$book->borrows()->where('user_id', auth()->user()->id)->exists())
                                                     @if ($book->count > 0)
                                                         <form action="{{ route('borrow', $book) }}" method="POST">
                                                             @csrf
                                                             <button type="submit">Borrow</button>
                                                         </form>
                                                     @else
                                                         <button disabled>Not Available</button>
                                                     @endif
                                                 @else
                                                     <button disabled>Already Borrowed</button>
                                                 @endif
                                             @endif
                                         </div>
                                     </div>

                             @endif

                             @endauth

                         </div>
                     </div>
                 @endif
             @endforeach
         </div>
     </div>
     <hr class="dotted">
 @endforeach




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


  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script>
      $(".slider").owlCarousel({
        loop: true,
        autoplay: true,
        autoplayTimeout: 2000, //2000ms = 2s;
        autoplayHoverPause: true,
      });
    </script>

  </body>
</html>
