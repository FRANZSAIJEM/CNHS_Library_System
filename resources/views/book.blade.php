<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('ADD BOOK') }}
        </h2>
    </x-slot>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
    .container {
        display: grid;
        place-items: center;
        margin-top: 50px;
    }

    #previewImage {
            border-radius: 5px;
            pointer-events: none;
            position: absolute;
            top: 0;
            margin-left: 20px;
            width: 94%;
            height: 100%;
            object-fit: cover;
    }

    .content {

        width: 57.5%;
        margin: 0 auto;

    }


    #image::-webkit-file-upload-button {
        visibility: hidden;
    }
    #image::before {
        content: ' ';
        display: inline-block;
        background: url('your-placeholder-image-url') center center no-repeat;
        background-size: cover;
        width: 100%;
        height: 100%;
        border-radius: 5px;
    }

    .text_content1::before {
        content: "Click here to";
    }

    .text_content2::before {
        content: "upload a photo";
    }


    .text_content4::before {
        content: "for the book";
    }

    .text_content5::before {
        content: "cover";
    }

    .text_content1, .text_content2, .text_content3, .text_content4, .text_content5 {
        text-shadow: 0px 0px 10px #000000;


    }
    .form{
        display: inline-flex;
    }
    .form .input{
        width: 500px;
    }
    .fields{
        width: 765px
    }
    .imgInput{
        margin-left: 20px;
    }
    .textCont{
        left: 120px;
    }

    .addBtn{
        align-self: flex-end;
        margin-top: 20px;
        background-color: white;
        color: black;
        padding: 13px;
        border-radius: 5px;
        font-size: 13px;
    }
    .img{
        width: 30px;
    }

    #characterCount{

    }


@media (max-width: 360px) and (max-height: 640px) {
    .content {
        width: 100%; /* Adjust width for smaller screens */

    }
    .form{
        display: block;
        margin: 20px;
    }

    .textCont{
        left: 110px;
    }

    .text_content2::before {
        content: "take a photo";
    }

    .form .input{
        width: 320px;
    }

    .fields{
        width: 500px
    }
    .imgInput{
        margin-left: 0;
    }
    .textArea{
        width: 320px;
        margin-left: 20px;
        transform: translateY(-120px)
    }
    .addBtn{
        margin-left: 20px;
        align-self: flex-start;
        background-color: white;
        color: black;
        padding: 13px;
        border-radius: 5px;
        font-size: 13px;
        transform: translateY(175px)

    }
    #previewImage {
            border-radius: 5px;
            pointer-events: none;
            position: absolute;
            top: 0;
            margin-left: 0px;
            width: 64%;
            height: 100%;
            object-fit: cover;
    }


    #characterCount{
        transform: translateY(-130px);
        padding: 20px;

    }


}
    </style>

    <div class="container">
        <div class="content" style="color: white;">
            <form action="{{ route('book') }}" method="post" enctype="multipart/form-data" style="display: flex; flex-direction: column;">
                @csrf
                <div class="form">
                  <div class="fields" style="">
                    <label for="title"><b>Title</b></label> <br>
                    <input class="input" type="text" id="title" name="title" required style="background-color: transparent; border: 0; border-bottom: 2px solid white">
                    <br> <br>
                    <label for="author"><b>Author</b></label> <br>
                    <input class="input"  type="text" id="author" name="author" required style="background-color: transparent; border: 0; border-bottom: 2px solid white">
                    <br> <br>
                    <label for="subject"><b>Subject</b></label> <br>
                    <input class="input"  type="text" id="subject" name="subject" required style="background-color: transparent; border: 0; border-bottom: 2px solid white">
                    <br> <br>
                    <label for="availability"><b>Availability</b></label> <br>
                    <input required type="radio" id="availability" name="availability" value="Available" style="background-color: transparent; border:1px solid white"> Available &nbsp;
                    <input required type="radio" id="availability" name="availability" value="Not Available" style="background-color: transparent; border:1px solid white"> Not Available
                    <br> <br>
                    <label for="isbn"><b>ISBN</b></label> <br>
                    <input  class="input" type="text" id="isbn" name="isbn" required style="background-color: transparent; border: 0; border-bottom: 2px solid white">
                    <br> <br>
                  </div>

                  <div style="position: relative;">
                    <div class="textCont" style="text-align: center; position: absolute; z-index: 1; top: 150px; pointer-events: none;">
                        <b><h1 class="text_content1"></h1>
                            <h1 class="text_content2"></h1>
                            <h1 class="text_content3"></h1>
                            <h1 class="text_content4"></h1>
                            <h1 class="text_content5"></h1></b>

                    </div>


                    <input class="imgInput" type="file" id="image" name="image" accept="image/*" required style="box-shadow: 0px 20px 15px 5px rgba(0, 0, 0, 0.306); color:transparent; background-color: rgb(38, 117, 122); cursor: pointer; text-align: right; border-radius: 5px; height: 435px; width: 320px;">
                    <img id="previewImage" src="#" alt="Selected Image" style="display: none;">


                    {{-- <img id="previewImage" src="#" alt="Selected Image" style="max-width: 335px; max-height: 435px; position: absolute; top: 435px; left: 0; display: none; transform: translateY(-435px)"> --}}
                  </div>


                </div> <br>
                <button class="addBtn" type="submit" style=""><b>Add Book</b></button>
                <br>
                <label class="textArea" for="description"><b>Description</b></label>
                <textarea class="textArea" placeholder="Type here!" cols="142" rows="5" id="description" name="description" required
                    style="box-shadow: 0px 20px 15px 5px rgba(0, 0, 0, 0.306); resize: none; border: 0; border-radius: 5px; background-color: rgb(54, 86, 54);"
                    oninput="updateCharacterCount(this)"></textarea>
                <div id="characterCount">Characters left: 500</div>


                <br>

            </form>
        </div>
    </div>

</x-admin-layout>

<script>
  const imageInput = document.getElementById('image');
  const previewImage = document.getElementById('previewImage');

  imageInput.addEventListener('change', function(event) {
    const selectedFile = event.target.files[0];
    if (selectedFile) {
      const objectURL = URL.createObjectURL(selectedFile);
      previewImage.src = objectURL;
      previewImage.style.display = 'block';
    }
  });


  function updateCharacterCount(textArea) {
        var maxLength = 255;
        var currentLength = textArea.value.length;
        var charactersLeft = maxLength - currentLength;

        var characterCountElement = document.getElementById("characterCount");
        characterCountElement.textContent = "Characters left: " + charactersLeft;

        if (charactersLeft < 0) {
            textArea.value = textArea.value.substring(0, maxLength);
            characterCountElement.textContent = "Characters left: 0";
        }
    }
</script>
