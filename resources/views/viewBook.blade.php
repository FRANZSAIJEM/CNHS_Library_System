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
        .imgView{
            width: 450px;
            height: 575px;
        }
        .fontSize{
            font-size: 30px;
        }
        .fontSize2{
            font-size: 25px;
        }
        .avail{
            transform: translateY(0px);
        }
        textarea{
            height: 200px;
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
        .imgView{
            width: 325px;
            height: 375px;

        }
        .fontSize{
            font-size: 20px;
        }
        .fontSize2{
            font-size: 15px;
        }
        .description{
            margin-top: -50px;
        }
        .avail{
            transform: translateY(-20px);
        }

        textarea{
            width: 280px;
            height: 90px;

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
                <div style="padding: 10px; border-radius: 5px; margin-top: -30px;">
                    <div class="imgView" style="box-shadow: 10px 10px 20px 5px rgba(0, 0, 0, 0.298); background-size: cover; border-radius: 5px; background-position: center center; background-image: url('{{ asset('storage/' . $book->image) }}');">
                        <div style="color: white; text-align: center; padding: 10px; text-shadow: 0px 0px 5px black">
                            <div style="margin-top: 20px;">
                                <b class="fontSize">{{$book->title}}</b> <br> <br>
                                <p class="fontSize2"><b>Author</b></p>
                                {{$book->author}}
                                <div style="display: flex; place-content: center;">
                                        <div>
                                            <b class="fontSize2">Subject</b> <br>
                                            {{$book->subject}}
                                        </div>
                                        <br> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                        <div>
                                            <b class="fontSize2">ISBN</b> <br>
                                            {{$book->isbn}}
                                        </div>
                                </div> <br>
                            </div>
                        </div>
                        <div class="description" style="color: white; padding: 20px; text-shadow: 0px 0px 5px black;">
                            <b style="text-align: left;">Description</b> <br>
                            <textarea disabled style="border-radius: 5px; resize: none; background-color: transparent; border: 0; text-shadow: 0px 0px 5px black" name="" id="" cols="50" rows="3">{{$book->description}}</textarea>
                        </div>
                        <div class="avail" style="padding: 20px;">
                            <b style="color: {{ $book->availability === 'Not Available' ? 'red' : 'rgb(0, 255, 0)' }}">{{ $book->availability }}</b>
                        </div>
                    </div>
                </div>

               @if (!Auth::user()->is_admin)
               <div style="display: grid; place-content: center; margin-top: 20px;">
                <form method="POST" action="{{ route('requestBook', ['id' => $book->id]) }}">
                    @csrf

                    @if ($userHasRequestedThisBook || $book->availability === 'Not Available')
                        <!-- If the user has already requested this book or the availability is "Not Available", show the button as unclickable -->
                        <button type="submit" style="background-color: {{ $book->availability === 'Not Available' || $userHasRequestedThisBook ? 'rgb(83, 83, 83)' : 'white' }}; border-radius: 5px; padding: 10px; color: black; width: 100px;" {{ $book->availability === 'Not Available' || $userHasRequestedThisBook ? 'disabled' : '' }}>
                            <b>{{ $userHasRequestedThisBook ? 'Requested' : 'Request' }}</b>
                        </button>
                    @else
                        <!-- If the user has not requested this book and the availability is not "Not Available", show the button as clickable -->
                        <button type="submit" style="background-color: white; border-radius: 5px; padding: 10px; color: black; width: 100px;">
                            <b>Request</b>
                        </button>
                    @endif
                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                </form>
                </div>
               @endif

               </div>
                @else
                    <p>Book not found</p>
                @endif
            </div>
        </div>


        <script>

        </script>
    </x-admin-layout>
