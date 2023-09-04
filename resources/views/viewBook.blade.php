<style>
    .container {
            display: grid;
            place-items: center;
            margin-top: 50px;
        }

    .content {
        width: 57.5%;
        margin: 0 auto;
        }

        .searchBtn{
            display: flex;
            text-align: right;
            justify-content: flex-end;
            margin-bottom: 30px;
            margin-right: 35px;
            align-items: center;
        }
        .searchInpt{
            width: 250px;
            text-align: center;
        }
        @media (max-width: 360px) and (max-height: 640px) {
        .content {
            width: 100%; /* Adjust width for smaller screens */

        }

        .searchBtn{
            text-align: right;
            margin-right: 15px;
            margin-bottom: -100px;
            transform: translateY(-110px)
        }
        .searchInpt{
            width: 100px
        }
        .bookList{
            margin-left: 50px;
        }
    }
    </style>

    <x-admin-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('ALL BOOKS') }}
            </h2>
        </x-slot>
        <div class="container">
            <div class="content">
                @if(isset($book))
               <div style="display: grid; place-content: center;">
                <div style="background-color: white; padding: 10px; border-radius: 5px;">
                    <div style="border-radius: 5px; background-position: center center; width: 500px; height: 575px; background-image: url('{{ asset('storage/' . $book->image) }}');">
                        <div style="color: white; text-align: center; padding: 10px; text-shadow: 0px 0px 5px black">
                            <div style="margin-top: 20px;">
                                <b style="font-size: 30px;">{{$book->title}}</b> <br> <br> <br>
                                <p style="font-size: 30px;">Author</p>
                                {{$book->author}} <br> <br> <br>
                                <div style="display: flex; place-content: center;">
                                        <div>
                                            <b style="font-size: 25px;">Subject</b> <br>
                                            {{$book->subject}}
                                        </div>
                                        <br>
                                        <div>
                                            <b style="font-size: 25px; ">ISBN</b> <br>
                                            {{$book->isbn}}
                                        </div>
                                </div> <br>
                            </div>
                        </div>
                        <div style="color: white; padding: 20px;">
                            <b style="text-align: left;">Description</b> <br>
                            {{$book->description}}
                        </div> <br>
                        <div style="padding: 20px;">
                            <b style="color: {{ $book->availability === 'Not Available' ? 'red' : 'rgb(0, 255, 0)' }}">{{ $book->availability }}</b>
                        </div>
                    </div>
                </div>

               @if (!Auth::user()->is_admin)
               <div style="display: grid; place-content: center; margin-top: 20px;">
                    <form method="POST" action="{{ route('requestBook', ['id' => $book->id]) }}">
                        @csrf
                        <button type="submit" style="background-color: white; border-radius: 5px; padding: 10px; color: black; width: 100px;">
                            <b>Request</b>
                        </button>
                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                    </form>
                </div>
               @endif

               </div>
                {{-- <div style="margin: 7px; border-radius: 5px; box-shadow: 10px 10px 20px 5px rgba(0, 0, 0, 0.298);">
                        <div style="background-position: center center; border-radius: 5px; width: 250px; height: 350px; background-size: cover; background-image: url('{{ asset('storage/' . $book->image) }}');">
                            <div style="color: white; text-align: center; padding: 10px; text-shadow: 0px 0px 5px black">
                                <div style="margin-top: 75px;">
                                    <b style="font-size: 25px;">Title</b> <br>
                                    {{$book->title}} <br>
                                    <b style="font-size: 25px;">Author</b> <br>
                                    {{$book->author}} <br>
                                    <b style="font-size: 25px;">Subject</b> <br>
                                    {{$book->subject}} <br>
                                </div>
                            </div>
                        </div>

                    @if (Auth::user()->is_admin)
                    <div style="text-align: center; margin-top: 4px;">
                        <form action="{{ route('editBook.edit', ['id' => $book->id]) }}" method="GET" style="display: inline;">
                            @csrf
                            <button type="submit" style="background-color: rgb(60, 163, 60); width: 123px !important; border: none; border-radius: 5px; padding: 10px; color: white; text-decoration: none; cursor: pointer;"><b>Edit</b></button>
                        </form>

                        <!-- Button to trigger the modal -->
                        <button type="button" style="background-color: rgb(167, 55, 55); width: 123px; border-radius: 5px; padding: 10px; color: white;" onclick="showConfirmationModal({{ $book->id }})"><b>Delete</b></button>
                    </div>
                    @endif
                </div> --}}
                @else
                    <p>Book not found</p>
                @endif
            </div>
        </div>


        <script>

        </script>
    </x-admin-layout>
