{{--
 * LaraClassified - Classified Ads Web Application
 * Copyright (c) BedigitCom. All Rights Reserved
 *
 * Website: http://www.bedigit.com
 *
 * LICENSE
 * -------
 * This software is furnished under a license and may be used and copied
 * only in accordance with the terms of such license and with the inclusion
 * of the above copyright notice. If you Purchased from Codecanyon,
 * Please read the full License from here - http://codecanyon.net/licenses/standard
--}}
@extends('layouts.master')

@section('content')
	@if (!(isset($paddingTopExists) and $paddingTopExists))
		<div class="h-spacer"></div>
	@endif
	
	<div class="breadcrumb-area section" style="background-image: url({{url('dist/assets/images/bg/breadcrumb.jpg')}})">
    <div class="container">
        <div class="breadcrumb pt-75 pb-75 pt-sm-70 pb-sm-40 pt-xs-70 pb-xs-40">
            <div class="row">
                <div class="col">
                    <h2>Register</h2>
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Register</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>
</div>
	
	<div class="main-container">
		<div class="container">
			<div class="row">

				@if (isset($errors) and $errors->any())
					<div class="col-xl-12">
						<div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h5><strong>{{ t('Oops ! An error has occurred. Please correct the red fields in the form') }}</strong></h5>
							<ul class="list list-check">
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					</div>
				@endif

				@if (Session::has('flash_notification'))
					<div class="col-xl-12">
						<div class="row">
							<div class="col-xl-12">
								@include('flash::message')
							</div>
						</div>
					</div>
				@endif

				<!--<div class="col-md-8 page-content">-->
				<!--	<div class="inner-box">-->
				<!--		<h2 class="title-2">-->
				<!--			<strong><i class="icon-user-add"></i> {{ t('Create your account, Its free') }}</strong>-->
				<!--		</h2>-->
						
				<!--		@if (
							config('settings.social_auth.social_login_activation')
							and (
								(config('settings.social_auth.facebook_client_id') and config('settings.social_auth.facebook_client_secret'))
								or (config('settings.social_auth.linkedin_client_id') and config('settings.social_auth.linkedin_client_secret'))
								or (config('settings.social_auth.twitter_client_id') and config('settings.social_auth.twitter_client_secret'))
								or (config('settings.social_auth.google_client_id') and config('settings.social_auth.google_client_secret'))
								)
							)-->
				<!--			<div class="row mb-3 d-flex justify-content-center pl-3 pr-3">-->
				<!--				@if (config('settings.social_auth.facebook_client_id') and config('settings.social_auth.facebook_client_secret'))-->
				<!--				<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-1 pl-1 pr-1">-->
				<!--					<div class="col-xl-12 col-md-12 col-sm-12 col-xs-12 btn btn-lg btn-fb">-->
				<!--						<a href="{{ lurl('auth/facebook') }}" class="btn-fb"><i class="icon-facebook-rect"></i> {!! t('Login with Facebook') !!}</a>-->
				<!--					</div>-->
				<!--				</div>-->
				<!--				@endif-->
				<!--				@if (config('settings.social_auth.linkedin_client_id') and config('settings.social_auth.linkedin_client_secret'))-->
				<!--				<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-1 pl-1 pr-1">-->
				<!--					<div class="col-xl-12 col-md-12 col-sm-12 col-xs-12 btn btn-lg btn-lkin">-->
				<!--						<a href="{{ lurl('auth/linkedin') }}" class="btn-lkin"><i class="icon-linkedin"></i> {!! t('Login with LinkedIn') !!}</a>-->
				<!--					</div>-->
				<!--				</div>-->
				<!--				@endif-->
				<!--				@if (config('settings.social_auth.twitter_client_id') and config('settings.social_auth.twitter_client_secret'))-->
				<!--				<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-1 pl-1 pr-1">-->
				<!--					<div class="col-xl-12 col-md-12 col-sm-12 col-xs-12 btn btn-lg btn-tw">-->
				<!--						<a href="{{ lurl('auth/twitter') }}" class="btn-tw"><i class="icon-twitter-bird"></i> {!! t('Login with Twitter') !!}</a>-->
				<!--					</div>-->
				<!--				</div>-->
				<!--				@endif-->
				<!--				@if (config('settings.social_auth.google_client_id') and config('settings.social_auth.google_client_secret'))-->
				<!--				<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-1 pl-1 pr-1">-->
				<!--					<div class="col-xl-12 col-md-12 col-sm-12 col-xs-12 btn btn-lg btn-danger">-->
				<!--						<a href="{{ lurl('auth/google') }}" class="btn-danger"><i class="icon-googleplus-rect"></i> {!! t('Login with Google') !!}</a>-->
				<!--					</div>-->
				<!--				</div>-->
				<!--				@endif-->
				<!--			</div>-->
							
				<!--			<div class="row d-flex justify-content-center loginOr">-->
				<!--				<div class="col-xl-12 mb-1">-->
				<!--					<hr class="hrOr">-->
				<!--					<span class="spanOr rounded">{{ t('or') }}</span>-->
				<!--				</div>-->
				<!--			</div>-->
				<!--		@endif-->
						
				<!--		<div class="row mt-5">-->
				<!--			<div class="col-xl-12">-->
				<!--				<form id="signupForm" class="form-horizontal" method="POST" action="{{ url()->current() }}">-->
				<!--					{!! csrf_field() !!}-->
				<!--					<fieldset>-->

										<!-- name -->
										<?php $nameError = (isset($errors) and $errors->has('name')) ? ' is-invalid' : ''; ?>
				<!--						<div class="form-group row required">-->
				<!--							<label class="col-md-4 col-form-label">{{ t('Name') }} <sup>*</sup></label>-->
				<!--							<div class="col-md-6">-->
				<!--								<input name="name" placeholder="{{ t('Name') }}" class="form-control input-md{{ $nameError }}" type="text" value="{{ old('name') }}">-->
				<!--							</div>-->
				<!--						</div>-->

										<!-- country_code -->
				<!--						@if (empty(config('country.code')))-->
											<?php $countryCodeError = (isset($errors) and $errors->has('country_code')) ? ' is-invalid' : ''; ?>
				<!--							<div class="form-group row required">-->
				<!--								<label class="col-md-4 col-form-label{{ $countryCodeError }}" for="country_code">{{ t('Your Country') }} <sup>*</sup></label>-->
				<!--								<div class="col-md-6">-->
				<!--									<select id="countryCode" name="country_code" class="form-control sselecter{{ $countryCodeError }}">-->
				<!--										<option value="0" {{ (!old('country_code') or old('country_code')==0) ? 'selected="selected"' : '' }}>{{ t('Select') }}</option>-->
				<!--										@foreach ($countries as $code => $item)-->
				<!--											<option value="{{ $code }}" {{ (old('country_code', (!empty(config('ipCountry.code'))) ? config('ipCountry.code') : 0)==$code) ? 'selected="selected"' : '' }}>-->
				<!--												{{ $item->get('name') }}-->
				<!--											</option>-->
				<!--										@endforeach-->
				<!--									</select>-->
				<!--								</div>-->
				<!--							</div>-->
				<!--						@else-->
				<!--							<input id="countryCode" name="country_code" type="hidden" value="{{ config('country.code') }}">-->
				<!--						@endif-->

				<!--						@if (isEnabledField('phone'))-->
											<!-- phone -->
											<?php $phoneError = (isset($errors) and $errors->has('phone')) ? ' is-invalid' : ''; ?>
				<!--							<div class="form-group row required">-->
				<!--								<label class="col-md-4 col-form-label">{{ t('Phone') }}-->
				<!--									@if (!isEnabledField('email'))-->
				<!--										<sup>*</sup>-->
				<!--									@endif-->
				<!--								</label>-->
				<!--								<div class="col-md-6">-->
				<!--									<div class="input-group">-->
				<!--										<div class="input-group-prepend">-->
				<!--											<span id="phoneCountry" class="input-group-text">{!! getPhoneIcon(old('country', config('country.code'))) !!}</span>-->
				<!--										</div>-->
														
				<!--										<input name="phone"-->
				<!--											   placeholder="{{ (!isEnabledField('email')) ? t('Mobile Phone Number') : t('Phone Number') }}"-->
				<!--											   class="form-control input-md{{ $phoneError }}"-->
				<!--											   type="text"-->
				<!--											   value="{{ phoneFormat(old('phone'), old('country', config('country.code'))) }}"-->
				<!--										>-->
														
				<!--										<div class="input-group-append tooltipHere" data-placement="top"-->
				<!--											 data-toggle="tooltip"-->
				<!--											 data-original-title="{{ t('Hide the phone number on the ads.') }}">-->
				<!--											<span class="input-group-text">-->
				<!--												<input name="phone_hidden" id="phoneHidden" type="checkbox"-->
				<!--													   value="1" {{ (old('phone_hidden')=='1') ? 'checked="checked"' : '' }}>&nbsp;<small>{{ t('Hide') }}</small>-->
				<!--											</span>-->
				<!--										</div>-->
				<!--									</div>-->
				<!--								</div>-->
				<!--							</div>-->
				<!--						@endif-->
									
				<!--						@if (isEnabledField('email'))-->
											<!-- email -->
											<?php $emailError = (isset($errors) and $errors->has('email')) ? ' is-invalid' : ''; ?>
				<!--							<div class="form-group row required">-->
				<!--								<label class="col-md-4 col-form-label" for="email">{{ t('Email') }}-->
				<!--									@if (!isEnabledField('phone'))-->
				<!--										<sup>*</sup>-->
				<!--									@endif-->
				<!--								</label>-->
				<!--								<div class="col-md-6">-->
				<!--									<div class="input-group">-->
				<!--										<div class="input-group-prepend">-->
				<!--											<span class="input-group-text"><i class="icon-mail"></i></span>-->
				<!--										</div>-->
				<!--										<input id="email"-->
				<!--											   name="email"-->
				<!--											   type="email"-->
				<!--											   class="form-control{{ $emailError }}"-->
				<!--											   placeholder="{{ t('Email') }}"-->
				<!--											   value="{{ old('email') }}"-->
				<!--										>-->
				<!--									</div>-->
				<!--								</div>-->
				<!--							</div>-->
				<!--						@endif-->
									
				<!--						@if (isEnabledField('username'))-->
											<!-- username -->
											<?php $usernameError = (isset($errors) and $errors->has('username')) ? ' is-invalid' : ''; ?>
				<!--							<div class="form-group row required">-->
				<!--								<label class="col-md-4 col-form-label" for="email">{{ t('Username') }}</label>-->
				<!--								<div class="col-md-6">-->
				<!--									<div class="input-group">-->
				<!--										<div class="input-group-prepend">-->
				<!--											<span class="input-group-text"><i class="icon-user"></i></span>-->
				<!--										</div>-->
				<!--										<input id="username"-->
				<!--											   name="username"-->
				<!--											   type="text"-->
				<!--											   class="form-control{{ $usernameError }}"-->
				<!--											   placeholder="{{ t('Username') }}"-->
				<!--											   value="{{ old('username') }}"-->
				<!--										>-->
				<!--									</div>-->
				<!--								</div>-->
				<!--							</div>-->
				<!--						@endif-->
										
										<!-- password -->
										<?php $passwordError = (isset($errors) and $errors->has('password')) ? ' is-invalid' : ''; ?>
				<!--						<div class="form-group row required">-->
				<!--							<label class="col-md-4 col-form-label" for="password">{{ t('Password') }} <sup>*</sup></label>-->
				<!--							<div class="col-md-6">-->
				<!--								<div class="input-group show-pwd-group">-->
				<!--									<input id="password" name="password" type="password" class="form-control{{ $passwordError }}" placeholder="{{ t('Password') }}">-->
				<!--									<span class="icon-append show-pwd">-->
				<!--										<button type="button" class="eyeOfPwd">-->
				<!--											<i class="far fa-eye-slash"></i>-->
				<!--										</button>-->
				<!--									</span>-->
				<!--								</div>-->
				<!--								<br>-->
				<!--								<input id="password_confirmation" name="password_confirmation" type="password" class="form-control{{ $passwordError }}"-->
				<!--									   placeholder="{{ t('Password Confirmation') }}">-->
				<!--								<small id="" class="form-text text-muted">-->
				<!--									{{ t('At least :num characters', ['num' => config('larapen.core.passwordLength.min', 6)]) }}-->
				<!--								</small>-->
				<!--							</div>-->
				<!--						</div>-->
										
				<!--						@include('layouts.inc.tools.recaptcha', ['colLeft' => 'col-md-4', 'colRight' => 'col-md-6'])-->
									
										<!-- term -->
										<?php $termError = (isset($errors) and $errors->has('term')) ? ' is-invalid' : ''; ?>
				<!--						<div class="form-group row required">-->
				<!--							<label class="col-md-4 col-form-label"></label>-->
				<!--							<div class="col-md-6">-->
				<!--								<div class="form-check">-->
				<!--									<input name="term" id="term"-->
				<!--										   class="form-check-input{{ $termError }}"-->
				<!--										   value="1"-->
				<!--										   type="checkbox" {{ (old('term')=='1') ? 'checked="checked"' : '' }}-->
				<!--									>-->
													
				<!--									<label class="form-check-label" for="term">-->
				<!--										{!! t('I have read and agree to the <a :attributes>Terms & Conditions</a>', ['attributes' => getUrlPageByType('terms')]) !!}-->
				<!--									</label>-->
				<!--								</div>-->
				<!--								<div style="clear:both"></div>-->
				<!--							</div>-->
				<!--						</div>-->

										<!-- Button  -->
				<!--						<div class="form-group row">-->
				<!--							<label class="col-md-4 col-form-label"></label>-->
				<!--							<div class="col-md-6">-->
				<!--								<button id="signupBtn" class="btn btn-success btn-lg"> {{ t('Register') }} </button>-->
				<!--							</div>-->
				<!--						</div>-->

				<!--						<div class="mb-5"></div>-->

				<!--					</fieldset>-->
				<!--				</form>-->
				<!--			</div>-->
				<!--		</div>-->
				<!--	</div>-->
				<!--</div>-->

				<!--<div class="col-md-4 reg-sidebar">-->
				<!--	<div class="reg-sidebar-inner text-center">-->
				<!--		<div class="promo-text-box"><i class="icon-picture fa fa-4x icon-color-1"></i>-->
				<!--			<h3><strong>{{ t('Post a Free Classified') }}</strong></h3>-->
				<!--			<p>-->
				<!--				{{ t('Do you have something to sell, to rent, any service to offer or a job offer? Post it at :app_name, its free, local, easy, reliable and super fast!',
								['app_name' => config('app.name')]) }}-->
				<!--			</p>-->
				<!--		</div>-->
				<!--		<div class="promo-text-box"><i class=" icon-pencil-circled fa fa-4x icon-color-2"></i>-->
				<!--			<h3><strong>{{ t('Create and Manage Items') }}</strong></h3>-->
				<!--			<p>{{ t('Become a best seller or buyer. Create and Manage your ads. Repost your old ads, etc.') }}</p>-->
				<!--		</div>-->
				<!--		<div class="promo-text-box"><i class="icon-heart-2 fa fa-4x icon-color-3"></i>-->
				<!--			<h3><strong>{{ t('Create your Favorite ads list.') }}</strong></h3>-->
				<!--			<p>{{ t('Create your Favorite ads list, and save your searches. Don\'t forget any deal!') }}</p>-->
				<!--		</div>-->
				<!--	</div>-->
				<!--</div>-->
				
				<!-- Register Section Start -->
