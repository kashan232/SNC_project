<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/layouts/header.blade.php');

$old_sidebar_cat = <<<'HTML'
                <li>
                    <a href="#catSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" style="display:flex; justify-content:space-between; align-items:center;"><span style="display:flex; align-items:center;"><i class="ti-view-grid" style="margin-right:10px;"></i> Categories</span> <i class="fa fa-angle-down"></i></a>
                    <ul class="collapse list-unstyled" id="catSubmenu" style="padding-left: 20px; background: #fafafa; border-left: 3px solid var(--primary-color);">
                        {{Helper::getHeaderCategory()}}
                    </ul>
                </li>
HTML;

$new_sidebar_cat = <<<'HTML'
                <li>
                    <a href="#catSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" style="display:flex; justify-content:space-between; align-items:center;"><span style="display:flex; align-items:center;"><i class="ti-view-grid" style="margin-right:10px;"></i> Categories</span> <i class="fa fa-angle-down"></i></a>
                    <ul class="collapse list-unstyled" id="catSubmenu" style="background: #fafafa; border-left: 3px solid var(--primary-color);">
                        @php
                            $categories = \App\Models\Category::where('is_parent',1)->where('status','active')->orderBy('title','ASC')->get();
                        @endphp
                        @foreach($categories as $cat)
                            <li><a href="{{route('product-cat', $cat->slug)}}" style="padding: 10px 25px; color: #555; display:block; text-decoration:none; border-bottom: 1px solid #eee;">{{$cat->title}}</a></li>
                        @endforeach
                    </ul>
                </li>
HTML;

$c = str_replace($old_sidebar_cat, $new_sidebar_cat, $c);
file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/layouts/header.blade.php', $c);
echo "Sidebar categories updated.";
