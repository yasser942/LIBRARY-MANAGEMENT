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

    <link rel="stylesheet" href="css\style.css" />


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
                      <a class="dropdown-item" href="#"><h5>username</h5></a>
                      <a class="dropdown-item" href="#"><h5>email</h5></a>
                        <a class="dropdown-item" href="#"><h5>Update Profile</h5></a>
                      <a class="dropdown-item" href="#"><h5>Logout</h5></a>
                    </div>
                  </li>
                  <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                    <a class="nav-link" href="/login"><h5>Login/SignUp</h5></a>
                  </li>
                  

                     <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                        <a class="nav-link" href="/lib_dashboard"><h5>Dashboard</h5></a>
                     </li>
                    
                   
                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                        <a class="nav-link" href="/user_dashboard"><h5>Dashboard</h5></a>
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
    <h1>History</h1>
    <div class="container-fluid" id="s">
     <div class="slider owl-carousel">
         @foreach ($books as $book)
           @if ($book->category=='history')
           <div class="card">
             <div class="img">
             <img src="Uploads\cover.jpg" alt=""></div>
             <div class="content">
             <div class="title">
             {{$book->title}}</div>
             <div class="sub-title">
             By:  {{$book->author}}</div>
             <p>Publication Year:  {{$book->year}}</p>
                
             <div class="btn">
                 <a href="#"><button>On Hold</button></a>
             
                 <a href="#"><button>Borrow</button></a>
            
             </div>
                
             </div>
             </div>
           @endif
         @endforeach
     </div>
    </div>
 
     <hr class="dotted">
    
    <h1>Novels</h1>
   <div class="container-fluid" id="s">
    <div class="slider owl-carousel">
        @foreach ($books as $book)
          @if ($book->category=='novels')
          <div class="card">
            <div class="img">
            <img src="Uploads\cover.jpg" alt=""></div>
            <div class="content">
            <div class="title">
            {{$book->title}}</div>
            <div class="sub-title">
            By:  {{$book->author}}</div>
            <p>Publication Year:  {{$book->year}}</p>
               
            <div class="btn">
                <a href="#"><button>On Hold</button></a>
            
                <a href="#"><button>Borrow</button></a>
           
            </div>
               
            </div>
            </div>
          @endif
        @endforeach
    </div>
   </div>

    <hr class="dotted">
   
    <h1>Sport</h1>
    <div class="container-fluid" id="s">
     <div class="slider owl-carousel">
         @foreach ($books as $book)
           @if ($book->category=='sport')
           <div class="card">
             <div class="img">
             <img src="Uploads\cover.jpg" alt=""></div>
             <div class="content">
             <div class="title">
             {{$book->title}}</div>
             <div class="sub-title">
             By:  {{$book->author}}</div>
             <p>Publication Year:  {{$book->year}}</p>
                
             <div class="btn">
                 <a href="#"><button>On Hold</button></a>
             
                 <a href="#"><button>Borrow</button></a>
            
             </div>
                
             </div>
             </div>
           @endif
         @endforeach
     </div>
    </div>
 
     <hr class="dotted">
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
