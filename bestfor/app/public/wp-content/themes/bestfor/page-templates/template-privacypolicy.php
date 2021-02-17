<?php
/**
 * Template Name: Privacy Policy
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

	

		<div class="row">

			<div class="col-md-12 content-area" id="primary">

				<main class="site-main" id="main" role="main">
                     
                <section class="page-title">
	             <h1>Privacy Policy & Cookies</h1>
	
                </section>
                 
                 <section class="privacy-policy-page-content">
                   <h2>Privacy Policy - GDPR</h2>

                   <h4>PRIVACY POLICY</h4>
                   <p>Our company prioritizes the security of your personal data and has 
                   therefore harmonized all of its services and their implementation 
                   with the National and European Legislation, in particular with the 
                   new Personal Data Protection (EU) Regulation . 679/2016 (GDPR).

                    Through our privacy policy, we inform you, on the one hand, 
                    of our company’s practices regarding the processing of your 
                    personal data and, on the other hand, of the rights you have 
                    as the subject of such data. By doing so, you will be able to 
                    provide us with your explicit consent to the collection and 
                    processing of your personal data, which you may revoke or modify 
                    at any time.</p>

                    <h4>THE PERSONAL DATA WE PROCESS </h4>
                    <p>According to Regulation (EU) 679/2016 (GDPR), personal data is information relating to a person identified or identifiable in life. Different information which, if grouped together, can lead to the identification of a particular person, are also personal data. Personal data that have become anonymous have been encrypted or 
                    have been aliquoted but can be used to re-establish a person, remain personal 
                    data and fall within the scope of the GDPR. Personal data that have become 
                    anonymous so that the individual is not identifiable are no longer considered
                     personal data. For the data to be truly anonymous, anonymization must be irreversible. 
                     The GDPR protects personal data irrespective of the technology used to process it. It is 
                     technologically neutral and applies to both automated and manual processing. It also does 
                     not matter how the data is stored – in digital or paper form.

                    Only the company and its authorized agents will be able to access the personal data, 
                    strictly for the purpose of handling the transaction with you. Data we collect 
                    is for example the name, address, mobile phone number, landline number, e-mail address 
                    and usage data such as membership name, password, and IP address. In some cases, age, gender, 
                    interests and favorites, when you provide it to yourself on your own initiative.</p>

                    <h4>TREATMENT OBJECTIVES</h4>
                    <p>Our company collects, maintains and processes your personal data only when you voluntarily provide it to us for the following purposes:</p>
                    <ul>
                        <li>To communicate with users and resolve any disputes.</li>
                        <li>To provide customer service, such as for bidding and informational emails.</li>
                        <li>To inform users about promotions, new products, offers of our company or even competitions that propose or participate in exhibit initiatives.</li>
                        <li>Informing users about various events in which our company participates or organizes.</li>
                    </ul>

                            <ul>
                            <li>To offer personalized experience on our sites</li>
                            <li>To obtain information on how our site is used by our visitors in order to continually improve it.</li>
                            <li>For research and statistical purposes relating to the operation of our website.</li>
                            </ul>

                 <h4>WAYS OF COLLECTING PERSONAL DATA</h4>
                 <p>We collect your personal information when:</p>
                 <ul>
                     <li>You use the services of our website.</li>
                     <li>You sign up for the newsletter subscriber list.</li>
                     <li>You provide us with information about you in the forms of communication on the website or on printed forms of transaction during your onsite and personal 
                     presence at our company’s premises or our distribution network or at our external partner’s facilities.</li>
                     <li>You submit an evaluation of a product or service.</li>
                     <li>You submit a comment on our company’s blog.</li>
                 </ul>

                 <h4>YOUR RIGHTS</h4>
                 <p>You have the right at any time to:</p>
                 <ul>
                     <li>Receive confirmation as to whether your personal data is available and 
                     be informed of its content and origin, verify its accuracy and ask for its correction, update or modification</li>
                     <li>Request the removal, anonymization or limitation of the processing of your personal data processed in violation of the applicable law</li>
                     <li>Oppose the processing, in all cases, of your personal data for legitimate reasons.</li>
                 </ul>
                 <p>You can send your request to the address listed below. In your request, 
                 please include your email address, name, address, and phone number and clearly 
                 specify which information you want to access, change, update, remove, or delete. 
                 We remind you that even after you cancel your account or if you ask us to delete 
                 your personal data, copies of some information from your account may still be visible 
                 in some cases where, for example, you have shared information on social media or 
                 to other services or, for example, where the maintenance of such copies is necessary 
                 for the purposes of complying with legal obligations or for purposes of legal defense. 
                 Due to the nature of the caching technology, your account may not be immediately 
                 inaccessible to others. We may also keep backup information about your account on 
                 our servers for some time after your cancellation or removal request
                  for purposes of compliance with applicable law.</p>
                 </section>


				</main><!-- #main -->

			</div><!-- #primary -->

		</div><!-- .row end -->

	

</div><!-- #full-width-page-wrapper -->

<?php
get_footer();
