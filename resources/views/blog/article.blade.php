<x-web-layout>

    <x-article-breadcrum :article="$article" />
    
    <!--=====================================-->
    <!--=        Blog Area Start       	    =-->
    <!--=====================================-->
    <section class="section-padding-equal">
        <div class="container">
            <div class="row row-40">
                <div class="col-lg-8">
                    <div class="single-blog">
                        <x-article-content :article="$article" />
                        @if($article->author)
                        <x-article-author :author="$article->author" />
                        @endif
                        <div class="blog-comment">
                            <h3 class="section-title">نظرات:</h3>
                            <div class="comment-list">
                                <!-- Start Single Comment  -->
                                <div class="comment">
                                    <div class="thumbnail">
                                        <img src="{{ asset('abstrak/media/blog/author-1.png') }}" alt="Blog Comment">
                                    </div>
                                    <div class="content">
                                        <div class="heading">
                                            <h5 class="title">سوفی آسولد</h5>
                                            <div class="comment-date">
                                                <p>17/1/1400</p>
                                                <a class="reply-btn" href="single-blog.html#"><i class="fas fa-reply"></i></a>
                                            </div>
                                        </div>
                                        <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است</p>
                                    </div>
                                </div>
                                <!-- End Single Comment  -->
                                <!-- Start Single Comment  -->
                                <div class="comment comment-reply">
                                    <div class="thumbnail">
                                        <img src="{{ asset('abstrak/media/blog/author-2.png') }}" alt="Blog Comment">
                                    </div>
                                    <div class="content">
                                        <div class="heading">
                                            <h5 class="title">آریانا جراد</h5>
                                            <div class="comment-date">
                                                <p>17/1/1400</p>
                                                <a class="reply-btn" href="single-blog.html#"><i class="fas fa-reply"></i></a>
                                            </div>
                                        </div>
                                        <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است</p>
                                    </div>
                                </div>
                                <!-- End Single Comment  -->
                                <!-- Start Single Comment  -->
                                <div class="comment">
                                    <div class="thumbnail">
                                        <img src="{{ asset('abstrak/media/blog/author-3.png') }}" alt="Blog Comment">
                                    </div>
                                    <div class="content">
                                        <div class="heading">
                                            <h5 class="title">سوفی آسولد</h5>
                                            <div class="comment-date">
                                                <p>17/1/1400</p>
                                                <a class="reply-btn" href="single-blog.html#"><i class="fas fa-reply"></i></a>
                                            </div>
                                        </div>
                                        <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است</p>
                                    </div>
                                </div>
                                <!-- End Single Comment  -->
                            </div>
                        </div>
                        <div class="blog-comment-form">
                            <h3 class="title">پیام بگذارید:</h3>
                            <form>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>نام</label>
                                            <input type="text" class="form-control" name="name" placeholder="امیرحسین دامن دریا ">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>ایمیل</label>
                                            <input type="email" class="form-control" name="name" placeholder="example@mail.com">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>تلفن</label>
                                            <input type="tel" class="form-control" name="Phone" placeholder="+123456789">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>وبسایت</label>
                                            <input type="text" class="form-control" name="website" placeholder="www.example.com">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group mb--30">
                                            <label>آیا میتوانم به شما کمک کنم ؟</label>
                                            <textarea name="message" id="message" class="form-control textarea" cols="30" rows="4"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <button type="submit" class="axil-btn btn-fill-primary btn-fluid" name="submit-btn">اکنون ارسال کنید</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="axil-sidebar">
                        <div class="widget widget-search">
                            <h4 class="widget-title">جستجو</h4>
                            <form action="single-blog.html#" class="blog-search">
                                <input type="text" placeholder="جستجو...">
                                <button class="search-button"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                        <div class="widget widget-categories">
                            <h4 class="widget-title">دسته بندی</h4>
                            <ul class="category-list list-unstyled">
                                <li><a href="single-blog.html">اخبار آژانس</a></li>
                                <li><a href="single-blog.html">وبلاگ</a></li>
                                <li><a href="single-blog.html">اطلاعات تکنولوژی </a></li>
                                <li><a href="single-blog.html">جدید ترین ایده ها</a></li>
                                <li><a href="single-blog.html">دستهبندی نشده</a></li>
                                <li><a href="single-blog.html">بازاریابی </a></li>
                            </ul>
                        </div>
                        <div class="widget widge-social-share">
                            <div class="blog-share">
                                <h5 class="title">دنبال کردن:</h5>
                                <ul class="social-list list-unstyled">
                                    <li><a href="https://facebook.com/"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="https://twitter.com/"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a></li>
                                    <li><a href="https://www.linkedin.com/"><i class="fab fa-linkedin-in"></i></a></li>
                                    <li><a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a></li>
                                    <li><a href="https://www.youtube.com/"><i class="fab fa-youtube"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="widget widget-recent-post">
                            <h4 class="widget-title">پست های اخیر</h4>
                            <div class="post-list-wrap">
                                <div class="single-post">
                                    <div class="post-thumbnail">
                                        <a href="single-blog.html"><img src="{{ asset('abstrak/media/blog/blog-5.png') }}" alt="Blog"></a>
                                    </div>
                                    <div class="post-content">
                                        <h6 class="title"><a href="single-blog.html">مالکیت را در دست بگیرید و وضعیت موجود را زیر سوال ببرید.</a></h6>
                                        <ul class="blog-meta list-unstyled">
                                            <li>17/1/1400</li>
                                            <li>9 دقیقه برای خواندن</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="single-post">
                                    <div class="post-thumbnail">
                                        <a href="single-blog.html"><img src="{{ asset('abstrak/media/blog/blog-6.png') }}" alt="Blog"></a>
                                    </div>
                                    <div class="post-content">
                                        <h6 class="title"><a href="single-blog.html">مالکیت را در دست بگیرید و وضعیت موجود را زیر سوال ببرید.</a></h6>
                                        <ul class="blog-meta list-unstyled">
                                            <li>17/1/1400</li>
                                            <li>18دقیقه برای خواندن </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="single-post">
                                    <div class="post-thumbnail">
                                        <a href="single-blog.html"><img src="{{ asset('abstrak/media/blog/blog-7.png') }}" alt="Blog"></a>
                                    </div>
                                    <div class="post-content">
                                        <h6 class="title"><a href="single-blog.html">مالکیت را در دست بگیرید و وضعیت موجود را زیر سوال ببرید.</a></h6>
                                        <ul class="blog-meta list-unstyled">
                                            <li>17/8/1400</li>
                                            <li>8 دقیقه برای خواندن</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="widget widget-banner-ad">
                            <a href="single-blog.html#">
                                <img src="{{ asset('abstrak/media/banner/widget-banner.png') }}" alt="banner">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=====================================-->
    <!--=       Recent Post Area Start      =-->
    <!--=====================================-->
    <section class="section section-padding-equal pt-0 related-blog-area">
        <div class="container">
            <div class="section-heading heading-left">
                <h3 class="title">پست های اخیر</h3>
            </div>
            <div class="slick-slider recent-post-slide" data-slick='{"infinite": true, "autoplay": true, "arrows": false, "dots": false, "slidesToShow": 2,"rtl":true,
        "responsive": [
            {
                "breakpoint": 1199,
                "settings": {
                    "slidesToShow": 1
                }
            }
        ]
        }'>
                <div class="slick-slide">
                    <div class="blog-list">
                        <div class="post-thumbnail">
                            <a href="single-blog.html"><img src="{{ asset('abstrak/media/blog/blog-1.png') }}" alt="Blog Post"></a>
                        </div>
                        <div class="post-content">
                            <h5 class="title"><a href="single-blog.html">چگونه از یک استراتژی بازاریابی مجدد برای کسب بیشتر استفاده کنیم</a></h5>
                            <p>تولید تقاضا یک مبارزه دائمی برای هر کسب و کاری است. هر استراتژی بازاریابی که استفاده می کنید دارای ...</p>
                            <a href="single-blog.html" class="more-btn">اطلاعات بیشتر<i class="far fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="slick-slide">
                    <div class="blog-list">
                        <div class="post-thumbnail">
                            <a href="single-blog.html"><img src="{{ asset('abstrak/media/blog/blog-2.png') }}" alt="Blog Post"></a>
                        </div>
                        <div class="post-content">
                            <h5 class="title"><a href="single-blog.html">آمار سئو که باید در سال 2021 بدانید</a></h5>
                            <p>جستجوی ارگانیک این پتانسیل را دارد که بیش از 40 درصد از درآمد ناخالص شما را به دست آورد...</p>
                            <a href="single-blog.html" class="more-btn">بیشتر بدانید<i class="far fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="slick-slide">
                    <div class="blog-list">
                        <div class="post-thumbnail">
                            <a href="single-blog.html"><img src="{{ asset('abstrak/media/blog/blog-1.png') }}" alt="Blog Post"></a>
                        </div>
                        <div class="post-content">
                            <h5 class="title"><a href="single-blog.html">چگونه از یک استراتژی بازاریابی مجدد برای کسب بیشتر استفاده کنیم</a></h5>
                            <p>تولید تقاضا یک مبارزه دائمی برای هر کسب و کاری است. هر استراتژی بازاریابی که استفاده می کنید دارای ...</p>
                            <a href="single-blog.html" class="more-btn">اطلاعات بیشتر<i class="far fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-web-layout>