@extends('layout.default_system')

@section('header')
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/dropzone/3.8.4/css/dropzone.css">

    <style>


        .contentControls{
            bottom: -50px;
            position: absolute;
        }
        form{
            position: relative;
        }
    </style>
@endsection


@section('content')



    <form action="{{ route('footbridge_store_path') }}" method="post" id="my-awesome-dropzone" class="dropzone">
        <div class="dropzone-previews"></div> <!-- this is were the previews should be shown. -->

        <div class="contentControls">
            <button type="submit">Submit data and files!</button>
            <input type="text" name="name">
            <input type="text" name="rf">
            <input type="text" name="rfrfe">
            <input type="text" name="3f3443">

         </div>
    </form>

@endsection

@section('footer')


    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

    <script src="http://cdnjs.cloudflare.com/ajax/libs/dropzone/3.8.4/dropzone.js"></script>

    <script>
        Dropzone.options.myAwesomeDropzone = { // The camelized version of the ID of the form element

            // The configuration we've talked about above
            autoProcessQueue: false,
            uploadMultiple: true,
            parallelUploads: 100,
            maxFiles: 100,

            // The setting up of the dropzone
            init: function() {
                var myDropzone = this;

                // First change the button to actually tell Dropzone to process the queue.
                this.element.querySelector("button[type=submit]").addEventListener("click", function(e) {
                    // Make sure that the form isn't actually being sent.
                    e.preventDefault();
                    e.stopPropagation();
                    myDropzone.processQueue();
                    console.log($('form').serialize());
                });

                // Listen to the sendingmultiple event. In this case, it's the sendingmultiple event instead
                // of the sending event because uploadMultiple is set to true.
                this.on("sendingmultiple", function() {
                    // Gets triggered when the form is actually being sent.
                    // Hide the success button or the complete form.
                });
                this.on("successmultiple", function(files, response) {
                    // Gets triggered when the files have successfully been sent.
                    // Redirect user or notify of success.
                });
                this.on("errormultiple", function(files, response) {
                    // Gets triggered when there was an error sending the files.
                    // Maybe show form again, and notify user of error
                });
            }

        }
    </script>




@endsection