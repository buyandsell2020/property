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
<?php
	$fullUrl = rawurldecode(url(request()->getRequestUri()));
	$tmpExplode = explode('?', $fullUrl);
	$fullUrlNoParams = current($tmpExplode);
?>
@extends('layouts.master')

@section('search')
	@parent
	@include('search.inc.form')
@endsection

@section('content')
	<div class="main-container">
		
{{--	/	@include('search.inc.breadcrumbs')--}}
{{--		@include('search.inc.categories')--}}
		<?php if (\App\Models\Advertising::where('slug', 'top')->count() > 0): ?>
			@include('layouts.inc.advertising.top', ['paddingTopExists' => true])
		<?php
			$paddingTopExists = false;
		else:
			if (isset($paddingTopExists) and $paddingTopExists) {
				$paddingTopExists = false;
			}
		endif;
		?>
		@include('common.spacer')
		<?php
                    $liClass = 'class="btn"';
                    $spanClass = 'alert-danger';
                    if (!request()->filled('type') or request()->get('type') == '') {
                        $liClass = 'class="btn active"';
                        $spanClass = 'badge-danger';
                    }
                    ?>
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <ul class="properties-list nav " >
                                <li ><a {!! $liClass !!} href="{!! qsurl($fullUrlNoParams, request()->except(['page', 'type']), null, false) !!}" >ALL
                                <span class="badge badge-pill {!! $spanClass !!}">{{ $count->get('all') }}</span>
                                </a></li>
                                
                                @if (!empty($postTypes))
                                    @foreach ($postTypes as $postType)
                                        <?php
                                            $postTypeUrl = qsurl($fullUrlNoParams, array_merge(request()->except(['page']), ['type' => $postType->tid]), null, false);
                                            $postTypeCount = ($count->has($postType->tid)) ? $count->get($postType->tid) : 0;
                                        ?>
                                        @if (request()->filled('type') && request()->get('type') == $postType->tid)
                                        
                                            <li ><a class="btn active" href="{!! $postTypeUrl !!}" >{{ $postType->name }} <span class="badge badge-pill badge-danger">
                                                        {{ $postTypeCount }}
                                                    </span>
                                                </a></li>
                                            
                                        @else
                                            <li ><a class="btn" href="{!! $postTypeUrl !!}" >{{ $postType->name }} <span class="badge badge-pill alert-danger">
                                                        {{ $postTypeCount }}
                                                    </span>
                                                </a></li>
                                        @endif
                                    @endforeach
                                @endif
                                
                                
                            </ul>
                        </div>
                        <div class="col tab-filter">
								<select id="orderBy" title="Sort By" class="niceselecter select-sort-by" data-style="btn-select" data-width="auto">
									<option value="{!! qsurl($fullUrlNoParams, request()->except(['orderBy', 'distance']), null, false) !!}">{{ t('Sort by') }}</option>
									<option{{ (request()->get('orderBy')=='priceAsc') ? ' selected="selected"' : '' }}
											value="{!! qsurl($fullUrlNoParams, array_merge(request()->except('orderBy'), ['orderBy'=>'priceAsc']), null, false) !!}">
										{{ t('Price : Low to High') }}
									</option>
									<option{{ (request()->get('orderBy')=='priceDesc') ? ' selected="selected"' : '' }}
											value="{!! qsurl($fullUrlNoParams, array_merge(request()->except('orderBy'), ['orderBy'=>'priceDesc']), null, false) !!}">
										{{ t('Price : High to Low') }}
									</option>
									<option{{ (request()->get('orderBy')=='relevance') ? ' selected="selected"' : '' }}
											value="{!! qsurl($fullUrlNoParams, array_merge(request()->except('orderBy'), ['orderBy'=>'relevance']), null, false) !!}">
										{{ t('Relevance') }}
									</option>
									<option{{ (request()->get('orderBy')=='date') ? ' selected="selected"' : '' }}
											value="{!! qsurl($fullUrlNoParams, array_merge(request()->except('orderBy'), ['orderBy'=>'date']), null, false) !!}">
										{{ t('Date') }}
									</option>
									@if (isset($isCitySearch) and $isCitySearch and isset($distanceRange) and !empty($distanceRange))
										@foreach($distanceRange as $key => $value)
											<option{{ (request()->get('distance', config('settings.listing.search_distance_default', 100))==$value) ? ' selected="selected"' : '' }}
													value="{!! qsurl($fullUrlNoParams, array_merge(request()->except('distance'), ['distance' => $value]), null, false) !!}">
												{{ t('Around :distance :unit', ['distance' => $value, 'unit' => getDistanceUnit()]) }}
											</option>
										@endforeach
									@endif
									@if (config('plugins.reviews.installed'))
										<option{{ (request()->get('orderBy')=='rating') ? ' selected="selected"' : '' }}
												value="{!! qsurl($fullUrlNoParams, array_merge(request()->except('orderBy'), ['orderBy'=>'rating']), null, false) !!}">
										{{ trans('reviews::messages.Rating') }}
										</option>
									@endif
								</select>
							</div>
                    </div>
                </div>
		<div class="container">
			<div class="row">

				<!-- Sidebar -->
                @if (config('settings.listing.left_sidebar'))
                    @include('search.inc.sidebar')
                    <?php $contentColSm = 'col-md-12'; ?>
                @else
                    <?php $contentColSm = 'col-md-12'; ?>
                @endif
                
                
				<!-- Content -->
				<!--<div class="{{ $contentColSm }} page-content col-thin-left">-->
				<!--	<div class="category-list{{ ($contentColSm == 'col-md-12') ? ' noSideBar' : '' }}">-->
				<!--		<div class="tab-box">-->

							<!-- Nav tabs -->
							<!--<ul id="postType" class="nav nav-tabs add-tabs tablist" role="tablist">-->
                               <?php
                            //   $liClass = 'class="nav-item"';
                            //   $spanClass = 'alert-danger';
                            //   if (!request()->filled('type') or request()->get('type') == '') {
                            //       $liClass = 'class="nav-item active"';
                            //       $spanClass = 'badge-danger';
                            //   }
                               ?>
								<!--<li {!! $liClass !!}>-->
							<!--		<a href="{!! qsurl($fullUrlNoParams, request()->except(['page', 'type']), null, false) !!}" role="tab" data-toggle="tab" class="nav-link">-->
							<!--			{{ t('All Ads') }} <span class="badge badge-pill {!! $spanClass !!}">{{ $count->get('all') }}</span>-->
							<!--		</a>-->
							<!--	</li>-->
       <!--                         @if (!empty($postTypes))-->
       <!--                             @foreach ($postTypes as $postType)-->
                                       <?php
                                        //   $postTypeUrl = qsurl($fullUrlNoParams, array_merge(request()->except(['page']), ['type' => $postType->tid]), null, false);
                                        //     $postTypeCount = ($count->has($postType->tid)) ? $count->get($postType->tid) : 0;
                                       ?>
       <!--                                 @if (request()->filled('type') && request()->get('type') == $postType->tid)-->
       <!--                                     <li class="nav-item active">-->
       <!--                                         <a href="{!! $postTypeUrl !!}" role="tab" data-toggle="tab" class="nav-link">-->
       <!--                                             {{ $postType->name }}-->
       <!--                                             <span class="badge badge-pill badge-danger">-->
       <!--                                                 {{ $postTypeCount }}-->
       <!--                                             </span>-->
       <!--                                         </a>-->
       <!--                                     </li>-->
       <!--                                 @else-->
       <!--                                     <li class="nav-item">-->
       <!--                                         <a href="{!! $postTypeUrl !!}" role="tab" data-toggle="tab" class="nav-link">-->
       <!--                                             {{ $postType->name }}-->
       <!--                                             <span class="badge badge-pill alert-danger">-->
       <!--                                                 {{ $postTypeCount }}-->
       <!--                                             </span>-->
       <!--                                         </a>-->
       <!--                                     </li>-->
       <!--                                 @endif-->
       <!--                             @endforeach-->
       <!--                         @endif-->
							<!--</ul>-->
							
							<!--<div class="tab-filter">-->
							<!--	<select id="orderBy" title="sort by" class="niceselecter select-sort-by" data-style="btn-select" data-width="auto">-->
							<!--		<option value="{!! qsurl($fullUrlNoParams, request()->except(['orderBy', 'distance']), null, false) !!}">{{ t('Sort by') }}</option>-->
							<!--		<option{{ (request()->get('orderBy')=='priceAsc') ? ' selected="selected"' : '' }}-->
							<!--				value="{!! qsurl($fullUrlNoParams, array_merge(request()->except('orderBy'), ['orderBy'=>'priceAsc']), null, false) !!}">-->
							<!--			{{ t('Price : Low to High') }}-->
							<!--		</option>-->
							<!--		<option{{ (request()->get('orderBy')=='priceDesc') ? ' selected="selected"' : '' }}-->
							<!--				value="{!! qsurl($fullUrlNoParams, array_merge(request()->except('orderBy'), ['orderBy'=>'priceDesc']), null, false) !!}">-->
							<!--			{{ t('Price : High to Low') }}-->
							<!--		</option>-->
							<!--		<option{{ (request()->get('orderBy')=='relevance') ? ' selected="selected"' : '' }}-->
							<!--				value="{!! qsurl($fullUrlNoParams, array_merge(request()->except('orderBy'), ['orderBy'=>'relevance']), null, false) !!}">-->
							<!--			{{ t('Relevance') }}-->
							<!--		</option>-->
							<!--		<option{{ (request()->get('orderBy')=='date') ? ' selected="selected"' : '' }}-->
							<!--				value="{!! qsurl($fullUrlNoParams, array_merge(request()->except('orderBy'), ['orderBy'=>'date']), null, false) !!}">-->
							<!--			{{ t('Date') }}-->
							<!--		</option>-->
							<!--		@if (isset($isCitySearch) and $isCitySearch and isset($distanceRange) and !empty($distanceRange))-->
							<!--			@foreach($distanceRange as $key => $value)-->
							<!--				<option{{ (request()->get('distance', config('settings.listing.search_distance_default', 100))==$value) ? ' selected="selected"' : '' }}-->
							<!--						value="{!! qsurl($fullUrlNoParams, array_merge(request()->except('distance'), ['distance' => $value]), null, false) !!}">-->
							<!--					{{ t('Around :distance :unit', ['distance' => $value, 'unit' => getDistanceUnit()]) }}-->
							<!--				</option>-->
							<!--			@endforeach-->
							<!--		@endif-->
							<!--		@if (config('plugins.reviews.installed'))-->
							<!--			<option{{ (request()->get('orderBy')=='rating') ? ' selected="selected"' : '' }}-->
							<!--					value="{!! qsurl($fullUrlNoParams, array_merge(request()->except('orderBy'), ['orderBy'=>'rating']), null, false) !!}">-->
							<!--			{{ trans('reviews::messages.Rating') }}-->
							<!--			</option>-->
							<!--		@endif-->
							<!--	</select>-->
							<!--</div>-->

						<!--</div>-->

						<!--<div class="listing-filter">-->
						<!--	<div class="pull-left col-xs-6">-->
						<!--		<div class="breadcrumb-list">-->
						<!--			{!! (isset($htmlTitle)) ? $htmlTitle : '' !!}-->
						<!--		</div>-->
      <!--                          <div style="clear:both;"></div>-->
						<!--	</div>-->
                            
						<!--	@if ($paginator->getCollection()->count() > 0)-->
						<!--		<div class="pull-right col-xs-6 text-right listing-view-action">-->
						<!--			<span class="list-view"><i class="icon-th"></i></span>-->
						<!--			<span class="compact-view"><i class="icon-th-list"></i></span>-->
						<!--			<span class="grid-view active"><i class="icon-th-large"></i></span>-->
						<!--		</div>-->
						<!--	@endif-->

						<!--	<div style="clear:both"></div>-->
						<!--</div>-->
						
						<!-- Mobile Filter Bar -->
						<!--<div class="mobile-filter-bar col-xl-12">-->
						<!--	<ul class="list-unstyled list-inline no-margin no-padding">-->
						<!--		@if (config('settings.listing.left_sidebar'))-->
						<!--		<li class="filter-toggle">-->
						<!--			<a class="">-->
						<!--				<i class="icon-th-list"></i> {{ t('Filters') }}-->
						<!--			</a>-->
						<!--		</li>-->
						<!--		@endif-->
						<!--		<li>-->
						<!--			<div class="dropdown">-->
						<!--				<a data-toggle="dropdown" class="dropdown-toggle">{{ t('Sort by') }}</a>-->
						<!--				<ul class="dropdown-menu">-->
						<!--					<li>-->
						<!--						<a href="{!! qsurl($fullUrlNoParams, request()->except(['orderBy', 'distance']), null, false) !!}" rel="nofollow">-->
						<!--							{{ t('Sort by') }}-->
						<!--						</a>-->
						<!--					</li>-->
						<!--					<li>-->
						<!--						<a href="{!! qsurl($fullUrlNoParams, array_merge(request()->except('orderBy'), ['orderBy'=>'priceAsc']), null, false) !!}" rel="nofollow">-->
						<!--							{{ t('Price : Low to High') }}-->
						<!--						</a>-->
						<!--					</li>-->
						<!--					<li>-->
						<!--						<a href="{!! qsurl($fullUrlNoParams, array_merge(request()->except('orderBy'), ['orderBy'=>'priceDesc']), null, false) !!}" rel="nofollow">-->
						<!--							{{ t('Price : High to Low') }}-->
						<!--						</a>-->
						<!--					</li>-->
						<!--					<li>-->
						<!--						<a href="{!! qsurl($fullUrlNoParams, array_merge(request()->except('orderBy'), ['orderBy'=>'relevance']), null, false) !!}" rel="nofollow">-->
						<!--							{{ t('Relevance') }}-->
						<!--						</a>-->
						<!--					</li>-->
						<!--					<li>-->
						<!--						<a href="{!! qsurl($fullUrlNoParams, array_merge(request()->except('orderBy'), ['orderBy'=>'date']), null, false) !!}" rel="nofollow">-->
						<!--							{{ t('Date') }}-->
						<!--						</a>-->
						<!--					</li>-->
						<!--					@if (isset($isCitySearch) and $isCitySearch and isset($distanceRange) and !empty($distanceRange))-->
						<!--						@foreach($distanceRange as $key => $value)-->
						<!--							<li>-->
						<!--								<a href="{!! qsurl($fullUrlNoParams, array_merge(request()->except('distance'), ['distance' => $value]), null, false) !!}" rel="nofollow">-->
						<!--									{{ t('Around :distance :unit', ['distance' => $value, 'unit' => getDistanceUnit()]) }}-->
						<!--								</a>-->
						<!--							</li>-->
						<!--						@endforeach-->
						<!--					@endif-->
						<!--					@if (config('plugins.reviews.installed'))-->
						<!--						<li>-->
						<!--							<a href="{!! qsurl($fullUrlNoParams, array_merge(request()->except('orderBy'), ['orderBy'=>'rating']), null, false) !!}"-->
						<!--							   rel="nofollow">-->
						<!--								{{ trans('reviews::messages.Rating') }}-->
						<!--							</a>-->
						<!--						</li>-->
						<!--					@endif-->
						<!--				</ul>-->
						<!--			</div>-->
						<!--		</li>-->
						<!--	</ul>-->
						<!--</div>-->
						<!--<div class="menu-overly-mask"></div>-->
						<!-- Mobile Filter bar End-->

						<!--<div id="postsList" class="adds-wrapper row no-margin">-->
						
						<div class="featured-properites-section section pt-10">
                            <div class="container">
                                <div class="row">
                                    
							            @include('search.inc.posts')
                        			
                                </div>
                            </div>
                        </div>
                        
						<!--</div>-->

						<!--<div class="tab-box save-search-bar text-center">-->
						<!--	@if (request()->filled('q') and request()->get('q') != '' and $count->get('all') > 0)-->
						<!--		<a name="{!! qsurl($fullUrlNoParams, request()->except(['_token', 'location']), null, false) !!}" id="saveSearch"-->
						<!--		   count="{{ $count->get('all') }}">-->
						<!--			<i class="icon-star-empty"></i> {{ t('Save Search') }}-->
						<!--		</a>-->
						<!--	@else-->
						<!--		<a href="#"> &nbsp; </a>-->
						<!--	@endif-->
						<!--</div>-->
					<!--</div>-->
					<!--<div class="row pt-40">-->
     <!--                   <div class="col ">-->
     <!--                       <ul class="page-pagination text-center">-->
     <!--                           <li><a href="#"><i class="fa fa-angle-left"></i></a></li>-->
     <!--                           <li class="active"><a href="#">01</a></li>-->
     <!--                           <li><a href="#">02</a></li>-->
     <!--                           <li><a href="#">03</a></li>-->
     <!--                           <li><a href="#"><i class="fa fa-angle-right"></i></a></li>-->
     <!--                       </ul>-->
                            
     <!--                   </div>-->
     <!--               </div>-->
                    
                    
                    
					<!--<nav class="pagination-bar mb-5 pagination-sm" aria-label="">-->
					    <div class="row pt-40 ">
                            <div class="col ">
						        {!! $paginator->appends(request()->query())->render() !!}
						    </div>
                        </div>
					<!--</nav>-->

					<!--<div class="post-promo text-center mb-5">-->
					<!--	<h2> {{ t('Do have anything to sell or rent?') }} </h2>-->
					<!--	<h5>{{ t('Sell your products and services online FOR FREE. It\'s easier than you think !') }}</h5>-->
					<!--	@if (!auth()->check() and config('settings.single.guests_can_post_ads') != '1')-->
					<!--		<a href="#quickLogin" class="btn btn-border btn-post btn-add-listing" data-toggle="modal">{{ t('Start Now!') }}</a>-->
					<!--	@else-->
					<!--		<a href="{{ \App\Helpers\UrlGen::addPost() }}" class="btn btn-border btn-post btn-add-listing">{{ t('Start Now!') }}</a>-->
					<!--	@endif-->
					<!--</div>-->
                    
                    
                    
				<!--</div>-->
				
				<div style="clear:both;"></div>
                
				<!-- Advertising -->
				@include('layouts.inc.advertising.bottom')

			</div>
		</div>
	</div>
	<!-- About Section Start -->
