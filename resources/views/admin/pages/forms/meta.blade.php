<div style="padding-top:40px;"></div>
<div class="form-group @if($errors->has('title') ) has-error @endif">
	<label class="col-xs-2 control-label" for="title">Page title</label>
	<div class="col-xs-9">
		<input type="text" name="title" class="form-control" value="{{old('title', $seo->title)}}">
		<span class="help-block">{{{$errors->first('title')}}}</span>
	</div>
</div>
<div class="form-group @if($errors->has('description') ) has-error @endif">
	<label class="col-xs-2 control-label" for="description">Page description</label>
	<div class="col-xs-9">
		<input type="text" name="description" class="form-control" value="{{old('description', $seo->description)}}">
		<span class="help-block">{{{$errors->first('description')}}}</span>
	</div>
</div>
<div class="form-group @if($errors->has('keywords') ) has-error @endif">
	<label class="col-xs-2 control-label" for="keywords">Page keywords</label>
	<div class="col-xs-9">
		<input type="text" name="keywords" class="form-control" value="{{old('keywords', $seo->keywords)}}">
		<span class="help-block">{{{$errors->first('keywords')}}}</span>
	</div>
</div>

<div class="form-group @if($errors->has('keywords') ) has-error @endif">
	<label class="col-xs-2 control-label" for="keywords">Page keywords</label>
	<div class="col-xs-9">
		<select name="robots" id="robots">
			<option value="index,follow" @if(old('robots', $seo->robots) === 'index,follow') selected @endif>index,follow</option>
			<option value="index,nofollow" @if(old('robots', $seo->robots) === 'index,nofollow') selected @endif>index,nofollow</option>
			<option value="noindex,follow" @if(old('robots', $seo->robots) === 'noindex,follow') selected @endif>noindex,follow</option>
			<option value="noindex,nofollow" @if(old('robots', $seo->robots) === 'noindex,nofollow') selected @endif>noindex,nofollow</option>
		</select>
		<span class="help-block">{{{$errors->first('keywords')}}}</span>
	</div>
</div>