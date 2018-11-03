<!-- BEGIN: TOOLS PAGE -->
<template id="earn_page">

<div id="content" class="container-fluid">
<div class="container">
<div class="row" id="main">
<div class="col-xs-12 content-terms">
<h1>Affiliate Program - Earn Money!</h1>
<h3 class="other-title">With <# SITE_NAME #> you can earn money sharing your images!</h3>
<div class="content-text"><# SITE_NAME #> lets you earn cash by sharing images with your family and friends: every time a visitor views one of your images, you are automatically credited with a variable amount of money (depending on many factors, look at the table bellow.) 
<ul class="intext">
<li>No limits! Upload any amount of images.</li>
<li>We pay for all countries</li>
<li>We pay up $1.00 per 1,000 views</li>
<li>Payment methods: Paypal or Payza
(Skrill soon)</li>
<li>Minimum payout is $5 only</li>
<li>Payments are processed every Friday</li>
<li>Unique IP is counted once per 24 hours.</li>
<li>We allow adult content (legal).</li>
<li>Refer others and earn 10% of their earnings!</li>
</ul>
</div>
<h3 class="other-title">Table Rates</h3>

<table class="table table-responsive table-striped table-hover">
<tbody>
<tr>
	<th style="width: 10%;">Group</th>
	<th>Countries</th>
	<th>$ / 1000 Views.</th>
</tr>
<tr>
	<td>Group A</td>
	<td>Australia, Canada, New Zealand, United Kingdom, United States.</td>
	<td>$ 1.00</td>
</tr>
<tr>
	<td>Group B</td>
	<td>Austria, Belgium, Denmark, Finland, France, Germany, Greece, Ireland, Italy, Luxembourg, Netherlands, Norway, Portugal, Spain, Sweden, Switzerland.</td>
	<td>$ 0.50</td>
</tr>
<tr>
	<td>Group C</td>
	<td>Cyprus, Czech Republic, Estonia, Hungary, Israel, Japan, Latvia, Lithuania, Poland, Russia, Slovakia.</td>
	<td>$ 0.25</td>
</tr>
<tr>
	<td>Group D</td>
	<td>All others</td>
	<td>$ 0.10</td>
</tr>
</tbody>
</table>


<div class="content-text">
<div class="content-text-bigger">Start using <strong>imgwolf.com</strong> today and benefit of the fast and unlimited upload speed, easy handling and money earnings.</div>
<if="$mmhclass->info->is_user == true">

<else>
	<p style="text-align: center;">
	<button class="main-button btn-md">Sign up</button>
</p>
</endif>
</div>
</div> 
</div>
</div>
</div>

</template>

<!-- END: TOOLS PAGE -->