<div class="{{$viewClass['form-group']}} {!! !$errors->has($errorKey) ? '' : 'has-error' !!}">
    <label for="{{$id}}" class="{{$viewClass['label']}} control-label">{{$label}}</label>

    <div class="{{$viewClass['field']}}">

        @include('admin::form.error')
        <div class="case">
            <div class="upload" data-name="{{$name}}" action='{{admin_base_path('dragUploader')}}' data-value="{{old($column, $value) ? implode(',', $value) : ''}}" id='{{$id}}'></div>
        </div>
        {{--<input type="hidden" id="{{$name}}" name="{{$name}}" value="{{json_encode(old($column, $value) ? old($column, $value) : [])}}" />--}}
        @include('admin::form.help-block')

    </div>
</div>