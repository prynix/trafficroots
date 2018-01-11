@extends('layouts.app')
@section('title', '- Campaigns')
@section('css')
<link rel="stylesheet"
      href="{{ URL::asset('css/plugins/select2/select2.min.css') }}">
<link rel="stylesheet"
      href="{{ URL::asset('css/plugins/chosen/chosen.css') }}">
@endsection

@section('js')
<script src="{{ URL::asset('js/plugins/select2/select2.full.min.js') }}"></script>
<script src="{{ URL::asset('js/plugins/chosen/chosen.jquery.js') }}"></script>
@endsection
@section('content')
    @if(Session::has('success'))
        <div class="alert alert-success">
            <h2>{{ Session::get('success') }}</h2>
        </div>
	@endif
<style>
.wizard .content {
    min-height: 100px;
}
.wizard .content > .body {
    width: 100%;
    height: auto;
    padding: 15px;
    position: relative;
}
</style>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="ibox">
                <div class="ibox-title">Create a Campaign</div>

                <div class="ibox-content">

                <form name="campaign_form" id="campaign_form" class="form-horizontal" role="form" method="POST" action="{{ url('/campaign') }}">
                {{ csrf_field() }}
                <div id="wizard">
                    <h1>Campaign Details</h1>
		    <div class="steps-content">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="campaign_name" class="col-md-4 control-label">Campaign Name</label>

                            <div class="col-md-6">
                                <input id="campaign_name" type="text" class="form-control" name="campaign_name" value="{{ old('campaign_name') }}" required autofocus>
                                @if ($errors->has('campaign_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('campaign_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                

                        <div class="form-group{{ $errors->has('campaign_type') ? ' has-error' : '' }}">
                            <label for="campaign_type" class="col-md-4 control-label">Campaign Type</label>

                            <div class="col-md-6">
                                <select id="campaign_type" class="form-control" name="campaign_type" required>
                                <option value="">Choose</option>
                                @foreach($campaign_types as $type)
                                    <option value="{{ $type->id }}">{{$type->campaign_type}}</option>

                                @endforeach
                                </select>

                                @if ($errors->has('campaign_type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('campaign_type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('campaign_category') ? ' has-error' : '' }}">
                            <label for="campaign_category" class="col-md-4 control-label">Campaign Category</label>

                            <div class="col-md-6">
                                <select id="campaign_category" class="form-control reload" name="campaign_category" required>
                                <option value="">Choose</option>
                                @foreach($categories as $type)
                                    <option value="{{ $type->id }}">{{$type->category}}</option>

                                @endforeach
                                </select>
                          
                                @if ($errors->has('campaign_category'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('campaign_category') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('location_type') ? ' has-error' : '' }}">
                            <label for="location_type" class="col-md-4 control-label">Location Type</label>

                            <div class="col-md-6">
                                <select id="location_type" class="form-control reload" name="location_type" required>
                                <option value="">Choose</option>
                                @foreach($location_types as $type)
                                    <option value="{{ $type->id }}">{{$type->description}} - {{$type->width}}x{{$type->height}}</option>

                                @endforeach
                                </select>


                                @if ($errors->has('location_type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('location_type') }}</strong>
                                    </span>
                                @endif
                            </div>
			</div>
                    </div>

                    <h1>Advanced Targeting</h1>
                    <div class="step-content">
                            <div class="col-md-6">
                             <p>State Targeting</p>
                             <select id="states[]" name="states[]" class="chosen-select form-control" multiple>
                             {!! $states !!}
                             </select>
                            </div>
                            <div class="col-md-6">
                            <p>Platform Targeting</p>
                                <select name="platform_targets[]" id="platform_targets[]" class="chosen-select form-control" multiple>
                                {!! $platforms !!}
                                </select>
                            </div>
                            <div class="col-md-6"><br />
                             <p>OS Targeting</p>
                             <select id="operating_systems[]" name="operating_systems[]" class="chosen-select form-control"  multiple>
                             {!! $os_targets !!}
                             </select>
                            </div>
                            <div class="col-md-6"><br />
                             <p>Browser Targeting</p>
                             <select id="browser_targets[]" name="browser_targets[]" class="chosen-select form-control"  multiple>
                             {!! $browser_targets !!}
                             </select>
                            </div>
			    <div class="col-md-12"><br />  
                             <p>Keyword Targeting</p><small>Use commas to separate</small>
                             <input name="keyword_targets" id="keyword_targets" class="form-control" type="text" value="">
                            </div>

                    </div>
                    <h1>Media</h1>
                    <div class="step-content">
                        <h4>Add A Creative</h4>
                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control" name="description" value="{{ old('description') }}" required>

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>  
                        @if ($user->allow_folders)              
                        <div class="form-group{{ $errors->has('media') ? ' has-error' : '' }}">
                            <label for="folder_id" class="col-md-4 control-label">Folder</label>

                            <div class="col-md-6">
                                <select id="folder_id" class="form-control" name="folder_id">
                                <option value="">Choose</option>

                                </select>

                                @if ($errors->has('folder_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('folder_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @endif
                        <div class="form-group{{ $errors->has('media_id') ? ' has-error' : '' }}">
                            <label for="media_id" class="col-md-4 control-label">Media</label>

                            <div class="col-md-6">
                                <select id="media_id" class="form-control" name="media_id" required>
                                <option value="">Choose</option>

                                </select>
                          
                                @if ($errors->has('media_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('media_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-2">@include('media_upload')</div>
                        </div>
                        <div class="form-group{{ $errors->has('link_id') ? ' has-error' : '' }}">
                            <label for="link_id" class="col-md-4 control-label">Link</label>

                            <div class="col-md-6">
                                <select id="link_id" class="form-control" name="link_id" required>
                                <option value="">Choose</option>
                                </select>

                                @if ($errors->has('link_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('link_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-2">@include('link_upload')</div>
                        </div>                        
                        
                    </div>
                    <h1>Overview</h1>
                    <div id="overview" class="step-content">

                        
                        
                    </div>                    
                </div>
                </form>
            <div>
                        <h3>Campaign:</h3>
                        [kam-<b>peyn</b>] - 
                        <i>noun</i>
                        <ul><li>a systematic course of aggressive activities for some specific purpose</li></ul>
                        
                        <div class="well">
                            <ul>
                                <li>A Trafficroots Campaign is a targeted advertising plan that consists of at least one Creative.</li>
                                <li>Campaigns target a specific Location Type and all Creatives must conform.</li>
                                <li>All Creatives and their destination Links must conform to the specified Category.</li>
                                <li>We offer Cost Per Click (CPC) and Cost Per Milli (CPM) Campaign Types. </li>
                             </ul>
                        </div>
            </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    //$('[multiple]').chosen();
    jQuery(document).ready(function($){
                
	    $("#wizard").steps({
                transitionEffect: "fade",
                autoFocus: true,    
                onFinishing: function (event, currentIndex)
	                    {
		               var form = $(this);
			       alert('Finishing!');
		            },
                onFinished: function (event, currentIndex)
		            {
				    $('#campaign_form').submit();
				    alert('Finished');
		            }			
        });
        $('#folder_id').change(function(){
            var check = parseInt($(this).val());
            if(check){
                $('#link_id').prop("disabled", true);
                $('#media_id').prop("disabled", true);
            }else{
                $('#link_id').prop("disabled", false);
                $('#media_id').prop("disabled", false);
            }
        });
        $('.reload').change(function($){
           reloadMedia(); 
        });
    });

    function reloadMedia(){
        var category = parseInt($('#campaign_category').val());
	var location_type = parseInt($('#location_type').val());
        if(category && location_type){
            var url = '/getmedia?category=' + category + '&location_type=' + location_type;
            $.getJSON(url, function(data){
                $('#folder_id').html(data.folders);
                $('#link_id').html(data.links);
                $('#media_id').html(data.media);               
            });
        }else{
            $('#folder_id').html("<option value=''>Choose</option>");
            $('#link_id').html("<option value=''>Choose</option>");
            $('#media_id').html("<option value=''>Choose</option>");
        }
    }
</script>
@endsection
