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
                        <x-article-categories />
                        
                        <x-latest-article />
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-web-layout>