<div class="register-section section pt-110 pt-md-90 pt-sm-70 pt-xs-60 pb-110 pb-md-90 pb-sm-70 pb-xs-60">
    <div class="container">
       
       <div class="row row-0 align-items-center">
           <div class="col-lg-4">
               <div class="single-content-side d-flex align-items-center justify-content-center">
                    <div class="contents-box text-center">
                        <h4>Already have an Account?</h4>
                        <a href="{{ lurl(trans('routes.login')) }}" class="btn  btn-circle mt-20">LOGIN</a>
                    </div>
               </div>
           </div>
           <div class="col-lg-4">
               <div class="login-register-wrapper">
                    <div class="from-box text-center">
                        
                        <form id="signupForm" class="login-register-wrap" method="POST" action="{{ url()->current() }}">
                            <h3>Register</h3>
                            <div class="input-box mb-15">
                                <input name="name" placeholder="{{ t('Name') }}"  type="text" value="{{ old('name') }}">
                            </div>
                            
                            @if (empty(config('country.code')))
								<div class="input-box mb-15">
									<select id="countryCode" name="country_code" class="selecter">
										<option value="0" {{ (!old('country_code') or old('country_code')==0) ? 'selected="selected"' : '' }}>{{ t('Select Country') }}</option>
										@foreach ($countries as $code => $item)
											<option value="{{ $code }}" {{ (old('country_code', (!empty(config('ipCountry.code'))) ? config('ipCountry.code') : 0)==$code) ? 'selected="selected"' : '' }}>
												{{ $item->get('name') }}
											</option>
										@endforeach
									</select>
								</div>
							@else
								<input id="countryCode" name="country_code" type="hidden" value="{{ config('country.code') }}">
							@endif
                            
                            @if (isEnabledField('phone'))
								<!-- phone -->
								<?php $phoneError = (isset($errors) and $errors->has('phone')) ? ' is-invalid' : ''; ?>
								<div class="input-box mb-15">
											
									<input name="phone"
										   placeholder="{{ (!isEnabledField('email')) ? t('Mobile Phone Number') : t('Phone Number') }}"
										   
										   type="text"
										   value="{{ phoneFormat(old('phone'), old('country', config('country.code'))) }}"
									>
								</div>
							@endif
                            @if (isEnabledField('email'))
								<!-- email -->
								<?php $emailError = (isset($errors) and $errors->has('email')) ? ' is-invalid' : ''; ?>
								<div class="input-box mb-15">
									<input id="email"
										   name="email"
										   type="email"
										   
										   placeholder="{{ t('Email') }}"
										   value="{{ old('email') }}"
									>
								</div>
							@endif
						
							@if (isEnabledField('username'))
								<!-- username -->
								<?php $usernameError = (isset($errors) and $errors->has('username')) ? ' is-invalid' : ''; ?>
								<div class="input-box mb-15">
									<input id="username"
										   name="username"
										   type="text"
										   placeholder="{{ t('Username') }}"
										   value="{{ old('username') }}"
									>
									
								</div>
							@endif
							
                            <?php $passwordError = (isset($errors) and $errors->has('password')) ? ' is-invalid' : ''; ?>
                            
							<div class="input-box mb-15">
								<input id="password" name="password" type="password"  placeholder="{{ t('Password') }}">
							</div>
							<div class="input-box mb-15">
								<input id="password_confirmation" name="password_confirmation" type="password" 
									   placeholder="{{ t('Password Confirmation') }}">
							</div>
						
							@include('layouts.inc.tools.recaptcha', ['colLeft' => 'col-md-4', 'colRight' => 'col-md-6'])
							
                            <div class="input-box mb-10">
								
								<label for="term">
								    <input name="term" id="term"
									   
									   value="1"
									   type="checkbox" {{ (old('term')=='1') ? 'checked="checked"' : '' }}
								    >
								    
									{!! t('I have read and agree to the <a :attributes>Terms & Conditions</a>', ['attributes' => getUrlPageByType('terms')]) !!}
									
								</label>
							</div>
							<button id="signupBtn" class="btn btn-circle mt-15"> {{ t('Register') }} </button>
                            
                        </form>
                    </div>
               </div>
           </div>
           <div class="col-lg-4">
               <div class="single-content-side d-flex align-items-center justify-content-center">
                    <div class="contents-box text-center">
                        
                            @if (
        					config('settings.social_auth.social_login_activation')
        					and (
        						(config('settings.social_auth.facebook_client_id') and config('settings.social_auth.facebook_client_secret'))
        						or (config('settings.social_auth.linkedin_client_id') and config('settings.social_auth.linkedin_client_secret'))
        						or (config('settings.social_auth.twitter_client_id') and config('settings.social_auth.twitter_client_secret'))
        						or (config('settings.social_auth.google_client_id') and config('settings.social_auth.google_client_secret'))
        						)
        					)
					            <ul class="ling-in-socail">
									@if (config('settings.social_auth.facebook_client_id') and config('settings.social_auth.facebook_client_secret'))
									    <li><a href="{{ lurl('auth/facebook') }}"> <i class="fa fa-facebook"></i> Login with Facebook </a></li>
									
									@endif
									@if (config('settings.social_auth.linkedin_client_id') and config('settings.social_auth.linkedin_client_secret'))
									<li>
											<a href="{{ lurl('auth/linkedin') }}"><i class="icon-linkedin"></i> Login with LinkedIn</a>
									</li>
									@endif
									@if (config('settings.social_auth.twitter_client_id') and config('settings.social_auth.twitter_client_secret'))
									    <li><a href="{{ lurl('auth/twitter') }}"> <i class="fa fa-twitter"></i> Login with Twitter </a></li>
									    
									@endif
									@if (config('settings.social_auth.google_client_id') and config('settings.social_auth.google_client_secret'))
									    <li><a href="{{ lurl('auth/google') }}"> <i class="fa fa-google-plus"></i> Login with Google </a></li>
									
									@endif
								</ul>
				            @endif
                        
                    </div>
               </div>
           </div>
       </div>
        
    </div>
</div><!-- Register Section End -->
				
			</div>
		</div>
	</div>
@endsection

@section('after_scripts')
	<script>
		$(document).ready(function () {
			/* Submit Form */
			$("#signupBtn").click(function () {
				$("#signupForm").submit();
				return false;
			});
		});
	</script>
@endsection