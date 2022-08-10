<section class="m-xl-4">
    {{ Form::open(['route' => ['business.upload.media',getEncrypted($profile->id)], 'method' => 'POST','class' => 'dropzone','id'=>'dropzoneForm','files'=>'true']) }}
        <div class="fallback progress-bar progress-bar-primary">
            <span class="progress-text"></span>
            <input name="file" type="file" id="file1" class="hide" />
        </div>
    {{Form::close()}}

    <div class="container" id="load-business-media">
        @include('customer.components.business_media')
    </div>
</section>
