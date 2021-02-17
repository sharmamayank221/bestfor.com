<?php
/**
 * Template Name:Contact us 
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();


if ( is_front_page() ) {
	get_template_part( 'global-templates/hero' );
}
?>

<div class="wrapper" id="full-width-page-wrapper">

	

<section class="page-title">
	<h1>Contact Us</h1>
	
</section>

<section class=" ">
    
    <div class="contact-form-holder">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="contact-page-form-section">
                                            <h3>Talk to Us?</h3>
                            <p>You have questions and we have answers. Contact us today, we’re here to help.</p>
                            <?php
                        echo do_shortcode('[wpforms id="145"]');
                        ?> 
                    </div>
       
                </div>
                <div class="col-lg-4">
                    <div class="contact-page-form-section-right">
                        <h3>Talk to a sales representative</h3>
                        <div class="phone-details">
                            <i class="icon-phone"></i><a href="tel:+30 2311244333">+30 2311244333</a>
                        </div>
                        <div class="email-details">
                            <i class="icon-envelope-letter"></i><a href="mailto:info@bestfor.com">info@bestfor.com</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
</section>			
	

<section class="google-map-holder" >
    <h2>Our stores around the world</h2>
   <iframe src="https://www.google.com/maps/d/embed?mid=1OTAu7GKxgSx-I8bDAIx0PUWKFfS9ow-t" frameborder="0"></iframe>
</section>
<section class="map-locations">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <ul>
                <li>
                    <div class="icon-address-map">
                        <i class="icon-location-pin"></i>
                    </div>
                    <div class="map-location-details">
                        <h3>Marousi, Athens – Greece</h3>
                        <p>8th Dimitros str, Marousi, Attica</p>
                    </div>
                </li>
                <li>
                    <div class="icon-address-map"> <i class="icon-location-pin"></i></div>
                    <div class="map-location-details">
                        <h3>Alexandroupoli – Greece</h3>
                        <p>45th El. Venizelou str, Alexandroupoli</p>
                    </div>
                </li>
                <li>
                    <div class="icon-address-map"> <i class="icon-location-pin"></i></div>
                    <div class="map-location-details">
                        <h3>Kozani – Greece</h3>
                        <p>7th Makedonomachon str, Kozani</p>
                    </div>
                </li>
                <li>
                    <div class="icon-address-map"> <i class="icon-location-pin"></i></div>
                    <div class="map-location-details">
                        <h3>Peraia – Greece</h3>
                        <p>44th Ampelokipon str, Peraia, Thessaloniki</p>
                    </div>
                </li>
                <li>
                    <div class="icon-address-map"> <i class="icon-location-pin"></i></div>
                    <div class="map-location-details">
                        <h3>Kalamata – Greece</h3>
                        <p>10th Valaoritou str, Kalamata</p>
                    </div>
                </li>
                <li>
                    <div class="icon-address-map"> <i class="icon-location-pin"></i></div>
                    <div class="map-location-details">
                        <h3>Rethymno, Crete – Greece</h3>
                        <p>174th Arkadiou str, Rethimno, Crete</p>
                    </div>
                </li>
                <li>
                    <div class="icon-address-map"> <i class="icon-location-pin"></i></div>
                    <div class="map-location-details">
                        <h3>Heraklion, Crete – Greece</h3>
                        <p>54th Kalokairinou Ave, Heraklion, Crete</p>
                    </div>
                </li>
                <li>
                    <div class="icon-address-map"> <i class="icon-location-pin"></i></div>
                    <div class="map-location-details">
                        <h3>Karditsa – Greece</h3>
                        <p>20th Valvi str, Karditsa</p>
                    </div>
                </li>
                <li>
                    <div class="icon-address-map"> <i class="icon-location-pin"></i></div>
                    <div class="map-location-details">
                        <h3>Thessaloniki – Greece</h3>
                        <p>One Salonica Mall, Thessaloniki</p>
                    </div>
                </li>
                <li>
                    <div class="icon-address-map"> <i class="icon-location-pin"></i></div>
                    <div class="map-location-details">
                        <h3>Larnaca – Cyprus</h3>
                        <p>62st Ermou str, Larnaca</p>
                    </div>
                </li>
                <li>
                    <div class="icon-address-map"> <i class="icon-location-pin"></i></div>
                    <div class="map-location-details">
                        <h3>Larnaca 2 – Cyprus</h3>
                        <p>Mall of Larnaca</p>
                    </div>
                </li>
                <li>
                    <div class="icon-address-map"> <i class="icon-location-pin"></i></div>
                    <div class="map-location-details">
                        <h3>Lemesos – Cyprus</h3>
                        <p>71st Anexartisias str, Lemesos</p>
                    </div>
                </li>
                <li>
                    <div class="icon-address-map"> <i class="icon-location-pin"></i></div>
                    <div class="map-location-details">
                        <h3>Boucharest – Romania</h3>
                        <p>Plaza Mall of Boucharest</p>
                    </div>
                </li>
                <li>
                    <div class="icon-address-map"> <i class="icon-location-pin"></i></div>
                    <div class="map-location-details">
                        <h3>Podgorica – Montenegro</h3>
                        <p>TC Mall of Montenegro</p>
                    </div>
                </li>
                <li>
                    <div class="icon-address-map"> <i class="icon-location-pin"></i></div>
                    <div class="map-location-details">
                        <h3>Ahmedabad – Indiae</h3>
                        <p>Ahmedabad, Gujarat</p>
                    </div>
                </li>
                <li>
                    <div class="icon-address-map"> <i class="icon-location-pin"></i></div>
                    <div class="map-location-details">
                        <h3>Kolhapur – India</h3>
                        <p>Kolhapur, Maharashtra</p>
                    </div>
                </li>
                <li>
                    <div class="map-address-last-row">
                    <div class="icon-address-map"> <i class="icon-location-pin"></i></div>
                       <div class="map-location-details">
                        <h3>Beirut – Lebanon</h3>
                        <p>City Center Beirut, Lebanon</p>
                       </div>
                </li>
                <li>
                    <div class="icon-address-map"> <i class="icon-location-pin"></i></div>
                    <div class="map-location-details">
                        <h3>Boucharest – Romania</h3>
                        <p>Plaza Mall of Boucharest</p>
                    </div>
                </li>
                <li>
                    <div class="icon-address-map"> <i class="icon-location-pin"></i></div>
                    <div class="map-location-details">
                        <h3>Dbayeh – Lebanon</h3>
                        <p>Le Mall Dbayeh, Lebanon</p>
                    </div>
                </li>
                <li>
                    <div class="icon-address-map"> <i class="icon-location-pin"></i></div>
                    <div class="map-location-details">
                        <h3>Riyadh – Saudi Arabia</h3>
                        <p>Eastern Ring Road, AlSumo Center, exit 14</p>
                    </div>
                </li>
                <li>
                    <div class="icon-address-map"> <i class="icon-location-pin"></i></div>
                    <div class="map-location-details">
                        <h3>Riyadh 2nd – Saudi Arabia</h3>
                        <p>Hayat Mall, King Abdulaziz Road</p>
                    </div>
                </li>
                <li>
                <div class="icon-address-map"> <i class="icon-location-pin"></i></div>
                    <div class="map-location-details">
                        <h3>Doha – Qatar</h3>
                        <p>Coming Soon…</p>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</section>


</div><!-- #full-width-page-wrapper -->

<?php
get_footer();
