 <!-- get category with sub category-->
 @php
     $categories = App\Models\Category::with('subCategory')
         ->orderBy('name_en', 'asc')
         ->get();
 @endphp

 <div class="{{ $class ? $class : 'sidebar-widget wow fadeInUp' }}">
     <h3 class="section-title">shop by</h3>
     <div class="widget-header">
         <h4 class="widget-title">Category</h4>
     </div>
     <div class="sidebar-widget-body">
         <div class="accordion">

             @foreach ($categories as $category)
                 <div class="accordion-group">
                     <div class="accordion-heading"> <a href="#collapse{{ $category->id }}" data-toggle="collapse"
                             class="accordion-toggle collapsed">
                             @if (session()->get('language') === 'hindi')
                                 {{ $category->name_hin }}
                             @else
                                 {{ $category->name_en }}
                             @endif
                         </a> </div>
                     <!-- /.accordion-heading -->
                     <div class="accordion-body collapse" id="collapse{{ $category->id }}" style="height: 0px;">
                         <div class="accordion-inner">
                             <ul>
                                 @foreach ($category->subCategory as $subCategory)
                                     <li><a
                                             href="{{ route('product.subCategory', ['subcat' => $subCategory->id, 'slug' => $subCategory->slug_en]) }}">
                                             @if (session()->get('language') === 'hindi')
                                                 {{ $subCategory->name_hin }}
                                             @else
                                                 {{ $subCategory->name_en }}
                                             @endif
                                         </a></li>
                                 @endforeach

                             </ul>
                         </div>
                         <!-- /.accordion-inner -->
                     </div>
                     <!-- /.accordion-body -->
                 </div>
                 <!-- /.accordion-group -->
             @endforeach
         </div>
         <!-- /.accordion -->
     </div>
     <!-- /.sidebar-widget-body -->
 </div>
 <!-- /.sidebar-widget -->
