@inject('collegeSettings', 'App\Services\PortalSettingsService')
<div class="college-cards">
@foreach(config('college.programmes') as $slug=>$item)
@if(in_array($item['code'], $collegeSettings->branches(), true))
<article class="college-card programme-{{ $slug }}"><span class="college-badge">{{ $item['code'] }}</span><h3>{{ $item['name'] }}</h3><p>{{ $item['intro'] }}</p><a class="college-text-link" href="{{ url('/programmes/'.$slug) }}" data-gpcs-public-link>Explore this branch <span aria-hidden="true">↗</span></a></article>
@endif
@endforeach
</div>
