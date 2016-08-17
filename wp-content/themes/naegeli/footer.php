<footer id="footer" class="site-footer" role="contentinfo">
<div class="container">
		<div class="row">
			<div class="col-md-2">
				<img src="<?php echo get_template_directory_uri().'/images/powerful-litigation-support-wh.png'; ?>" class="img-responsive">
				<img src="<?php echo get_template_directory_uri().'/images/35years.png'; ?>" class="img-responsive">
			</div>
			<div class="col-md-8">
				<div class="row">
					<div class="col-md-12">
						<!--start-->
							<div class="widget_wysija_cont html_wysija">
							<div id="msg-form-wysija-html5694a5ae548e6-1" class="wysija-msg ajax"></div>
							<form id="form-wysija-html5694a5ae548e6-1" method="post" action="#wysija" class="form-inline widget_wysija html_wysija">
							<p class="wysija-paragraph">
							<input type="text" name="wysija[user][email]" id="emailid" class="form-control wysija-input validate[required,custom[email]]" title="ENTER EMAIL ADDRESS TO RECEIVE NEWSLETTER" placeholder="EMAIL ADDRESS FOR NEWSLETTER" value="" />
							
							<span class="abs-req">
							<input type="text" name="wysija[user][abs][email]" class="wysija-input validated[abs][email]" value="" />
							</span>
							<input class="sub btn btn-danger wysija-submit wysija-submit-field" type="submit" value="Subscribe" />
							</p>

							<input type="hidden" name="form_id" value="1" />
							<input type="hidden" name="action" value="save" />
							<input type="hidden" name="controller" value="subscribers" />
							<input type="hidden" value="1" name="wysija-page" />


							<input type="hidden" name="wysija[user_list][list_ids]" value="1" />

							</form></div>
						<!--end-->
					</div>
				</div>
				<div class="row footerlinks">
					<div class="col-md-3 resources">
						<h3>RESOURCES</h3>
						<?php wp_nav_menu( array( 'theme_location' => 'secondry', 'menu' => 'resources' ) ); ?>
					</div>
					<div class="col-md-3 about">
						<h3>ABOUT</h3>
						<?php wp_nav_menu( array( 'theme_location' => 'secondry', 'menu' => 'about' ) ); ?>
					</div>
					<div class="col-md-3 contact">
						<h3>CONTACT</h3>
						<P>Corporate Headquarters<br>
						 111 S.W. Fifth Avenue, Suite 2020<br>
						 Portland, OR 97204 USA<br>
						(800) 528-3335</P>
					</div>
					<div class="col-md-3 social">
						<h3>FOLLOW</h3>
						<?php wp_nav_menu( array( 'theme_location' => 'secondry', 'menu' => 'social' ) ); ?>
					</div>
				</div>
			</div>
			<div class="col-md-2">
				<img src="<?php echo get_template_directory_uri().'/images/naegeli-deposition-and-trial-expect-excellence.jpg'; ?>" class="img-responsive">
			</div>
		</div>

		<div class="row site-info">
			<div class="col-md-12 col-xs-12"><p>&COPY; <?php echo date('Y'); ?> NAEGELI Deposition and Trial | All Rights Reserved</p></div>
		</div>
</div>
</footer>
<?php wp_footer(); ?>
<!-- begin olark code -->
<script data-cfasync="false" type='text/javascript'>/*<![CDATA[*/window.olark||(function(c){var f=window,d=document,l=f.location.protocol=="https:"?"https:":"https:",z=c.name,r="load";var nt=function(){
f[z]=function(){
(a.s=a.s||[]).push(arguments)};var a=f[z]._={
},q=c.methods.length;while(q--){(function(n){f[z][n]=function(){
f[z]("call",n,arguments)}})(c.methods[q])}a.l=c.loader;a.i=nt;a.p={
0:+new Date};a.P=function(u){
a.p[u]=new Date-a.p[0]};function s(){
a.P(r);f[z](r)}f.addEventListener?f.addEventListener(r,s,false):f.attachEvent("on"+r,s);var ld=function(){function p(hd){
hd="head";return["<",hd,"></",hd,"><",i,' onl' + 'oad="var d=',g,";d.getElementsByTagName('head')[0].",j,"(d.",h,"('script')).",k,"='",l,"//",a.l,"'",'"',"></",i,">"].join("")}var i="body",m=d[i];if(!m){
return setTimeout(ld,100)}a.P(1);var j="appendChild",h="createElement",k="src",n=d[h]("div"),v=n[j](d[h](z)),b=d[h]("iframe"),g="document",e="domain",o;n.style.display="none";m.insertBefore(n,m.firstChild).id=z;b.frameBorder="0";b.id=z+"-loader";if(/MSIE[ ]+6/.test(navigator.userAgent)){
b.src="javascript:false"}b.allowTransparency="true";v[j](b);try{
b.contentWindow[g].open()}catch(w){
c[e]=d[e];o="javascript:var d="+g+".open();d.domain='"+d.domain+"';";b[k]=o+"void(0);"}try{
var t=b.contentWindow[g];t.write(p());t.close()}catch(x){
b[k]=o+'d.write("'+p().replace(/"/g,String.fromCharCode(92)+'"')+'");d.close();'}a.P(2)};ld()};nt()})({
loader: "static.olark.com/jsclient/loader0.js",name:"olark",methods:["configure","extend","declare","identify"]});
/* custom configuration goes here (www.olark.com/documentation) */
olark.identify('2723-900-10-8558');/*]]>*/</script><noscript><a href="https://www.olark.com/site/2723-900-10-8558/contact" title="Contact us" target="_blank">Questions? Feedback?</a> powered by <a href="https://www.olark.com?welcome" title="Olark live chat software">Olark live chat software</a></noscript>
<!-- end olark code -->

<script src = 'https://code.jquery.com/jquery-1.12.1.js'></script>
<script>
function cent()
{

console.log($(window).width());
var str = $("#header").height() + parseInt($("#header").css('padding-top')) + parseInt($("#header").css('padding-bottom'));
$("section#blank_header").height(str - 1);

}
jQuery(document).ready(function() {
	cent();
	$('<br class = "menu_break_line">').insertAfter("#primary-menu li:nth-child(4)");

	jQuery(window).resize(function() {
		cent();
	});

});
</script>
</body>
</html>
