@extends('layouts.app')

@section('content')
    <div id="page-container">
        <!-- Site Header -->
        <header>
            <div class="container">
                <!-- Site Logo -->
                <a href="index.html" class="site-logo">
                    <i class="gi gi-flash"></i> <strong>Pro</strong>UI
                </a>
                <div class="pull-left form-search">
                    <form action="features.html" method="post" class="form-horizontal" onsubmit="return false;">
                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="sr-only" for="register-email">Your Email</label>
                                <div class="input-group form-group input-group-lg">
                                    <input type="email" id="register-email" name="register-email" class="form-control" placeholder="Your Email..">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Site Logo -->

                <!-- Site Navigation -->
                <nav>
                    <!-- Menu Toggle -->
                    <!-- Toggles menu on small screens -->
                    <a href="javascript:void(0)" class="btn btn-default site-menu-toggle visible-xs visible-sm">
                        <i class="fa fa-bars"></i>
                    </a>
                    <!-- END Menu Toggle -->

                    <!-- Main Menu -->
                    <ul class="site-nav">
                        <!-- Toggles menu on small screens -->
                        <li class="visible-xs visible-sm">
                            <a href="javascript:void(0)" class="site-menu-toggle text-center">
                                <i class="fa fa-times"></i>
                            </a>
                        </li>
                        <!-- END Menu Toggle -->
                        <li class="active">
                            <a href="javascript:void(0)" class="site-nav-sub"><i class="fa fa-angle-down site-nav-arrow"></i>Home</a>
                            <ul>
                                <li>
                                    <a href="index.html" class="active">Full Width</a>
                                </li>
                                <li>
                                    <a href="index_alt.html">Full Width (Dark)</a>
                                </li>
                                <li>
                                    <a href="index_parallax.html">Full Width Parallax</a>
                                </li>
                                <li>
                                    <a href="index_boxed.html">Boxed</a>
                                </li>
                                <li>
                                    <a href="index_boxed_alt.html">Boxed (Dark)</a>
                                </li>
                                <li>
                                    <a href="index_boxed_parallax.html">Boxed Parallax</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0)" class="site-nav-sub"><i class="fa fa-angle-down site-nav-arrow"></i>Pages</a>
                            <ul>
                                <li>
                                    <a href="blog.html">Blog</a>
                                </li>
                                <li>
                                    <a href="blog_post.html">Blog Post</a>
                                </li>
                                <li>
                                    <a href="portfolio_4.html">Portfolio 4 Columns</a>
                                </li>
                                <li>
                                    <a href="portfolio_3.html">Portfolio 3 Columns</a>
                                </li>
                                <li>
                                    <a href="portfolio_2.html">Portfolio 2 Columns</a>
                                </li>
                                <li>
                                    <a href="portfolio_single.html">Portfolio Single</a>
                                </li>
                                <li>
                                    <a href="team.html">Team</a>
                                </li>
                                <li>
                                    <a href="helpdesk.html">Helpdesk</a>
                                </li>
                                <li>
                                    <a href="jobs.html">Jobs</a>
                                </li>
                                <li>
                                    <a href="how_it_works.html">How it works</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0)" class="site-nav-sub"><i class="fa fa-angle-down site-nav-arrow"></i>eCommerce</a>
                            <ul>
                                <li>
                                    <a href="ecom_home.html">Home</a>
                                </li>
                                <li>
                                    <a href="ecom_search_results.html">Search Results</a>
                                </li>
                                <li>
                                    <a href="ecom_product_list.html">Product List</a>
                                </li>
                                <li>
                                    <a href="ecom_product.html">Product</a>
                                </li>
                                <li>
                                    <a href="ecom_product_comparison.html">Product Comparison</a>
                                </li>
                                <li>
                                    <a href="ecom_shopping_cart.html">Shopping Cart</a>
                                </li>
                                <li>
                                    <a href="ecom_checkout.html">Checkout</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="features.html">Features</a>
                        </li>
                        <li>
                            <a href="pricing.html">Pricing</a>
                        </li>
                        <li>
                            <a href="contact.html">Contact</a>
                        </li>
                        <li>
                            <a href="about.html">About</a>
                        </li>
                    </ul>
                    <!-- END Main Menu -->
                </nav>
                <!-- END Site Navigation -->
            </div>
        </header>
        <!-- END Site Header -->

        <!-- Home Carousel -->
        <div id="home-carousel" class="carousel carousel-home slide" data-ride="carousel" data-interval="5000">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="active item">
                    <section class="site-section site-section-light site-section-top themed-background-default">
                        <div class="container">
                            <h1 class="text-center animation-slideDown hidden-xs"><strong>A complete web solution for your awesome project</strong></h1>
                            <h2 class="text-center animation-slideUp push hidden-xs">Bring your project to life months sooner</h2>
                            <p class="text-center animation-fadeIn">
                                <img src="img/placeholders/home/home1.png" alt="Promo Image 1">
                            </p>
                        </div>
                    </section>
                </div>
                <div class="item">
                    <section class="site-section site-section-light site-section-top themed-background-fire">
                        <div class="container">
                            <h1 class="text-center animation-fadeIn360 hidden-xs"><strong>Featuring a Powerful and Flexible layout</strong></h1>
                            <h2 class="text-center animation-fadeIn360 push hidden-xs">Letting you focus on creating your project</h2>
                            <p class="text-center animation-fadeInLeft">
                                <img src="img/placeholders/home/home2.png" alt="Promo Image 2">
                            </p>
                        </div>
                    </section>
                </div>
                <div class="item">
                    <section class="site-section site-section-light site-section-top themed-background-amethyst">
                        <div class="container">
                            <h1 class="text-center animation-hatch hidden-xs"><strong>Fully Responsive and Retina Ready</strong></h1>
                            <h2 class="text-center animation-hatch push hidden-xs">The UI will look great and crisp</h2>
                            <p class="text-center animation-hatch">
                                <img src="img/placeholders/home/home3.png" alt="Promo Image 3">
                            </p>
                        </div>
                    </section>
                </div>
                <div class="item">
                    <section class="site-section site-section-light site-section-top themed-background-modern">
                        <div class="container">
                            <h1 class="text-center animation-fadeInLeft hidden-xs"><strong>Tons of features are designed &amp; waiting for you</strong></h1>
                            <h2 class="text-center animation-fadeInRight push hidden-xs">Everything you need for your project</h2>
                            <p class="text-center animation-fadeIn360">
                                <img src="img/placeholders/home/home4.png" alt="Promo Image 4">
                            </p>
                        </div>
                    </section>
                </div>
            </div>
            <!-- END Wrapper for slides -->

            <!-- Controls -->
            <a class="left carousel-control" href="#home-carousel" data-slide="prev">
                    <span>
                        <i class="fa fa-chevron-left"></i>
                    </span>
            </a>
            <a class="right carousel-control" href="#home-carousel" data-slide="next">
                    <span>
                        <i class="fa fa-chevron-right"></i>
                    </span>
            </a>
            <!-- END Controls -->
        </div>
        <!-- END Home Carousel -->

        <!-- Support Links -->
        <section class="site-content site-section">
            <div class="container">
                <div class="row row-items text-center">
                    <div class="col-sm-3 animation-fadeIn">
                        <a href="javascript:void(0)" class="circle themed-background">
                            <i class="gi gi-life_preserver"></i>
                        </a>
                        <h4>Open a <strong>ticket</strong></h4>
                    </div>
                    <div class="col-sm-3 animation-fadeIn">
                        <a href="javascript:void(0)" class="circle themed-background">
                            <i class="gi gi-envelope"></i>
                        </a>
                        <h4><strong>Email</strong> Us</h4>
                    </div>
                    <div class="col-sm-3 animation-fadeIn">
                        <a href="javascript:void(0)" class="circle themed-background">
                            <i class="fa fa-comments"></i>
                        </a>
                        <h4><strong>Chat</strong> Live</h4>
                    </div>
                    <div class="col-sm-3 animation-fadeIn">
                        <a href="javascript:void(0)" class="circle themed-background">
                            <i class="fa fa-twitter"></i>
                        </a>
                        <h4><strong>Tweet</strong> Us</h4>
                    </div>
                </div>
                <hr>
            </div>
        </section>
        <!-- END Support Links -->

        <!-- Promo #1 -->
        <section class="site-content site-section site-slide-content">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 site-block visibility-none" data-toggle="animation-appear" data-animation-class="animation-fadeInRight" data-element-offset="-180">
                        <img src="img/placeholders/screenshots/promo_desktop_left.png" alt="Promo #1" class="img-responsive">
                    </div>
                    <div class="col-sm-6 col-md-5 col-md-offset-1 site-block visibility-none" data-toggle="animation-appear" data-animation-class="animation-fadeInLeft" data-element-offset="-180">
                        <h3 class="h2 site-heading site-heading-promo"><strong>Clean and Modern</strong> Design</h3>
                        <p class="promo-content">ProUI is a professional, modern and solid foundation for your next awesome project. It comes packed with great features that you will love. <a href="features.html">Learn More..</a></p>
                    </div>
                </div>
                <hr>
            </div>
        </section>
        <!-- END Promo #1 -->

        <!-- Promo #2 -->
        <section class="site-content site-section site-slide-content">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-md-5 site-block visibility-none" data-toggle="animation-appear" data-animation-class="animation-fadeInRight" data-element-offset="-180">
                        <h3 class="h2 site-heading site-heading-promo"><strong>Powerful</strong> Admin Template</h3>
                        <p class="promo-content">ProUI has a powerful and flexible layout to meet every need. It comes packed with 9 awesome and fresh color themes that you will love, too. <a href="features.html">Learn More..</a></p>
                    </div>
                    <div class="col-sm-6 col-md-offset-1 site-block visibility-none" data-toggle="animation-appear" data-animation-class="animation-fadeInLeft" data-element-offset="-180">
                        <img src="img/placeholders/screenshots/promo_desktop_right.png" alt="Promo #2" class="img-responsive">
                    </div>
                </div>
                <hr>
            </div>
        </section>
        <!-- END Promo #2 -->

        <!-- Promo #3 -->
        <section class="site-content site-section site-slide-content">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 site-block visibility-none" data-toggle="animation-appear" data-animation-class="animation-fadeInRight" data-element-offset="-180">
                        <img src="img/placeholders/screenshots/promo_tablet.png" alt="Promo #3" class="img-responsive">
                    </div>
                    <div class="col-sm-6 col-md-5 col-md-offset-1 site-block visibility-none" data-toggle="animation-appear" data-animation-class="animation-fadeInLeft" data-element-offset="-180">
                        <h3 class="h2 site-heading site-heading-promo"><strong>Fully</strong> Responsive</h3>
                        <p class="promo-content">The User Interface will just work in mobile phones, tablets, laptops and desktops. You can focus on creating the project you want. <a href="features.html">Learn More..</a></p>
                    </div>
                </div>
                <hr>
            </div>
        </section>
        <!-- END Promo #3 -->

        <!-- Promo #4 -->
        <section class="site-content site-section site-slide-content">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-md-5 site-block visibility-none" data-toggle="animation-appear" data-animation-class="animation-fadeInRight" data-element-offset="-180">
                        <h3 class="h2 site-heading site-heading-promo"><strong>Mobile</strong> First</h3>
                        <p class="promo-content">The layout adjusts as we move up from mobile devices to large desktop screens and not the other way around. This speed things up a lot. <a href="features.html">Learn More..</a></p>
                    </div>
                    <div class="col-sm-6 col-md-offset-1 site-block visibility-none" data-toggle="animation-appear" data-animation-class="animation-fadeInLeft" data-element-offset="-180">
                        <img src="img/placeholders/screenshots/promo_mobile.png" alt="Promo #4" class="img-responsive">
                    </div>
                </div>
                <hr>
            </div>
        </section>
        <!-- END Promo #4 -->
        <section class="site-section site-section-light site-section-top themed-background-fire">
            <div class="container">
                <h1 class="text-center animation-slideDown"><i class="fa fa-heart"></i> <strong>Meet our team</strong></h1>
                <h2 class="h3 text-center animation-slideUp">Passionate people who love what they do!</h2>
            </div>
        </section>

        <section class="site-content site-section">
            <div class="container">
                <div class="row row-items text-center">
                    <div class="col-sm-4 col-md-3">
                        <img src="img/placeholders/avatars/avatar2@2x.jpg" alt="Photo" class="img-circle animation-fadeIn" data-toggle="animation-appear" data-animation-class="animation-fadeIn" data-element-offset="-64">
                        <h3>
                            <strong>John</strong> Doe<br>
                            <small>Chief Executive Officer</small>
                        </h3>
                    </div>
                    <div class="col-sm-4 col-md-3">
                        <img src="img/placeholders/avatars/avatar12@2x.jpg" alt="Photo" class="img-circle animation-fadeIn" data-toggle="animation-appear" data-animation-class="animation-fadeIn" data-element-offset="-64">
                        <h3>
                            <strong>Ella</strong> Parker<br>
                            <small>Finance Operations Manager</small>
                        </h3>
                    </div>
                    <div class="col-sm-4 col-md-3">
                        <img src="img/placeholders/avatars/avatar15@2x.jpg" alt="Photo" class="img-circle animation-fadeIn" data-toggle="animation-appear" data-animation-class="animation-fadeIn" data-element-offset="-64">
                        <h3>
                            <strong>Peter</strong> Driessen<br>
                            <small>Customer Tech Support</small>
                        </h3>
                    </div>
                    <div class="col-sm-4 col-md-3">
                        <img src="img/placeholders/avatars/avatar10@2x.jpg" alt="Photo" class="img-circle animation-fadeIn" data-toggle="animation-appear" data-animation-class="animation-fadeIn" data-element-offset="-64">
                        <h3>
                            <strong>Victoria</strong> Hansen<br>
                            <small>VP of Operations</small>
                        </h3>
                    </div>
                    <div class="col-sm-4 col-md-3">
                        <img src="img/placeholders/avatars/avatar8@2x.jpg" alt="Photo" class="img-circle animation-fadeIn" data-toggle="animation-appear" data-animation-class="animation-fadeIn" data-element-offset="-64">
                        <h3>
                            <strong>Brian</strong> Sims<br>
                            <small>Site Reliability Engineer</small>
                        </h3>
                    </div>
                    <div class="col-sm-4 col-md-3">
                        <img src="img/placeholders/avatars/avatar4@2x.jpg" alt="Photo" class="img-circle animation-fadeIn" data-toggle="animation-appear" data-animation-class="animation-fadeIn" data-element-offset="-64">
                        <h3>
                            <strong>Anthony</strong> Daniels<br>
                            <small>Technical Support</small>
                        </h3>
                    </div>
                    <div class="col-sm-4 col-md-3">
                        <img src="img/placeholders/avatars/avatar13@2x.jpg" alt="Photo" class="img-circle animation-fadeIn" data-toggle="animation-appear" data-animation-class="animation-fadeIn" data-element-offset="-64">
                        <h3>
                            <strong>Faith</strong> Russ<br>
                            <small>Office Admin</small>
                        </h3>
                    </div>
                    <div class="col-sm-4 col-md-3">
                        <img src="img/placeholders/avatars/avatar11@2x.jpg" alt="Photo" class="img-circle animation-fadeIn" data-toggle="animation-appear" data-animation-class="animation-fadeIn" data-element-offset="-64">
                        <h3>
                            <strong>Archie</strong> Jackson<br>
                            <small>Web Designer</small>
                        </h3>
                    </div>
                    <div class="col-sm-4 col-md-3">
                        <img src="img/placeholders/avatars/avatar3@2x.jpg" alt="Photo" class="img-circle animation-fadeIn" data-toggle="animation-appear" data-animation-class="animation-fadeIn" data-element-offset="-64">
                        <h3>
                            <strong>Denis</strong> Laurian<br>
                            <small>Web Developer</small>
                        </h3>
                    </div>
                    <div class="col-sm-4 col-md-3">
                        <img src="img/placeholders/avatars/avatar1@2x.jpg" alt="Photo" class="img-circle animation-fadeIn" data-toggle="animation-appear" data-animation-class="animation-fadeIn" data-element-offset="-64">
                        <h3>
                            <strong>Octaviu</strong> Lambru<br>
                            <small>Software Engineer</small>
                        </h3>
                    </div>
                    <div class="col-sm-4 col-md-3">
                        <img src="img/placeholders/avatars/avatar16@2x.jpg" alt="Photo" class="img-circle animation-fadeIn" data-toggle="animation-appear" data-animation-class="animation-fadeIn" data-element-offset="-64">
                        <h3>
                            <strong>Jenel</strong> Botnaru<br>
                            <small>Web Developer</small>
                        </h3>
                    </div>
                    <div class="col-sm-4 col-md-3">
                        <img src="img/placeholders/avatars/avatar7@2x.jpg" alt="Photo" class="img-circle animation-fadeIn" data-toggle="animation-appear" data-animation-class="animation-fadeIn" data-element-offset="-64">
                        <h3>
                            <strong>Willem</strong> Post<br>
                            <small>Community Manager</small>
                        </h3>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials -->
        <section class="site-content site-section">
            <div class="container">
                <!-- Testimonials Carousel -->
                <div id="testimonials-carousel" class="carousel slide carousel-html" data-ride="carousel" data-interval="4000">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#testimonials-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#testimonials-carousel" data-slide-to="1"></li>
                        <li data-target="#testimonials-carousel" data-slide-to="2"></li>
                    </ol>
                    <!-- END Indicators -->

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner text-center">
                        <div class="active item">
                            <p>
                                <img src="img/placeholders/avatars/avatar12.jpg" alt="Avatar" class="img-circle">
                            </p>
                            <blockquote class="no-symbol">
                                <p>An awesome team that brought our ideas to life! Highly recommended!</p>
                                <footer><strong>Sophie Illich</strong>, example.com</footer>
                            </blockquote>
                        </div>
                        <div class="item">
                            <p>
                                <img src="img/placeholders/avatars/avatar7.jpg" alt="Avatar" class="img-circle">
                            </p>
                            <blockquote class="no-symbol">
                                <p>I have never imagined that our final product would look that good!</p>
                                <footer><strong>David Cull</strong>, example.com</footer>
                            </blockquote>
                        </div>
                        <div class="item">
                            <p>
                                <img src="img/placeholders/avatars/avatar9.jpg" alt="Avatar" class="img-circle">
                            </p>
                            <blockquote class="no-symbol">
                                <p>An extraordinary service that helped us grow way too fast!</p>
                                <footer><strong>Nathan Brown</strong>, example.com</footer>
                            </blockquote>
                        </div>
                    </div>
                    <!-- END Wrapper for slides -->
                </div>
                <!-- END Testimonials Carousel -->
            </div>
        </section>
        <!-- END Testimonials -->
    </div>
@stop
