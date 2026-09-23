<?php
 = 'resources/views/frontend/index.blade.php';
 = file_get_contents();

// Remove all injected explore-menu CSS to start fresh
 = preg_replace('/\/\* EXPLORE MENU DESIGN \*\/.*?(?=<\/style>)/s', '', );
 = preg_replace('/\/\* LEAVES BACKGROUND \*\/.*?(?=<\/style>)/s', '', );
 = preg_replace('/\.explore-card:hover\s*\{[^}]+\}/s', '', );
 = preg_replace('/\.explore-card:hover \.explore-img-wrap\s*\{[^}]+\}/s', '', );
 = preg_replace('/\.explore-card:hover \.explore-info h3\s*\{[^}]+\}/s', '', );
 = preg_replace('/\.explore-card:hover \.explore-btn\s*\{[^}]+\}/s', '', );
 = preg_replace('/\.explore-card:hover \.explore-leaf\s*\{[^}]+\}/s', '', );
 = preg_replace('/\.explore-card:hover \.explore-img-wrap img\s*\{[^}]+\}/s', '', );

// Add the consolidated, perfectly centered CSS BEFORE the FIRST </style> associated with the explore section
 = "
/* EXPLORE MENU DESIGN */
.explore-menu-section {
    padding: 80px 0;
    background-color: #fbf9f6 !important;
    background-image: none !important;
    font-family: 'Poppins', sans-serif;
    position: relative;
    overflow: hidden;
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

.explore-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    margin-bottom: 40px;
    position: relative;
    z-index: 2;
}

.explore-subtitle {
    font-size: 13px;
    font-weight: 700;
    color: #F7941D;
    text-transform: uppercase;
    letter-spacing: 1px;
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 5px;
}

.explore-subtitle .line {
    width: 40px;
    height: 2px;
    background-color: #F7941D;
    display: inline-block;
}

.explore-title {
    font-size: 42px;
    font-weight: 900;
    color: #222;
    margin: 0 0 10px 0;
    line-height: 1.2;
}

.explore-title .text-orange {
    color: #F7941D;
}

.explore-desc {
    font-size: 14px;
    color: #777;
    margin: 0;
    line-height: 1.6;
}

.explore-view-all {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 10px 25px;
    border: 1px solid #ddd;
    border-radius: 30px;
    color: #333;
    font-weight: 600;
    font-size: 14px;
    text-decoration: none;
    transition: all 0.3s ease;
    background: #fff;
}
.explore-view-all:hover {
    background: #F7941D;
    border-color: #F7941D;
    color: #fff;
}

.explore-slider .owl-stage {
    display: flex;
    align-items: stretch;
}
.explore-slider .owl-item {
    display: flex;
}

.explore-card {
    background: #fff;
    border-radius: 24px;
    padding: 20px;
    display: flex;
    flex-direction: column;
    width: 100%;
    text-decoration: none !important;
    box-shadow: 0 5px 15px rgba(0,0,0,0.03);
    transition: all 0.4s ease;
    margin: 15px 5px;
    position: relative;
}

/* Hover Effect */
.explore-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 35px rgba(247, 148, 29, 0.3);
    background: #F7941D;
}

.explore-img-wrap {
    position: relative;
    width: 100%;
    padding-top: 100%;
    margin-bottom: 20px;
    display: block;
}

.explore-blob {
    position: absolute;
    top: 5%; left: 5%; right: 5%; bottom: 5%;
    border-radius: 40% 60% 70% 30% / 40% 50% 60% 50%;
    z-index: 1;
    transition: all 0.5s ease;
}

.explore-card:hover .explore-blob {
    background-color: #fff !important;
    border-radius: 50%;
}

.explore-img-wrap img {
    position: absolute;
    top: 50%; left: 50%;
    transform: translate(-50%, -50%);
    width: 85%; height: 85%;
    object-fit: contain;
    z-index: 2;
    transition: transform 0.5s ease;
}

.explore-card:hover .explore-img-wrap img {
    transform: translate(-50%, -50%) scale(1.15);
}

.explore-info {
    display: flex;
    flex-direction: column;
    flex-grow: 1;
    justify-content: space-between;
}

.explore-info h3 {
    font-size: 17px;
    font-weight: 800;
    color: #222;
    margin: 0 0 15px 0;
    text-align: left;
    line-height: 1.3;
    transition: color 0.4s ease;
}

.explore-card:hover .explore-info h3 {
    color: #fff;
}

.explore-card-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: auto;
}

.explore-btn {
    width: 32px;
    height: 32px;
    background: #F7941D;
    color: #fff;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 12px;
    transition: all 0.3s ease;
}

.explore-card:hover .explore-btn {
    background: #fff;
    color: #F7941D;
    transform: scale(1.1);
}

.explore-leaf {
    color: #f0f0f0;
    font-size: 24px;
    line-height: 1;
    transition: color 0.3s ease;
}

.explore-card:hover .explore-leaf {
    color: rgba(255, 255, 255, 0.25);
}

/* OWL NAV PERFECT CENTERING */
.explore-menu-section .owl-carousel {
    position: relative;
    z-index: 2;
}
.explore-menu-section .owl-carousel .owl-nav {
    position: absolute;
    top: 50%;
    left: 0;
    width: 100%;
    height: 0;
    margin: 0 !important;
    transform: translateY(-50%);
    pointer-events: none;
    z-index: 10;
}
.explore-menu-section .owl-carousel .owl-nav button.owl-prev,
.explore-menu-section .owl-carousel .owl-nav button.owl-next {
    position: absolute !important;
    top: 0 !important;
    transform: translateY(-50%) !important; /* Perfect vertical center */
    width: 45px !important;
    height: 45px !important;
    background: #fff !important;
    color: #333 !important; /* Forces dark grey caret */
    border-radius: 50% !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1) !important;
    pointer-events: auto;
    font-size: 18px !important;
    line-height: 1 !important;
    transition: all 0.3s ease !important;
    margin: 0 !important;
    border: 1px solid #eee !important;
}
.explore-menu-section .owl-carousel .owl-nav button.owl-prev {
    left: -20px !important;
}
.explore-menu-section .owl-carousel .owl-nav button.owl-next {
    right: -20px !important;
}
.explore-menu-section .owl-carousel .owl-nav button.owl-prev:hover,
.explore-menu-section .owl-carousel .owl-nav button.owl-next:hover {
    background: #F7941D !important;
    color: #fff !important;
    border-color: #F7941D !important;
}

@media (max-width: 768px) {
    .explore-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 20px;
    }
    .explore-title {
        font-size: 32px;
    }
}
";

// Inject cleanCSS into the <style> right before </section>
 = preg_replace('/(<!-- Start Categories Section \(Carousel\) -->\s*<style>)/', '' . , );

file_put_contents(, );
echo "Done";
?>
