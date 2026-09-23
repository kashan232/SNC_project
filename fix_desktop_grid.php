<?php
$f = 'resources/views/frontend/pages/product-grids.blade.php';
$c = file_get_contents($f);

// 1. Fix the shop-top-right by adding back the Sort By dropdown
$oldTopRight = '<div class="shop-top-right">
                                <!-- Replaced Sort By with Search Bar -->
                                <div class="search-bar-modern">
                                    <input type="text" name="search" placeholder="Search products..." value="{{ request(\'search\') }}" class="modern-search-input">
                                    <button type="submit" class="modern-search-btn"><i class="ti-search"></i></button>
                                </div>
                            </div>';

$newTopRight = '<div class="shop-top-right d-flex align-items-center" style="gap: 15px;">
                                <div class="search-bar-modern">
                                    <input type="text" name="search" placeholder="Search products..." value="{{ request(\'search\') }}" class="modern-search-input">
                                    <button type="submit" class="modern-search-btn"><i class="ti-search"></i></button>
                                </div>
                                <div class="sort-by-modern d-none d-lg-flex align-items-center">
                                    <span style="font-size: 13px; font-weight: 600; color: #555; margin-right: 10px; white-space: nowrap;">Sort by</span>
                                    <select class="modern-select" name="sortBy" onchange="this.form.submit();">
                                        <option value="default">Featured</option>
                                        <option value="title" @if(!empty($_GET[\'sortBy\']) && $_GET[\'sortBy\']==\'title\') selected @endif>Name</option>
                                        <option value="price" @if(!empty($_GET[\'sortBy\']) && $_GET[\'sortBy\']==\'price\') selected @endif>Price</option>
                                        <option value="category" @if(!empty($_GET[\'sortBy\']) && $_GET[\'sortBy\']==\'category\') selected @endif>Category</option>
                                        <option value="brand" @if(!empty($_GET[\'sortBy\']) && $_GET[\'sortBy\']==\'brand\') selected @endif>Brand</option>
                                    </select>
                                </div>
                            </div>';

$c = str_replace($oldTopRight, $newTopRight, $c);

// 2. Remove the duplicate/overriding @media (max-width: 768px) block completely
// Find the exact block starting with "@media (max-width: 768px) { /* keeping original query for safety */"
// and remove it till the end of the style tag.
$badBlockStart = '@media (max-width: 768px) { /* keeping original query for safety */';
$pos = strpos($c, $badBlockStart);
if ($pos !== false) {
    // We want to delete from $pos up to </style>
    $endPos = strpos($c, '</style>', $pos);
    if ($endPos !== false) {
        $c = substr($c, 0, $pos) . '</style>' . substr($c, $endPos + 8);
    }
}

file_put_contents($f, $c);
echo "Desktop and Media queries fixed";
?>
