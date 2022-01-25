@php
# get all blog post category
$blogPostCategories = App\Models\Blog\BlogPostCategory::latest()->get();
@endphp
<div class="sidebar-widget outer-bottom-xs wow fadeInUp">
    <h3 class="section-title">Category</h3>
    <div class="sidebar-widget-body m-t-10">
        <div class="accordion">
            <ul class="list-group list-group-flush">
                @foreach ($blogPostCategories as $category)
                    <li class="list-group-item"><a
                            href="{{ route('blog.category', ['id' => $category->id, 'slug' => $category->slug_en]) }}">
                            @if (session()->get('language') === 'hindi')
                                {{ $category->name_hin }}
                            @else
                                {{ $category->name_en }}
                            @endif
                        </a></li>
                @endforeach
            </ul>

        </div><!-- /.accordion -->
    </div><!-- /.sidebar-widget-body -->
</div><!-- /.sidebar-widget -->
