<?php if(!defined('IN_GS')){ die('you cannot load this page directly.'); } 

	# get correct id for plugin
	$SafeEmail=basename(__FILE__, ".php");	

	# add in this plugin's language file
	i18n_merge($SafeEmail) || i18n_merge($SafeEmail, 'en_US');

	# register plugin
	register_plugin(
		$SafeEmail,								# ID of plugin, should be filename minus php
		i18n_r($SafeEmail.'/lang_Menu_Title'), 	# Title of plugin
		'1.0',									# Version of plugin
		'islander',								# Author of plugin
		'https://tinyurl.com/gs-islander',		# Author URL
		i18n_r($SafeEmail.'/lang_Description'), # Plugin Description
		'plugins',								# Page type of plugin
		'SafeEmail_settings'					# Function that displays content
	);

	# Front-End Hooks
	add_action('theme-footer','SafeEmail_js'); 

	# Back-End Hooks
	add_action('plugins-sidebar','createSideMenu', array($SafeEmail, i18n_r($SafeEmail.'/lang_Menu_Title')));

	# ===== function FrontEnd Footer ===== #

	function SafeEmail_js() {
		echo '
		<script src="'.$SITEURL.'plugins/SafeEmail/safe-email.js"></script>';
	}
	
	# ===== function Plugin ===== #
	
	function SafeEmail_settings() {
		global $SITEURL;
		echo '<link href="'.$SITEURL.'plugins/SafeEmail/style.min.css" rel="stylesheet">';
		echo '
		<div class="my-plugin">
		
			<div class="container">
				<div class="row">
					<div class="col-12 center">
						<h3>'.i18n_r("SafeEmail/lang_Page_Title").'</h3>
						<p>'.i18n_r("SafeEmail/lang_Description").'</p>
					</div>
				</div>
			</div>
			
			<hr class="style-one">';
?> 

		<style>.container{display:flex;flex-direction:column;align-items:center;width:100%}.container>*:not(:last-child){margin-bottom:10px}.input{height:40px;font-size:1rem;padding-left:20px;width:90%;max-width:400px}.result{display:flex;flex-direction:column;align-items:center;width:100%}.result>*:not(:last-child){margin-bottom:10px}.title{text-transform:uppercase}.error{color:red}.text{overflow-wrap:break-word;word-break:break-all;padding-left:10%;padding-right:10%}.code{white-space:pre-wrap}.encoded{font-size:2rem}.copy{background-color:var(--main-color);border:transparent;border-bottom:2px solid var(--secondary-color);border-radius:5px;padding:10px;min-width:100px;color:#fff}.copy:hover,.copy:focus{background-color:#48A1C1;border-bottom:2px solid #38AFDD;transition:all .3s ease-in;-webkit-transition:all .3s ease-in;-moz-transition:all .3s ease-in;-o-transition:all .3s ease-in}.my-plugin input{text-align:center}.my-plugin ::placeholder{text-align:center}.my-plugin ::-webkit-input-placeholder{text-align:center}.my-plugin :-moz-placeholder{text-align:center}</style>
		
		<div class="container">
			<h4 class="title"><?php echo i18n_r("SafeEmail/lang_Email");?></h4>
			
			<input class="input" type="text" maxlength="254" id="input" placeholder="Type your email (e.g. email@gmail.com)" data-on-input="onInputChanged($event)">
			<div class="error" data-if="encodedText && !isValidEmail">
				<?php echo i18n_r("SafeEmail/lang_Invalid");?>
			</div>
			
			<div class="result" data-if="exampleSimple">
				<h4>HTML</h4>
				<p><?php echo i18n_r("SafeEmail/lang_Paste");?></p>
				<pre class="code shortcode tpl">{{ exampleSimple }}</pre>
				<button class="copy" onclick="copyText('exampleSimple')"><?php echo i18n_r("SafeEmail/lang_Copy");?></button>
			</div>
			
		</div>
		<hr class="style-two" style="margin:30px 0;">
		<div class="row">
			<div class="col-12 center">
				<p class="smaller" style="margin-bottom:0;">Plugin adapted from: <a href="https://github.com/undergroundwires/safe-email" target="_blank" style="d:none;">safe-email</a></p>
			</div>
			<div class="col-6 center">
				<p class="small" style="margin-bottom:0;">Created by: <img src=" data:image/gif;base64,R0lGODlhIAAgAKIHAGBgYO/v7yAgIL+/v39/fxAQEAAAAP///yH5BAEAAAcALAAAAAAgACAAAAP/eHox+zDKFUARhsy9BQiMoHEL4EiD8KTkYhQnNACQsQG4k9EBASqBwu/AmlgIHkNAiYkdAALQAMaBBjAHg0fg7BW0zsiAcBkYzCYVqbhIiZAAQo46kX4ZA8eFwO8/tX1DClMzBBkvBQd9fAAGZ4sFQjKRXIB0FAWNmlAmEUGGoAZxgjgWMzBhD1B9b6aDXDAwVhJfjme2tjQHInFEmRcoBYyNZzJRSkB+Ej0CwqLIJYwtD2RTZDgPSr3TRFpUcVyvu6kceT9ycgqjNtzLtyAmM+1GKTo9uvMQi0GKI/kreQY0UESO2z0Mtjz4+JciUx6AFsJNc1OQmgCJG6zNIzQhNU+ngUAEhhySZ8RDIlBgVNjjxYOiCyrcKJnRLI8wIhh8TMkUIIgHB1DCpfQnY0hPCk6SCkoAADs="> islander</p>
			</div>
			<div class="col-6 center">
				<p><a href="https://www.paypal.com/donate/?hosted_button_id=C3FTNQ78HH8BE" target="_blank"><img src="         data:image/gif;base64,R0lGODlhyAAgAKIHAGpqbeLp7is5lR2t8a6urkZGRgAAAP///yH/C1hNUCBEYXRhWE1QPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4gPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iQWRvYmUgWE1QIENvcmUgNS42LWMxNDUgNzkuMTYzNDk5LCAyMDE4LzA4LzEzLTE2OjQwOjIyICAgICAgICAiPiA8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPiA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIiB4bWxuczpzdFJlZj0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL3NUeXBlL1Jlc291cmNlUmVmIyIgeG1wOkNyZWF0b3JUb29sPSJBZG9iZSBQaG90b3Nob3AgQ0MgMjAxOSAoV2luZG93cykiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6RkNGMEI1MzI0QjAzMTFFRTlEMERFNkQzRTFDNjJENkMiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6RkNGMEI1MzM0QjAzMTFFRTlEMERFNkQzRTFDNjJENkMiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDpGQ0YwQjUzMDRCMDMxMUVFOUQwREU2RDNFMUM2MkQ2QyIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDpGQ0YwQjUzMTRCMDMxMUVFOUQwREU2RDNFMUM2MkQ2QyIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PgH//v38+/r5+Pf29fTz8vHw7+7t7Ovq6ejn5uXk4+Lh4N/e3dzb2tnY19bV1NPS0dDPzs3My8rJyMfGxcTDwsHAv769vLu6ubi3trW0s7KxsK+urayrqqmop6alpKOioaCfnp2cm5qZmJeWlZSTkpGQj46NjIuKiYiHhoWEg4KBgH9+fXx7enl4d3Z1dHNycXBvbm1sa2ppaGdmZWRjYmFgX15dXFtaWVhXVlVUU1JRUE9OTUxLSklIR0ZFRENCQUA/Pj08Ozo5ODc2NTQzMjEwLy4tLCsqKSgnJiUkIyIhIB8eHRwbGhkYFxYVFBMSERAPDg0MCwoJCAcGBQQDAgEAACH5BAEAAAcALAAAAADIACAAAAP/eLrc/jDKSau9OOvNu/9gKI5kaZ5oqq5s675lUSgyPcMKATAAYQGFXYNwi+gsxwcx6MMFCNAoIdAxGKhW7BV3SCp6lUChOSxCvByxT0eFEQTwOJycyR7sdhwavARQA0BjBzJjYAc9RAxEQH5dO4Z8MkCOhwCMlAdqOABynW0ZNYM3oXpCX1OClpUBgKg+kFBmRGs7R7CzgDO2fpoLRJ8unJ1xwFwie6iGvWypTYiyBX/Rts5QQonUp76CMAHDcgPFxh/IjjKohEGat7KmY9mHOk3Yj9U53N3fcQMDYQBWAAMKtNKoxa8Fhu6JAbauWqJt0p7Uo2HtHiVYOUy50SeA/184Cv8GigyoUcWyaJp+WWLVY12td9BoXXwZa8okeAnHvdHnsYIVOhIIWHmhQ9I8Qj5yBckkKJelWIqCqKPkNFKQWhPjZTQmbJjHfhTyUAgwdJwJND9Kmn3Q6atHcQ/EThBqBd9acmrPBCp494G3fW4/VihgAKgRgXn7Kja7E85bVnAh/DMj4d8UoZQXazbWuCO/DWS3TAj9p+zm01x0WHrLgbBhB5iZGsjcYYmkyJuXFH097ivuuXIdiBn4O0MSQIlzvzztuwPhaBCGB4Q+wsuRJPJMJVStDogzSQ2U8r3Hbe8TSYTOTz0EHgVkCe/Dw687hcH54CSO87m2oyn1Lv8oqfMLG60osgNyUdVEoCrX6SLIdbzkNMJfAuDG2gIBgBWBdCP9d4Jt52BynUy+CBFJgZjAplE5AEoEICYLGYKWCN6gKFw4gimQ4VhEDDRGcSBYNw1/mWS1lVYqpUOZNUuVyAA3Ay4HYiFKfhhHY4A8McVbXAJ5l5AuVnKKh0mcKCFCiKjiJEJHuUhPA2eW0JI3UFRoSYX8sBJOhnyiNoQpELJ0TZNrnsiGmGwCuOKPaQpKCTYPDkmFmiVU+IUwXVgqmG85NkDYSKDSFmQ6jVQlRC+FrgGdeVExUVIfX9z26A19fDdVnB18oiUrAjTBio6Q/QrBp6CKJCpR4/l51xMUyqLgXbPQRivttNRWa+212GZrVgIAOw==" title="Donate?" alt="Donate?"></a></p>
			</div>
		</div>
	
	</div>
	
    <script src="<?php echo ''.$SITEURL.'plugins/SafeEmail/encoder/binding.js'; ?>"></script>
	<script type="text/javascript">
		const state = dataBinding({
			encodedText: '',
			exampleSimple: '', 
			isValidEmail: false,
		});
		function onInputChanged(value) {
			if(value && value.length > 254) {
				const errorText = 'Too long 😱';
				state.encodedText = errorText
				state.exampleSimple = errorText;
				return;
			}
			state.encodedText = btoa(value);
			state.exampleSimple = `<a title="Email" href="#" data-email_b64="${state.encodedText}" data-subject="Inquiry From Website" data-body="Hello!"></a>`;
			state.isValidEmail = validateEmail(value);
		}
		function copyText(key) {
			const input = document.createElement('textarea');
			document.body.appendChild(input);
			input.value = state[key];
			input.focus();
			input.select();
			document.execCommand('Copy');
			input.remove();
		}
		function validateEmail(email) {
			const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{1,}))$/;
			return re.test(email);
		}
	</script>
	
<?php 
	}
?> 