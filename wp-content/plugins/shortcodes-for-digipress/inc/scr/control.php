<?php
// *********************************
// Add inserting shortcodes form element
// *********************************
function dp_sc_add_media_buttons(){
    if (!is_admin()) return;

    global $shortcode_tags;

    // Copy
    $arr_shortcodes = $shortcode_tags;

    // Exclude shotcodes
    $exclude = array("wp_caption", "embed", "caption", "gallery", "playlist", "audio", "video");
    $add_sc = array('accordions', 'toggles', 'tabs', 'table', 'promobox', 'profile', 'highlighter', 'dpslideshow', 'flexbox');

    foreach ($add_sc as $key => $value) {
        $arr_shortcodes[$value] = $$value;
    }

    foreach ($arr_shortcodes as $key => $val){
        if(!in_array($key, $exclude)){
            switch ($key) {
                case 'ss':
                    $val_key = "[".$key." url='' title='Sreenshot Title' caption='This is caption.' ext=1 width=160px hatebu=0 tweets=1 likes=1 class='alignleft' rel=nofollow]\r\n";
                    break;
                case 'googlemap':
                    $val_key = "[".$key." url='' width=100% height=350]\r\n";
                    break;
                case 'label':
                     $val_key = "[".$key." title='Label Title' color='' icon='' text='Next text' class='']\r\n";
                    break;
                case 'button':
                    $val_key = "[".$key." url='#' title='Button Title' color='' icon='' newwindow='' size='' class='' rel=nofollow]\r\n";
                    break;
                case 'font':
                    $val_key = "[".$key." size='14px' color='' bgcolor='' italic='' class='']Decoration text[/".$key."]\r\n";
                    break;
                case 'qrcode':
                    $val_key = "[".$key." url='' size=200px alt='' class='']\r\n";
                    break;
                case 'adsense':
                    $val_key = "[".$key." id='' unitid='' size='rect']\r\n";
                    break;
                case 'linkshare':
                    $val_key = "[".$key." url='' token='' mid='' title='' price='' cat='' dev='' size='' class='' rel='']\r\n";
                    break;
                case 'phg':
                    $val_key = "[".$key." url='' token='' title='' price='' cat='' dev='' size='' class='' rel='']\r\n";
                    break;
                case 'youtube':
                    $val_key = "[".$key." id='' width='100%' height=350 rel=1]\r\n";
                    break;
                case 'mostviewedposts':
                    $val_key = "[".$key." num=5 thumb=1 term='' views=1 cat='' date=0 year='' month='' hatebu=0 likes=1 tweets=1 ranking=1 excerpt=0]\r\n";
                    break;
                case 'recentposts':
                    $val_key = "[".$key." num=5 cat='' date=0 sort='post_date' hatebu=0 excerpt=0]\r\n";
                    break;
                case 'toggles':
                    $val_key = "[".$key." class='' style='']\r\n[toggle title='Title 1' class='' style='']\r\nFirst Toggle Content\r\n[/toggle]\r\n[toggle title='Title 2' class='' style='']\r\nSecond Toggle Content\r\n[/toggle]\r\n[toggle title='Title 3' class='' style='']\r\nThird Toggle Content\r\n[/toggle]\r\n[/".$key."]\r\n";
                    break;
                case 'accordions':
                    $val_key = "[".$key." class='' style='']\r\n[accordion title='Title 1' class='' style='']\r\nFirst Accordion Content\r\n[/accordion]\r\n[accordion title='Title 2' class='' style='']\r\nSecond Accordion Content\r\n[/accordion]\r\n[accordion title='Title 3' class='' style='']\r\nThird Accordion Content\r\n[/accordion]\r\n[/".$key."]\r\n";
                    break;
                case 'tabs':
                    $val_key = "[".$key." class='']\r\n[tab title='Title 1' class='' icon='']\r\nFirst Tab Content\r\n[/tab]\r\n[tab title='Title 2' class='' icon='']\r\nSecond Tab Content\r\n[/tab]\r\n[tab title='Title 3' class='' icon='']\r\nThird Tab Content\r\n[/tab]\r\n[/".$key."]\r\n";
                    break;
                case 'table':
                    $val_key = "[".$key." width=100% highlight='' hoverrowbgcolor='' hoverrowfontcolor='' hovercellbgcolor='' hovercellfontcolor='' sort='' class='']\r\n[tablehead title='1st col,2nd col,3rd col' class='']\r\n[tablerow title='' align='center' width='' class='' bgcolor='']\r\n[tablecell width='' align='' bgcolor='']\r\nCell 1-1\r\n[/tablecell]\r\n[tablecell width='' align='' bgcolor='']\r\nCell 1-2\r\n[/tablecell]\r\n[tablecell width='' align='' bgcolor='']\r\nCell 1-3\r\n[/tablecell]\r\n[/tablerow]\r\n[tablerow title='' align='center' width='' class='' bgcolor='']\r\n[tablecell width='' align='' bgcolor='']\r\nCell 2-1\r\n[/tablecell]\r\n[tablecell width='' align='' bgcolor='']\r\nCell 2-2\r\n[/tablecell]\r\n[tablecell width='' align='' bgcolor='']\r\nCell 2-3\r\n[/tablecell]\r\n[/tablerow]\r\n[tablerow title='' align='center' width='' class='' bgcolor='']\r\n[tablecell width='' align='' bgcolor='']\r\nCell 3-1\r\n[/tablecell]\r\n[tablecell width='' align='' bgcolor='']\r\nCell 3-2\r\n[/tablecell]\r\n[tablecell width='' align='' bgcolor='']\r\nCell 3-3\r\n[/tablecell]\r\n[/tablerow]\r\n[/tablehead]\r\n[/".$key."]\r\n";
                    break;
                case 'promobox':
                    $val_key = "[".$key." column=3 class='']\r\n[promo title='Promo Title' titlecolor='' titlehovercolor='' titlesize=16px titlebold=1 icon='icon-mobile' iconstyle='square' iconsize=40px iconrotate='' iconscale='' iconcolor='' iconhovercolor='' iconbgcolor='' iconbdcolor='' iconbdwidth='' iconalign='' bgcolor='' bghovercolor='' imgurl='' url='' target='']\r\nPromotion Text Here.\r\n[/promo]\r\n[promo title='Promo Title' titlecolor='' titlehovercolor='' titlesize=16px titlebold=1 icon='icon-laptop' iconstyle='round' iconsize=40px iconrotate='' iconscale='' iconcolor='' iconhovercolor='' iconbgcolor='' iconbdcolor='' iconbdwidth='' iconalign='' bgcolor='' bghovercolor='' imgurl='' url='' target='']\r\nPromotion Text Here.\r\n[/promo]\r\n[promo title='Promo Title' titlecolor='' titlehovercolor='' titlesize=16px titlebold=1 icon='icon-desktop' iconstyle='circle' iconsize=40px iconrotate='' iconscale='' iconcolor='' iconhovercolor='' iconbgcolor='' iconbdcolor='' iconbdwidth='' iconalign='' bgcolor='' bghovercolor='' imgurl='' url='' target='']\r\nPromotion Text Here.\r\n[/promo]\r\n[/".$key."]\r\n";
                    break;
                case 'filter':
                    $val_key = "[".$key." url='' blur='' blurval=4px grayscale='' grayscaleval=100% saturate='' saturateval=0% sepia='' sepiaval=100% brightness='' brightnessval=80% contrast='' contrastval=80% opacity='' opacityval=80% invert='' invertval=100% hue='' hueval=180deg width='' height='' class='' alt='']\r\n";
                    break;
                case 'highlighter':
                    $val_key = "[".$key." type=0 time=3000 fadetime=2000 class='']\r\n[highlight class='' style='']First Highlight Text[/highlight]\r\n[highlight class='' style='']Secound Highlight Text[/highlight]\r\n[highlight class='' style='']Third Highlight Text[/highlight]\r\n[/".$key."]\r\n";
                    break;
                case 'profile':
                    $val_key = "[".$key." name='Your Name' namesize=18px namecolor='' namebold=1 nameitalic='' authorurl='' profimgurl='http://demo.dptheme.net/dp7/wp-content/uploads/sites/2/girl-flowers1-620x422.jpg' profsize=100px profshape=circle profbdwidth=5px topbgimgurl='' topbgcolor=#dddddd bgcolor=#ffffff desccolor=#888888 descfontsize=12px border=1 bdcolor=#dddddd twitterurl='' facebookurl='' googleplusurl='' youtubeurl='' pinteresturl='' width=100% class='']\r\nInsert Your Profile.\r\n[/".$key."]\r\n";
                    break;
                case 'dpslideshow':
                    $val_key = "[".$key." fx='fade' showtime=3500 transitiontime=1200 autoplay=true hoverpause=false showcontrol=true controlpos=center nexttext=Next prevtext=Prev showpagenavi=true pagenavipos=center captionblack=false class='' style='']\r\n[dpslide imgurl='http://demo.dptheme.net/_wp/wp-content/uploads/vegetables.jpg' url='' caption=' This is slide caption.' class='' style='']\r\n<p class='ft22px b white mg30px-top mg20px-l al-c'>You can add the original HTML contents like this.</p>\r\n[/dpslide]\r\n[dpslide imgurl='http://demo.dptheme.net/_wp/wp-content/uploads/vase.jpg' url='' caption=' This is slide caption.' class='' style='']\r\n[/dpslide]\r\n[dpslide imgurl='http://demo.dptheme.net/_wp/wp-content/uploads/tenedores.jpg' url='' caption=' This is slide caption.' class='' style='']\r\n[/dpslide]\r\n[/".$key."]\r\n";
                    break;
                case 'flexbox':
                    $val_key = "[".$key." direction=row wrap=nowrap alignh=left alignv='' alignitems=stretch flexchildren='' width=100% height='' class='' style='']\r\n[flexitem flex=1 margin=10 padding='' width='' height='' class='' style='']\r\nFirst Flex Item\r\n[/flexitem]\r\n[flexitem flex=1 margin=10 padding='' width='' height='' class='' style='']\r\nSecond Flex Item\r\n[/flexitem]\r\n[flexitem flex=1 margin=10 padding='' width='' height='' class='' style='']\r\nThird Flex Item\r\n[/flexitem]\r\n[/".$key."]\r\n";
                    break;
                default:
                    $val_key = "[".$key."]\r\n";
                    break;
            }
            $shortcodes_list .= '<option value="'.$val_key.'">'.$key.'</option>';
        }
    }

    $form_code = 
'<select id="dp_sc_select"><option value="">'.__('DP - Shortcodes', DP_SC_PLUGIN_TEXT_DOMAIN).'</option>'.$shortcodes_list.'</select>';

    echo $form_code;
}
add_action('media_buttons', 'dp_sc_add_media_buttons', 11);


// *********************************
// Load javascript and css for admin page
// *********************************
function dp_sc_enqueue_css_js() {
    if (!is_admin()) return;
    $admin_js_url     = plugins_url("../js/admin.min.js", __FILE__);
    wp_enqueue_script('jquery','https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js');
    wp_enqueue_script('dp_sc_admin_js', $admin_js_url, array('jquery'));
}
add_action('admin_print_scripts', 'dp_sc_enqueue_css_js');
