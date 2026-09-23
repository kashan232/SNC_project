<?php
$f = 'resources/views/frontend/index.blade.php';
$c = file_get_contents($f);

// 1. Fix the flexbox issue causing the white rectangle glitch
$c = str_replace(
"/* IMAGE WRAPPER */
.explore-img-wrap {
    position: relative;
    width: 100%;
    padding-top: 100%; /* 1:1 Aspect Ratio */
    margin-bottom: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
}",
"/* IMAGE WRAPPER */
.explore-img-wrap {
    position: relative;
    width: 100%;
    padding-top: 100%; /* 1:1 Aspect Ratio */
    margin-bottom: 20px;
    display: block; /* Fixed to block so padding-top works correctly in all browsers */
}", $c);

// 2. Add the SVG Leaves CSS and elements
$leaves_css = "
/* LEAVES BACKGROUND */
.explore-menu-section {
    position: relative;
    overflow: hidden; /* contain leaves */
}
.explore-bg-leaf {
    position: absolute;
    z-index: 0;
    pointer-events: none;
    opacity: 0.5;
    filter: blur(4px);
    width: 150px;
    height: 150px;
    background-image: url('data:image/svg+xml;utf8,<svg viewBox=\"0 0 512 512\" xmlns=\"http://www.w3.org/2000/svg\"><path fill=\"%236da45b\" d=\"M498.4 46.2c-5.7-18.1-23.7-27.1-41.8-21.4-18.1 5.7-27.1 23.7-21.4 41.8 17.5 55.4 13.9 116.1-13.4 171-29.4-14.7-64.8-19.6-99.3-11.4-69.2 16.5-120.3 75.3-127.1 146l-46.7-46.7c-13.3-13.3-34.9-13.3-48.2 0l-57.1 57.1c-13.3 13.3-13.3 34.9 0 48.2l45.4 45.4-78.1 78.1c-13.3 13.3-13.3 34.9 0 48.2s34.9 13.3 48.2 0l78.1-78.1 45.4 45.4c13.3 13.3 34.9 13.3 48.2 0l57.1-57.1c13.3-13.3 13.3-34.9 0-48.2l-46.7-46.7c70.7-6.8 129.5-57.9 146-127.1 8.2-34.5 3.3-69.9-11.4-99.3 54.9-27.3 115.6-30.9 171-13.4 18.1 5.7 36.1-3.3 41.8-21.4z\"/></svg>');
    background-repeat: no-repeat;
    background-size: contain;
}
.explore-leaf-top-right {
    top: -30px;
    right: -30px;
    transform: rotate(45deg);
    width: 250px;
    height: 250px;
    filter: blur(8px);
}
.explore-leaf-bottom-left {
    bottom: -30px;
    left: -30px;
    transform: rotate(-135deg);
    width: 200px;
    height: 200px;
    filter: blur(6px);
}
";

// Insert the CSS before </style>
$c = str_replace('</style>', $leaves_css . '</style>', $c);

// Insert the HTML elements into the section
$leaves_html = '
    <div class="explore-bg-leaf explore-leaf-top-right"></div>
    <div class="explore-bg-leaf explore-leaf-bottom-left"></div>
    <div class="container" style="position: relative; z-index: 2;">';

$c = str_replace('<div class="container" style="position: relative;">', $leaves_html, $c);

file_put_contents($f, $c);
?>
