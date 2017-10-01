@extends('layouts.app')
@section('content')
	<div id="" class="jumbotron jumbotron-fluid py-5 d-flex align-items-center contactUsJumbotron">
		<div class="container-fluid py-5">
			<h2 class="py-5 text-white display-4">Providing quality living that strengthens communities.</h2>
		</div>
	</div>
	<div class="container">
		<div class="row align-items-center">
			<h1 class="col-2 col-sm-4 text-hide" style="border:1px solid #787878 !important">Hidden Text</h1>
			<h1 class="col-8 col-sm-4 text-muted">Contact Information</h1>
			<h1 class="col-2 col-sm-4 text-hide" style="border:1px solid #787878 !important">Hidden Text</h1>
		</div>
		<div class="row">
			<div class="col-12 col-sm-8 ml-sm-auto mt-4">
				<p>E: {{ $setting->email }}</p>
			</div>
		</div>
		<div class="row">
			<div class="col-12 col-sm-8 ml-sm-auto">
				<p class="">P: {{ $setting->phone }}</p>
			</div>
		</div>
		<div class="row">
			<div class="col-12 col-sm-8 ml-sm-auto mb-4">
				<p>W: <a class="text-truncate" href="{{ route('contact_us') }}">jacksonrealestatehomes.com/contact_us</a></p>
			</div>
		</div>
		<div class="row align-items-center">
			<h1 class="col text-hide my-3" style="border:1px solid #787878 !important">Hidden Text</h1>
		</div>
		<div class="row faq">
			<h3 class="mb-4">Have some questions that need to be answered?&nbsp; Here are some that we have already been asked.</h3>
			<div class="col-12">
				<blockquote><p>Do you rent from month to month?</p></blockquote>
				<p>Yes. A month-to-month status will raise your rent a mandatory 5%. During the month to month, you do not have protection against the owner, if he should desire to sell the property, or ask that the lease be terminated, so we recommend signing a lease extension of at least 6 months. All of our properties are available by lease terms of 12 months, 18 months and 2 years. Certain exceptions apply but only for real estate professionals who work with us regarding referrals and commissions.</p>
			</div>
			<div class="col-12">
				<blockquote><p>What About Roommates, Visitors, and Sub-Leasing?</p></blockquote>
				<p>Roommates will be subject to the same move-in procedures, background checks and requirements as our primary tenants. Roommates may not be moved in without prior written permission and a thorough check is completed and accepted by Property Works. Sub-leasing is never allowable for any reason.</p>
			</div>
			<div class="col-12">
				<blockquote><p>What about smoking?</p></blockquote>
				<p>We do not allow smoking inside of any property that we manage. Smoking can damage sensitive building materials and become an allergen to the tenants that occupy homes after the smoking party has left. By smoking inside of the property, you run the risk of eviction and lawsuit. Therefore, this policy is in force for any tenant that allows any smoking inside their residence. This includes, friends, family, guests, etc. If you are a smoker, or nonsmoker, and do not wish to pay for property damages that come from smoking, please do not allow smoking in your residence.</p>
			</div>
			<div class="col-12">
				<blockquote><p>Do you run a credit check on every applicant?</p></blockquote>
				<p>We do run a credit check on all our applicants, even when your credit is good. This process is necessary for us, and a benefit to our applicants in that a credit check can sometimes uncover false, incorrect or outdated information in your credit report that you will want to address.</p>
			</div>
			<div class="col-12">
				<blockquote><p>What are the penalties for early termination of a lease?</p></blockquote>
				<p>If you decide to move out prior to the end of the lease term then you will be required to give us 30 days written notice, pay rent through that 30 day notice period, and pay a lease termination penalty of one month’s rent upon moving out.</p>
			</div>
			<div class="col-12">
				<blockquote><p>When is the rent due?</p></blockquote>
				<p>Rent is due on the first of each month. A $50.00 flat late fee will be charged if we have not received your rent by the 5th day of the month.</p>
			</div>
			<div class="col-12">
				<blockquote><p>What are the standard lease periods?</p></blockquote>
				<p>Leases are for a period of 12 Months.</p>
			</div>
			<div class="col-12">
				<blockquote><p>Is a personal check acceptable for my first month’s rent and the security deposit?</p></blockquote>
				<p>No. The first month’s rent (including any pro-rated days), and all deposits (security and pets) must be presented in certified funds. After the first month, you may pay your rent in personal check, money order or cashier’s check.</p>
			</div>
			<div class="col-12">
				<blockquote><p>What will I owe at move in?</p></blockquote>
				<p>The balance of the one-month’s rent and the security deposit is due at move-in regardless of the day of the month. If you move in during the middle of a month the prorated rent charge will be due on the first day of the second month you are in the property.</p>
			</div>
			<div class="col-12">
				<blockquote><p>Are there any pet fees?</p></blockquote>
				<p>Some homes allow pets, or certain breeds. If the breed of animal is approved (ask staff) then the pet deposit will be a non-refundable $300 per animal. Usually the pet deposit is. Our professional standards require that the property professionally treated for fleas and the carpet professionally cleaned, after each tenant with a pet, and the Pet Deposit goes to perform these actions.</p>
			</div>
			<div class="col-12">
				<blockquote><p>Is my holding deposit refundable?</p></blockquote>
				<p>In the event the application for residency is not approved or accepted, or if the residence is not ready for occupancy on or before agreed move-in date, the holding deposit will be returned to the applicant. If, however, the applicant is approved, agrees to a move-in date, and the property is removed from the market, and the applicant then fails to sign the rental agreement, fails to provide the additional funds required for occupancy, or does not take occupancy on the agreed upon scheduled move-in date, the holding deposit will be forfeited. The holding deposit shall be applied toward the security deposit or rent when the rental agreement is signed.</p>
			</div>
			<div class="col-12">
				<blockquote><p>Can I hold the home off the market while my application is approved?</p></blockquote>
				<p>A $250.00 home holding deposit can be paid to keep the home out of the hands of competitors, while we run a rental application.</p>
			</div>
			<div class="col-12">
				<blockquote><p>How much is the security deposit?</p></blockquote>
				<p>Usually the security deposit is equal to one month’s rent but does vary from property to property. From time to time, some owners may offer special promotions to help lease their property more quickly. The security deposit is paid when you move in and must be paid by certified funds (cashier’s check or money order).</p>
			</div>
			<div class="col-12">
				<blockquote><p>What if my application is denied?</p></blockquote>
				<p>The application fee is spent when we process the background check. The “Home Holding fee” will be returned to you in full.</p>
			</div>
			<div class="col-12">
				<blockquote><p>What does the application fee cover?</p></blockquote>
				<p>The application fee will cover the processing of credit, employment and residential history. We use Equifax to help process the background check.</p>
			</div>
			<div class="col-12">
				<blockquote><p>How much is the application fee?</p></blockquote>
				<p>All individuals completing an application must pay a $35 non-refundable fee with the application.</p>
			</div>
			<div class="col-12">
				<blockquote><p>Who must complete an application and what are the requirements?</p></blockquote>
				<p>All adults age 18 and over must present photo identification and complete an application. The income requirement is 3 times the monthly rent. We will check your landlord and employment references to determine your ability to pay the rent on time and to take care of the property. You must also have minimum of 2 years employment history.</p>
			</div>
			<div class="col-12">
				<blockquote><p>How do I apply for a property?</p></blockquote>
				<p>If you have not previously mailed or faxed us the online application, you will then fill out the application form and pay the non-refundable $35 credit application fee. The normal turnaround time for an application is three days. At that time, we will contact you with additional requirements (varying depending upon property).</p>
			</div>
			<div class="col-12">
				<blockquote><p>How do I view a property?</p></blockquote>
				<p>If you would like to view a home, call our leasing agent at 901-239-1332 to schedule a viewing.</p>
			</div>
			<div class="col-12">
				<blockquote><p>How do I find out which properties are available?</p></blockquote>
				<p>Simply click the Current Listings link above to see all of our current listings, or use the Search area on the Main Page to drill down to something more specific. Looking to rent in the near future? You can see homes that will be available for rent soon by clicking on Future Listings.</p>
			</div>
			<div class="col-12">
				<blockquote><p>What is your payment policy?</p></blockquote>
				<p>All rent is due on the first of the month with a grace period to the fifth. The late fee is a flat $50 applied on the 6th.</p>
			</div>
			<div class="col-12">
				<blockquote><p>What is classified as an emergency?</p></blockquote>
				<p>An emergency is any situation, which causes a potentially immediate danger to an individual or the property. The best examples are fire and flooding, but any situation, which has the ability to endanger life or property, is considered an emergency.</p>
			</div>
			<div class="col-12 text-danger">
				<p>As is the case with any serious emergency, the proper authorities — 911, fire department, police department, etc. — should be notified.</p>
			</div>
		</div>
		<div class="row align-items-center">
			<h1 class="col text-hide my-3" style="border:1px solid #787878 !important">Hidden Text</h1>
		</div>
	</div>
@endsection