<div class="about-section section pt-50 mb-70 pt-md-20 pt-xs-35 pt-sm-20  pb-50 pb-md-50 pb-sm-50 pb-xs-50 counter-bg">
    <div class="container">
        <div class="row project-count">
            <div class="col text-center mt-10">
            <h2> {{ t('Do have anything to sell or rent?') }} </h2>
						<h5>Sell your products and services online Now. It\'s easier than you think !</h5>
						@if (!auth()->check() and config('settings.single.guests_can_post_ads') != '1')
							<a href="{{ lurl(trans('routes.login')) }}" class="btn btn-circle bg-info text-white">{{ t('Start Now!') }}</a>
						@else
							<a href="{{ \App\Helpers\UrlGen::addPost() }}" class="btn btn-circle bg-info text-white">{{ t('Start Now!') }}</a>
						@endif
            </div>
            
            <!--<div class="col-lg-4 col-md-4 col-sm-4 mt-25">-->
                <!-- counter start -->
            <!--    <div class="counter text-center">-->
            <!--        <h3 class="counter-active"></h3>-->
            <!--        <p>Total Ads</p>-->
            <!--    </div>-->
                <!-- counter end -->
            <!--</div>-->
           
            
            
        </div>
        <!-- Project Count Area End -->
                    
    </div>
</div><!-- About Section End -->
@endsection

@section('modal_location')
	@include('layouts.inc.modal.location')
@endsection

@section('after_scripts')
	<script>
		$(document).ready(function () {
			$('#postType a').click(function (e) {
				e.preventDefault();
				var goToUrl = $(this).attr('href');
				redirect(goToUrl);
			});
			$('#orderBy').change(function () {
				var goToUrl = $(this).val();
				redirect(goToUrl);
			});
		});
		
		@if (config('settings.optimization.lazy_loading_activation') == 1)
		$(document).ready(function () {
			$('#postsList').each(function () {
				var $masonry = $(this);
				var update = function () {
					$.fn.matchHeight._update();
				};
				$('.item-list', $masonry).matchHeight();
				this.addEventListener('load', update, true);
			});
		});
		@endif
	</script>
@endsection
