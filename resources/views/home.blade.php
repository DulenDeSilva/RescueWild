<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" ></script>
    <link rel ="stylesheet" href="{{asset('styles.css')}}">
    <link rel="shortcut icon" href="letter-r (1).png " type="image/x-icon">
    <title>Rescuewild.lk</title>

</head>

<body>
dd(Auth::user())
    <nav class="navbar navbar-expand-sm fixed-top">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">RescueWild.lk</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
              <h5 class="offcanvas-title" id="offcanvasNavbarLabel">RescueWild.lk</h5>
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
              <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                <li class="nav-item">
                  <a class="nav-link mx-lg-2" href="#">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link mx-lg-2" href="about-us">About Us</a>
                </li>
                 <li class="nav-item">
                    <a class="nav-link mx-lg-2" href="{{route('login')}}">Sign in</a>
                 </li>
                 <li class="nav-item">
                  <a class="nav-link mx-lg-2" href="{{route('register')}}">Register</a>
               </li>
              </ul> 
            </div>
          </div>
        </div>
      </nav>
        <div class="container-fluid content animated-img hero-section">
          <h1>WELCOME TO RESCUEWILD.LK</h1>
          <p>We are here to ensure their lives</p>
        </div>
       
      <div class="container-fluid mt-5 pt-5 custom-container section-block" id="about-us">
        <div class="row mt-5">
          <div class="col-md-6">
            <img src="collage.jpg" class="img-fluid custom-img animated-img" alt="Responsive image">
          </div>
          <div class="col-md-6 d-flex flex-column align-items-start justify-content-center animated-img">
            <p class="welcome-text">ABOUT US...</p>
            <br>
              <p class="welcome-description">This is an online platform with hundreds of volunteer
                                      animal rescuers.We rescue them, medicate them, and release
                                      them to suitable habitats.
              </p>
            <br>
          </div>
        </div>
      </div>
      <div class="container-fluid mt-5 pb-5 section-block" id="video-slider">
    <h2 class="text-center mb-4 text-white">Our Rescue Stories</h2>
    <div id="videoCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <!-- Video 1 -->
            <div class="carousel-item active">
                <div class="d-flex justify-content-center">
                    <video class="w-75" controls>
                        <source src="rescuevideo3.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
            <!-- Video 2 -->
            <div class="carousel-item">
                <div class="d-flex justify-content-center">
                    <video class="w-75" controls>
                        <source src="rescuevideo2.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
            <!-- Video 3 -->
            <div class="carousel-item">
                <div class="d-flex justify-content-center">
                    <video class="w-75" controls>
                        <source src="rescuevideo.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
            <!-- Video 4 -->
            <div class="carousel-item">
                <div class="d-flex justify-content-center">
                    <video class="w-75" controls>
                        <source src="rescuevideo4.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
        </div>
        <!-- Carousel Controls -->
        <button class="carousel-control-prev custom-control" type="button" data-bs-target="#videoCarousel" data-bs-slide="prev">
            <span class="control-symbol">&lt;</span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next custom-control" type="button" data-bs-target="#videoCarousel" data-bs-slide="next">
            <span class="control-symbol">&gt;</span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
      <div class="container-fluid mt-5 home-cards section-block">
        <div class="row">
          <div class="col-md-4">
            <div class="card">
              <img src="WhatsApp Image 2024-07-28 at 03.11.51_9bc8acb1.jpg" class="card-img-top">
              <div class="card-body">
                <h5 class="card-title">We rescue them</h5>
                <p class="card-text">Our islandwide rescuer network is always here to help animals.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card">
              <img src="HermanceAlison_IMG_8104.jpg" class="card-img-top" >
              <div class="card-body">
                <h5 class="card-title">We give treatments for them</h5>
                <p class="card-text">We diagnose the rescued animals and give treatments if their are any injuries.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card">
              <img src="sharonowlrelease-may2017-byartpelham-crop.jpg" class="card-img-top" >
              <div class="card-body">
                <h5 class="card-title">We release them to suitable environments</h5>
                <p class="card-text">We released the rescued animals to new suitable habitats.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer text-center fade-in" >
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>Contact Us</h5>
                    <p> 262/G3,Bauddaloka Mawatha,Colombo 07, Sri Lanka</p>
                    <p> +94 71 532 2629</p>
                    <p> info@rescuewild.com</p>
                </div>
                <div class="col-md-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Add a Complaint</a></li>
                        <li><a href="#">Sign in</a></li>
                        <li><a href="#">Sign out</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Follow Us</h5>
                    <div class="social-icons">
                        <a href="#"><img src="facebook (2).png" alt="Facebook" class="img-fluid" style="width: 24px; height: 24px;"></a>
                        <a href="#"><img src="twitter.png" alt="Twitter" class="img-fluid" style="width: 24px; height: 24px;"></a>
                        <a href="#"><img src="linkedin.png" alt="LinkedIn" class="img-fluid" style="width: 24px; height: 24px;"></a>
                        <a href="#"><img src="instagram (2).png" alt="Instagram" class="img-fluid" style="width: 24px; height: 24px;"></a>
                    </div>
                </div>
            </div>
            <p class="mt-4">&copy; 2024 RescueWild. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
