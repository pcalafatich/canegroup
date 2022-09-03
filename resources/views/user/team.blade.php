@php
    $team_section=$sections->where('id',3)->first();
@endphp

@if ($team_section->show_homepage==1)
    <div class="wsus__team_area mt_35">
      <div class="row">
        <div class="col-12">
          <div class="wsus__section_heading text-center mb_15">
            <h2>{{ $team_section->header }}</h2>
            <span>{{ $team_section->description }}</span>
          </div>
        </div>
      </div>
      <div class="row">
        @foreach ($partners->take($team_section->content_quantity) as $item)
        <div class="col-xl-3 col-sm-6 col-lg-4">
          <div class="wsus__single_team">
            <div class="wsus__single_team_img">
              <img src="{{ asset($item->image) }}" alt="team images" class="imf-fluid w-100">
              <ul class="team_link">
                @if ($item->first_icon && $item->first_link)
                <li><a href="{{ $item->first_link }}"><i class="{{ $item->first_icon }}"></i></a></li>
                @endif

                @if ($item->second_icon && $item->second_link)
                <li><a href="{{ $item->second_link }}"><i class="{{ $item->second_icon }}"></i></a></li>
                @endif

                @if ($item->third_icon && $item->third_link)
                <li><a href="{{ $item->third_link }}"><i class="{{ $item->third_icon }}"></i></a></li>
                @endif

                @if ($item->four_icon && $item->four_link)
                <li><a href="{{ $item->four_link }}"><i class="{{ $item->four_icon }}"></i></a></li>
                @endif
              </ul>
            </div>
            <h4>{{ $item->name }}</h4>
            <p>{{ $item->designation }}</p>
          </div>
        </div>
        @endforeach
      </div>
    </div>
@endif