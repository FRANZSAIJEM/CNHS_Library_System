<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('ALL STUDENTS') }}
        </h2>
    </x-slot>
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
    <div class="container">
        <div class="content">
             <div class="bookList" style="display: inline-flex; flex-wrap: wrap">
                @foreach ($users as $user)
                    @foreach ($user->requestedBooks as $requestedBook)
                        <div style="background-color: rgb(27, 66, 81); margin: 7px; border-radius: 5px; box-shadow: 10px 10px 20px 5px rgba(0, 0, 0, 0.298);">
                            <div style="background-position: center center; border-radius: 5px; width: 250px; height: 350px; background-size: cover;">
                                <div style="color: white; padding: 20px; text-shadow: 0px 0px 5px black">
                                    <div style="">
                                        <h1><b>Borrower</b></h1>
                                        {{ $user->name }} <br> <br>
                                        <h1><b>ID Number</b></h1>
                                        {{ $user->id_number }} <br> <br>
                                        <h1><b>Book Title</b></h1>
                                        {{ $requestedBook->title }} <br> <br>
                                        <h1><b>Grade Level</b></h1>
                                        {{ $user->grade_level }}
                                    </div>
                                </div>
                            </div>
                            <div style="display: flex; place-content: center; margin-bottom: 20px;">
                                <a id="viewButton-{{ $requestedBook->id }}" href="{{ route('viewBook', ['id' => $requestedBook->id]) }}" style="margin: 5px; background-color: rgb(56, 108, 128); color: white; padding: 10px; border-radius: 5px;">View</a>

                                <button type="button" class="open-modal" onclick="showAcceptanceModal({{ $requestedBook->id }})" style="margin: 5px; background-color: rgb(56, 128, 63); color: white; padding: 10px; border-radius: 5px;">Accept</button>



                                {{-- <form action="{{ route('acceptRequest', ['user' => $user, 'book' => $requestedBook]) }}" method="POST">
                                    @csrf
                                    <button type="submit" style="margin: 5px; background-color: rgb(56, 128, 63); color: white; padding: 10px; border-radius: 5px;">Accept</button>
                                </form> --}}



                                <form action="{{ route('removeRequest', ['user_id' => $user->id, 'book_id' => $requestedBook->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="margin: 5px; background-color: rgb(128, 56, 56); color: white; padding: 10px; border-radius: 5px;">Remove</button>
                                </form>

                            </div>
                        </div>
                        <div id="confirmAcceptModal-{{ $requestedBook->id }}" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 1;">
                            <div style="background-color: white; border-radius: 5px; width: 300px; margin: 100px auto; padding: 20px; text-align: center;">
                                <div style="display: inline-flex">
                                    <!-- Form to submit the delete request -->
                                    <form action="{{ route('acceptRequest', ['user' => $user, 'book' => '__REQUESTEDBOOK_ID__']) }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="date_pickup">Date Pickup:</label>
                                            <input type="date" id="date_pickup" name="date_pickup" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="date_return">Date Return:</label>
                                            <input type="date" id="date_return" name="date_return" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="fines">Fines (optional):</label>
                                            <input type="number" step="0.01" id="fines" name="fines" placeholder="Enter fine amount">
                                        </div>

                                        <button style="background-color: rgb(146, 146, 146); padding: 10px 20px; margin-right: 10px; border-radius: 5px; color: white;" onclick="hideAcceptanceModal({{ $requestedBook->id }})">Cancel</button>
                                        <button type="submit" style="margin: 5px; background-color: rgb(60, 163, 60);  color: white; padding: 10px; border-radius: 5px; width: 100px;">Accept</button>
                                    </form>
                               </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
             </div>
        </div>
    </div>



    <script>
        function showAcceptanceModal(requestedBook) {
            var modal = document.getElementById(`confirmAcceptModal-${requestedBook}`);
            modal.style.display = 'block';

            // Set the action of the form to include the specific book's ID
            var form = modal.querySelector('form');
            form.action = form.action.replace('__REQUESTEDBOOK_ID__', requestedBook);
        }

        function hideAcceptanceModal(requestedBook) {
            var modal = document.getElementById(`confirmAcceptModal-${requestedBook}`);
            modal.style.display = 'none';
        }

    </script>
</x-admin-layout>



